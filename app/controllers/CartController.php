<?php

declare(strict_types=1);

class CartController extends BaseController
{
    private Cart $cart;

    public function __construct(Cart $cart)
    {
        $this->cart = $cart;
    }

    public function index(): void
    {
        $this->render('cart', [
            'items' => $this->cart->items(),
            'total' => $this->cart->total(),
        ]);
    }

    public function add(int $productId, int $quantity = 1): void
    {
        $this->cart->add($productId, $quantity);
    }

    public function update(int $productId, int $quantity): void
    {
        $this->cart->update($productId, $quantity);
    }

    public function remove(int $productId): void
    {
        $this->cart->remove($productId);
    }

    public function checkout(): void
    {
        $this->cart->clear();
    }
}
