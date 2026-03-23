<?php

namespace App\Models;

class Cart
{
    private ProductRepository $products;

    public function __construct(ProductRepository $products)
    {
        $this->products = $products;
        $_SESSION['cart'] = $_SESSION['cart'] ?? [];
    }

    public function items(): array
    {
        $items = [];

        foreach ($_SESSION['cart'] as $productId => $quantity) {
            $product = $this->products->find((int) $productId);
            if ($product) {
                $items[] = [
                    'product' => $product,
                    'quantity' => $quantity,
                    'subtotal' => $quantity * (float) $product['price'],
                ];
            }
        }

        return $items;
    }

    public function add(int $productId, int $quantity = 1): void
    {
        if ($quantity < 1) {
            return;
        }

        $_SESSION['cart'][$productId] = ($_SESSION['cart'][$productId] ?? 0) + $quantity;
    }

    public function update(int $productId, int $quantity): void
    {
        if ($quantity <= 0) {
            unset($_SESSION['cart'][$productId]);
            return;
        }

        $_SESSION['cart'][$productId] = $quantity;
    }

    public function remove(int $productId): void
    {
        unset($_SESSION['cart'][$productId]);
    }

    public function clear(): void
    {
        $_SESSION['cart'] = [];
    }

    public function total(): float
    {
        return array_reduce($this->items(), fn ($carry, $item) => $carry + $item['subtotal'], 0.0);
    }

    public function count(): int
    {
        return array_sum($_SESSION['cart']);
    }
}
