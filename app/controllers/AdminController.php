<?php

declare(strict_types=1);

class AdminController extends BaseController
{
    private ProductRepository $products;
    private const EMAIL = 'admin@achar.club';
    private const PASSWORD = 'letmein123';

    public function __construct(ProductRepository $products)
    {
        $this->products = $products;
    }

    public function index(): void
    {
        $this->render('admin', [
            'products' => $this->products->all(),
            'isAuthenticated' => $this->isAuthenticated(),
            'flash' => $_SESSION['flash'] ?? null,
        ]);

        unset($_SESSION['flash']);
    }

    public function login(string $email, string $password): void
    {
        if ($email === self::EMAIL && $password === self::PASSWORD) {
            $_SESSION['admin_logged_in'] = true;
            $this->flash('Welcome back, curator!');
        } else {
            $this->flash('Invalid credentials', 'error');
        }
    }

    public function logout(): void
    {
        unset($_SESSION['admin_logged_in']);
        $this->flash('Signed out');
    }

    public function saveProduct(array $input): void
    {
        if (!$this->isAuthenticated()) {
            $this->flash('Please log in to continue', 'error');
            return;
        }

        $name = trim($input['name'] ?? '');
        $price = (float) ($input['price'] ?? 0);

        if ($name === '' || $price <= 0) {
            $this->flash('Name and a positive price are required', 'error');
            return;
        }

        $payload = [
            'id' => !empty($input['id']) ? (int) $input['id'] : null,
            'name' => $name,
            'price' => $price,
            'category' => trim($input['category'] ?? 'Collection'),
            'description' => trim($input['description'] ?? ''),
            'image' => trim($input['image'] ?? ''),
            'tags' => $this->parseTags($input['tags'] ?? ''),
        ];

        $this->products->save($payload);
        $this->flash($payload['id'] ? 'Product updated' : 'Product added');
    }

    public function deleteProduct(int $id): void
    {
        if (!$this->isAuthenticated()) {
            $this->flash('Please log in to continue', 'error');
            return;
        }

        $this->products->delete($id);
        $this->flash('Product removed');
    }

    private function isAuthenticated(): bool
    {
        return ($_SESSION['admin_logged_in'] ?? false) === true;
    }

    private function parseTags(string $raw): array
    {
        if ($raw === '') {
            return [];
        }

        $items = array_map('trim', explode(',', $raw));
        return array_values(array_filter($items));
    }

    private function flash(string $message, string $type = 'success'): void
    {
        $_SESSION['flash'] = ['message' => $message, 'type' => $type];
    }
}
