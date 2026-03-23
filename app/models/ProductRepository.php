<?php

declare(strict_types=1);

class ProductRepository
{
    private string $filePath;

    public function __construct(string $filePath)
    {
        $this->filePath = $filePath;
        $this->bootstrap();
    }

    public function all(): array
    {
        return $this->read();
    }

    public function featured(int $limit = 4): array
    {
        $products = $this->all();
        return array_slice($products, 0, $limit);
    }

    public function find(int $id): ?array
    {
        foreach ($this->all() as $product) {
            if ($product['id'] === $id) {
                return $product;
            }
        }

        return null;
    }

    public function save(array $payload): array
    {
        $products = $this->all();
        $now = date(DATE_ATOM);

        if (!empty($payload['id'])) {
            foreach ($products as &$product) {
                if ($product['id'] === (int) $payload['id']) {
                    $product = $this->normalize(array_merge($product, $payload, ['updated_at' => $now]));
                    $this->write($products);
                    return $product;
                }
            }
        }

        $nextId = $this->nextId($products);
        $product = $this->normalize(array_merge($payload, [
            'id' => $nextId,
            'created_at' => $now,
            'updated_at' => $now,
        ]));

        $products[] = $product;
        $this->write($products);

        return $product;
    }

    public function delete(int $id): void
    {
        $products = array_values(array_filter($this->all(), static fn ($product) => $product['id'] !== $id));
        $this->write($products);
    }

    private function bootstrap(): void
    {
        if (file_exists($this->filePath)) {
            return;
        }

        $seed = [
            [
                'id' => 1,
                'name' => 'Smoked Chili Achar',
                'price' => 14.99,
                'category' => 'Artisan',
                'description' => 'Fire-roasted chilies slow-brined with Himalayan salt for a deep, smoky kick.',
                'image' => 'https://images.unsplash.com/photo-1504674900247-0877df9cc836?auto=format&fit=crop&w=800&q=80',
                'tags' => ['spicy', 'signature'],
                'created_at' => date(DATE_ATOM),
                'updated_at' => date(DATE_ATOM),
            ],
            [
                'id' => 2,
                'name' => 'Mango Mustard Reserve',
                'price' => 18.50,
                'category' => 'Limited',
                'description' => 'Alphonso mango ribbons folded into a sharp stone-ground mustard emulsion.',
                'image' => 'https://images.unsplash.com/photo-1502741338009-cac2772e18bc?auto=format&fit=crop&w=800&q=80',
                'tags' => ['fruity', 'gold-label'],
                'created_at' => date(DATE_ATOM),
                'updated_at' => date(DATE_ATOM),
            ],
            [
                'id' => 3,
                'name' => 'Garlic Confit Crunch',
                'price' => 12.00,
                'category' => 'Everyday',
                'description' => 'Slow-caramelized garlic cloves with toasted seeds for a savory crunch.',
                'image' => 'https://images.unsplash.com/photo-1504674900247-0877df9cc836?auto=format&fit=crop&w=800&q=80',
                'tags' => ['umami', 'crunchy'],
                'created_at' => date(DATE_ATOM),
                'updated_at' => date(DATE_ATOM),
            ],
            [
                'id' => 4,
                'name' => 'Citrus Peel Atelier',
                'price' => 15.75,
                'category' => 'Seasonal',
                'description' => 'Hand-cut orange and lime peels cured with smoked peppercorns.',
                'image' => 'https://images.unsplash.com/photo-1498837167922-ddd27525d352?auto=format&fit=crop&w=800&q=80',
                'tags' => ['bright', 'small-batch'],
                'created_at' => date(DATE_ATOM),
                'updated_at' => date(DATE_ATOM),
            ],
        ];

        $this->write($seed);
    }

    private function read(): array
    {
        $contents = file_get_contents($this->filePath);

        if (!$contents) {
            return [];
        }

        $data = json_decode($contents, true);
        return is_array($data) ? $data : [];
    }

    private function write(array $products): void
    {
        file_put_contents($this->filePath, json_encode(array_values($products), JSON_PRETTY_PRINT));
    }

    private function normalize(array $product): array
    {
        $product['id'] = (int) $product['id'];
        $product['price'] = (float) $product['price'];
        $product['name'] = trim((string) $product['name']);
        $product['category'] = trim((string) ($product['category'] ?? ''));
        $product['description'] = trim((string) ($product['description'] ?? ''));
        $product['image'] = trim((string) ($product['image'] ?? ''));
        $product['tags'] = array_values(array_filter(array_map('trim', (array) ($product['tags'] ?? []))));

        return $product;
    }

    private function nextId(array $products): int
    {
        if (empty($products)) {
            return 1;
        }

        $ids = array_map(static fn ($product) => (int) $product['id'], $products);
        return max($ids) + 1;
    }
}
