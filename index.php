<?php

declare(strict_types=1);

session_start();

define('BASE_PATH', __DIR__);

spl_autoload_register(function (string $class): void {
    $paths = [
        BASE_PATH . '/app/core/' . $class . '.php',
        BASE_PATH . '/app/controllers/' . $class . '.php',
        BASE_PATH . '/app/models/' . $class . '.php',
    ];

    foreach ($paths as $path) {
        if (file_exists($path)) {
            require_once $path;
            return;
        }
    }
});

$productRepository = new ProductRepository(BASE_PATH . '/data/products.json');
$cart = new Cart($productRepository);

$homeController = new HomeController($productRepository);
$productController = new ProductController($productRepository);
$cartController = new CartController($cart);
$adminController = new AdminController($productRepository);

$route = $_GET['route'] ?? 'home';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    switch ($action) {
        case 'add_to_cart':
            $cartController->add((int) ($_POST['product_id'] ?? 0), max(1, (int) ($_POST['quantity'] ?? 1)));
            header('Location: ?route=cart');
            exit;
        case 'update_cart':
            $cartController->update((int) ($_POST['product_id'] ?? 0), max(1, (int) ($_POST['quantity'] ?? 1)));
            header('Location: ?route=cart');
            exit;
        case 'remove_from_cart':
            $cartController->remove((int) ($_POST['product_id'] ?? 0));
            header('Location: ?route=cart');
            exit;
        case 'checkout':
            $cartController->checkout();
            $_SESSION['flash'] = ['message' => 'Order placed! We will confirm shortly.', 'type' => 'success'];
            header('Location: ?route=home');
            exit;
        case 'login_admin':
            $adminController->login(trim($_POST['email'] ?? ''), trim($_POST['password'] ?? ''));
            header('Location: ?route=admin');
            exit;
        case 'logout_admin':
            $adminController->logout();
            header('Location: ?route=admin');
            exit;
        case 'save_product':
            $adminController->saveProduct($_POST);
            header('Location: ?route=admin');
            exit;
        case 'delete_product':
            $adminController->deleteProduct((int) ($_POST['product_id'] ?? 0));
            header('Location: ?route=admin');
            exit;
        default:
            break;
    }
}

switch ($route) {
    case 'home':
        $homeController->index();
        break;
    case 'products':
        $productController->index();
        break;
    case 'product':
        $productController->show((int) ($_GET['id'] ?? 0));
        break;
    case 'cart':
        $cartController->index();
        break;
    case 'admin':
        $adminController->index();
        break;
    default:
        http_response_code(404);
        View::render('not-found', ['message' => 'Page not found']);
        break;
}
