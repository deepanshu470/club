<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Cart;
use App\Models\ProductRepository;

class HomeController extends Controller
{
    private ProductRepository $products;
    private Cart $cart;

    public function __construct(ProductRepository $products, Cart $cart)
    {
        $this->products = $products;
        $this->cart = $cart;
    }

    public function index(): void
    {
        $this->render('home', [
            'featured' => $this->products->featured(),
            'all' => $this->products->all(),
            'categories' => $this->products->categories(),
            'cartCount' => $this->cart->count(),
        ]);
    }
}
