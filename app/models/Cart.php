<?php

declare(strict_types=1);

class Cart
{
    private const SESSION_KEY = 'cart';
    private ProductRepository $products;

    public function __construct(ProductRepository $products)
    {
        $this->products = $products;
        if (!isset($_SESSION[self::SESSION_KEY])) {
            $_SESSION[self::SESSION_KEY] = [];
        }
    }

    public function add(int $productId, int $quantity = 1): void
    {
        if ($quantity < 1) {
            return;
        }

        $_SESSION[self::SESSION_KEY][$productId] = ($_SESSION[self::SESSION_KEY][$productId] ?? 0) + $quantity;
    }

    public function update(int $productId, int $quantity): void
    {
        if ($quantity < 1) {
            $this->remove($productId);
            return;
        }

        $_SESSION[self::SESSION_KEY][$productId] = $quantity;
    }

    public function remove(int $productId): void
    {
        unset($_SESSION[self::SESSION_KEY][$productId]);
    }

    public function clear(): void
    {
        $_SESSION[self::SESSION_KEY] = [];
    }

    public function items(): array
    {
        $items = [];
        foreach ($_SESSION[self::SESSION_KEY] as $productId => $quantity) {
            $product = $this->products->find((int) $productId);
            if ($product) {
                $items[] = [
                    'product' => $product,
                    'quantity' => $quantity,
                    'total' => $quantity * (float) $product['price'],
                ];
            }
        }

        return $items;
    }

    public function count(): int
    {
        return array_sum($_SESSION[self::SESSION_KEY]);
    }

    public function total(): float
    {
        return array_reduce($this->items(), static fn ($carry, $item) => $carry + $item['total'], 0.0);
    }
}
