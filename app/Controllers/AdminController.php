<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Auth;
use App\Models\ProductRepository;

class AdminController extends Controller
{
    private Auth $auth;
    private ProductRepository $products;

    public function __construct(ProductRepository $products, Auth $auth)
    {
        $this->products = $products;
        $this->auth = $auth;
    }

    public function login(): void
    {
        if ($this->auth->check()) {
            $this->redirect('admin');
        }

        $this->render('admin/login', ['error' => $_GET['error'] ?? null]);
    }

    public function authenticate(): void
    {
        $username = trim($_POST['username'] ?? '');
        $password = trim($_POST['password'] ?? '');

        if ($this->auth->attempt($username, $password)) {
            $this->redirect('admin');
            return;
        }

        $this->redirect('admin/login', ['error' => 'Invalid credentials']);
    }

    public function dashboard(): void
    {
        $this->guard();

        $this->render('admin/dashboard', [
            'products' => $this->products->all(),
            'categories' => $this->products->categories(),
        ]);
    }

    public function edit(): void
    {
        $this->guard();

        $id = isset($_GET['id']) ? (int) $_GET['id'] : null;
        $product = $id ? $this->products->find($id) : null;

        $this->render('admin/edit', [
            'product' => $product,
            'categories' => $this->products->categories(),
        ]);
    }

    public function save(): void
    {
        $this->guard();

        $id = isset($_POST['id']) ? (int) $_POST['id'] : null;

        $payload = [
            'name' => trim($_POST['name'] ?? ''),
            'price' => (float) ($_POST['price'] ?? 0),
            'category' => trim($_POST['category'] ?? 'General'),
            'badge' => trim($_POST['badge'] ?? 'New'),
            'rating' => (float) ($_POST['rating'] ?? 4.5),
            'stock' => (int) ($_POST['stock'] ?? 0),
            'featured' => isset($_POST['featured']),
            'tags' => $this->csvToArray($_POST['tags'] ?? ''),
            'colors' => $this->csvToArray($_POST['colors'] ?? ''),
            'sizes' => $this->csvToArray($_POST['sizes'] ?? ''),
            'description' => trim($_POST['description'] ?? ''),
            'image' => trim($_POST['image'] ?? ''),
        ];

        if ($id) {
            $this->products->update($id, $payload);
        } else {
            $this->products->add($payload);
        }

        $this->redirect('admin');
    }

    public function logout(): void
    {
        $this->auth->logout();
        $this->redirect('admin/login');
    }

    private function guard(): void
    {
        if (!$this->auth->check()) {
            $this->redirect('admin/login');
        }
    }

    private function csvToArray(string $input): array
    {
        if (empty($input)) {
            return [];
        }

        $parts = array_map('trim', explode(',', $input));
        return array_values(array_filter($parts, fn ($part) => $part !== ''));
    }
}
