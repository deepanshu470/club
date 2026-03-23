<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Cart;
use App\Models\ProductRepository;

class CartController extends Controller
{
    private Cart $cart;
    private ProductRepository $products;

    public function __construct(ProductRepository $products, Cart $cart)
    {
        $this->products = $products;
        $this->cart = $cart;
    }

    public function index(): void
    {
        $this->render('cart', [
            'items' => $this->cart->items(),
            'total' => $this->cart->total(),
            'cartCount' => $this->cart->count(),
        ]);
    }

    public function add(): void
    {
        $id = isset($_POST['id']) ? (int) $_POST['id'] : 0;
        $qty = isset($_POST['quantity']) ? max(1, (int) $_POST['quantity']) : 1;

        if ($this->products->find($id)) {
            $this->cart->add($id, $qty);
        }

        $this->redirect('cart');
    }

    public function update(): void
    {
        foreach ($_POST['quantities'] ?? [] as $productId => $quantity) {
            $this->cart->update((int) $productId, (int) $quantity);
        }

        $this->redirect('cart');
    }

    public function remove(): void
    {
        $id = isset($_POST['id']) ? (int) $_POST['id'] : 0;
        $this->cart->remove($id);
        $this->redirect('cart');
    }

    public function checkout(): void
    {
        $this->render('checkout', [
            'items' => $this->cart->items(),
            'total' => $this->cart->total(),
            'cartCount' => $this->cart->count(),
        ]);
    }

    public function placeOrder(): void
    {
        if (empty($this->cart->items())) {
            $this->redirect('cart');
        }

        $name = trim($_POST['name'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $address = trim($_POST['address'] ?? '');
        $city = trim($_POST['city'] ?? '');
        $notes = trim($_POST['notes'] ?? '');

        $orderId = strtoupper(substr(hash('sha1', $name . $email . microtime()), 0, 8));
        $items = $this->cart->items();
        $total = $this->cart->total();
        $this->cart->clear();

        $this->render('checkout', [
            'orderComplete' => true,
            'orderId' => $orderId,
            'name' => $name,
            'email' => $email,
            'address' => $address,
            'city' => $city,
            'notes' => $notes,
            'items' => $items,
            'total' => $total,
            'cartCount' => 0,
        ]);
    }
}
