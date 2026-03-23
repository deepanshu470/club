<?php

session_start();

require __DIR__ . '/app/helpers.php';

spl_autoload_register(function ($class) {
    $prefix = 'App\\';
    $baseDir = __DIR__ . '/app/';

    if (str_starts_with($class, $prefix)) {
        $relative = str_replace('\\', '/', substr($class, strlen($prefix)));
        $file = $baseDir . $relative . '.php';
        if (file_exists($file)) {
            require $file;
        }
    }
});

use App\Controllers\AdminController;
use App\Controllers\CartController;
use App\Controllers\HomeController;
use App\Controllers\ProductController;
use App\Core\Router;
use App\Models\Auth;
use App\Models\Cart;
use App\Models\ProductRepository;

$products = new ProductRepository();
$cart = new Cart($products);
$auth = new Auth();

$home = new HomeController($products, $cart);
$productController = new ProductController($products, $cart);
$cartController = new CartController($products, $cart);
$adminController = new AdminController($products, $auth);

$router = new Router();
$router->get('home', fn () => $home->index());
$router->get('', fn () => $home->index());
$router->get('catalog', fn () => $productController->catalog());
$router->get('product', fn () => $productController->show());
$router->get('cart', fn () => $cartController->index());
$router->post('cart/add', fn () => $cartController->add());
$router->post('cart/update', fn () => $cartController->update());
$router->post('cart/remove', fn () => $cartController->remove());
$router->get('checkout', fn () => $cartController->checkout());
$router->post('checkout/submit', fn () => $cartController->placeOrder());
$router->get('admin/login', fn () => $adminController->login());
$router->post('admin/authenticate', fn () => $adminController->authenticate());
$router->get('admin', fn () => $adminController->dashboard());
$router->get('admin/edit', fn () => $adminController->edit());
$router->post('admin/save', fn () => $adminController->save());
$router->get('admin/logout', fn () => $adminController->logout());

$route = $_GET['route'] ?? 'home';
$router->dispatch($route, $_SERVER['REQUEST_METHOD']);
