<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Cart;
use App\Models\ProductRepository;

class ProductController extends Controller
{
    private ProductRepository $products;
    private Cart $cart;

    public function __construct(ProductRepository $products, Cart $cart)
    {
        $this->products = $products;
        $this->cart = $cart;
    }

    public function catalog(): void
    {
        $category = $_GET['category'] ?? null;
        $query = $_GET['q'] ?? null;

        $this->render('catalog', [
            'products' => $this->products->filter($category, $query),
            'categories' => $this->products->categories(),
            'activeCategory' => $category,
            'query' => $query,
            'cartCount' => $this->cart->count(),
        ]);
    }

    public function show(): void
    {
        $id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
        $product = $this->products->find($id);

        if (!$product) {
            http_response_code(404);
            $this->render('partials/404', ['title' => 'Product not found']);
            return;
        }

        $this->render('product', [
            'product' => $product,
            'related' => $this->products->filter($product['category']),
            'cartCount' => $this->cart->count(),
        ]);
    }
}
