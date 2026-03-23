<?php

namespace App\Models;

class ProductRepository
{
    private array $products;

    public function __construct()
    {
        if (!isset($_SESSION['products'])) {
            $_SESSION['products'] = include __DIR__ . '/../Data/products.php';
        }

        $this->products = $_SESSION['products'];
    }

    public function all(): array
    {
        return array_values($this->products);
    }

    public function featured(): array
    {
        return array_values(array_filter($this->products, fn ($p) => !empty($p['featured'])));
    }

    public function categories(): array
    {
        $categories = array_map(fn ($p) => $p['category'], $this->products);
        sort($categories);
        return array_values(array_unique($categories));
    }

    public function find(int $id): ?array
    {
        foreach ($this->products as $product) {
            if ((int) $product['id'] === $id) {
                return $product;
            }
        }

        return null;
    }

    public function filter(?string $category = null, ?string $search = null): array
    {
        return array_values(array_filter($this->products, function ($product) use ($category, $search) {
            $matchesCategory = $category ? strcasecmp($product['category'], $category) === 0 : true;
            $matchesSearch = $search
                ? (stripos($product['name'], $search) !== false
                    || stripos($product['description'], $search) !== false
                    || $this->tagMatch($product, $search))
                : true;

            return $matchesCategory && $matchesSearch;
        }));
    }

    public function add(array $payload): array
    {
        $nextId = $this->nextId();
        $product = array_merge([
            'id' => $nextId,
            'rating' => 4.5,
            'stock' => 10,
            'featured' => false,
            'badge' => 'New',
            'tags' => [],
            'colors' => [],
            'sizes' => [],
        ], $payload);

        $this->products[] = $product;
        $this->persist();

        return $product;
    }

    public function update(int $id, array $payload): ?array
    {
        foreach ($this->products as $index => $product) {
            if ((int) $product['id'] === $id) {
                $updated = array_merge($product, $payload);
                $this->products[$index] = $updated;
                $this->persist();
                return $updated;
            }
        }

        return null;
    }

    private function persist(): void
    {
        $_SESSION['products'] = $this->products;
    }

    private function nextId(): int
    {
        $ids = array_map(fn ($p) => (int) $p['id'], $this->products);
        return empty($ids) ? 1 : max($ids) + 1;
    }

    private function tagMatch(array $product, string $search): bool
    {
        foreach ($product['tags'] as $tag) {
            if (stripos($tag, $search) !== false) {
                return true;
            }
        }

        return false;
    }
}
