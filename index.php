<?php
session_start();

// Define base path
define('BASE_PATH', __DIR__);
define('BASE_URL', '/');

// Auto-loader for classes
spl_autoload_register(function ($class) {
    $paths = [
        BASE_PATH . '/app/controllers/' . $class . '.php',
        BASE_PATH . '/app/models/' . $class . '.php',
        BASE_PATH . '/config/' . $class . '.php'
    ];

    foreach ($paths as $path) {
        if (file_exists($path)) {
            require_once $path;
            return;
        }
    }
});

// Load database configuration
require_once BASE_PATH . '/config/Database.php';

// Simple routing
$request = $_SERVER['REQUEST_URI'];
$request = str_replace(BASE_URL, '', $request);
$request = explode('?', $request)[0];
$request = trim($request, '/');

// Route handling
$routes = [
    '' => ['HomeController', 'index'],
    'home' => ['HomeController', 'index'],
    'products' => ['ProductController', 'index'],
    'product' => ['ProductController', 'show'],
    'cart' => ['CartController', 'index'],
    'cart/add' => ['CartController', 'add'],
    'cart/update' => ['CartController', 'update'],
    'cart/remove' => ['CartController', 'remove'],
    'checkout' => ['CheckoutController', 'index'],
    'checkout/process' => ['CheckoutController', 'process'],
    'login' => ['AuthController', 'login'],
    'register' => ['AuthController', 'register'],
    'logout' => ['AuthController', 'logout'],
    'profile' => ['UserController', 'profile'],
    'orders' => ['UserController', 'orders'],
    'wishlist' => ['WishlistController', 'index'],
    'wishlist/add' => ['WishlistController', 'add'],
    'wishlist/remove' => ['WishlistController', 'remove'],
    'search' => ['ProductController', 'search'],
    'admin' => ['AdminController', 'dashboard'],
    'admin/products' => ['AdminController', 'products'],
    'admin/products/add' => ['AdminController', 'addProduct'],
    'admin/products/edit' => ['AdminController', 'editProduct'],
    'admin/products/delete' => ['AdminController', 'deleteProduct'],
    'admin/orders' => ['AdminController', 'orders'],
    'admin/users' => ['AdminController', 'users'],
    'admin/categories' => ['AdminController', 'categories'],
];

// Match route
$matched = false;
foreach ($routes as $route => $handler) {
    if ($request === $route || strpos($request, $route) === 0) {
        $controller = new $handler[0]();
        $method = $handler[1];
        $controller->$method();
        $matched = true;
        break;
    }
}

// 404 handler
if (!$matched) {
    http_response_code(404);
    echo "404 - Page Not Found";
}
