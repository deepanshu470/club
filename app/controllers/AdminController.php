<?php

class AdminController {
    private $productModel;
    private $categoryModel;
    private $orderModel;
    private $userModel;

    public function __construct() {
        // Check if user is admin
        if (!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
            header('Location: /');
            exit;
        }

        $this->productModel = new Product();
        $this->categoryModel = new Category();
        $this->orderModel = new Order();
        $this->userModel = new User();
    }

    public function dashboard() {
        $totalProducts = count($this->productModel->getAll());
        $totalOrders = count($this->orderModel->getAll());
        $totalUsers = count($this->userModel->getAll());
        $recentOrders = array_slice($this->orderModel->getAll(), 0, 5);

        require_once BASE_PATH . '/app/views/admin/dashboard.php';
    }

    public function products() {
        $products = $this->productModel->getAll();
        $categories = $this->categoryModel->getAll();

        require_once BASE_PATH . '/app/views/admin/products.php';
    }

    public function addProduct() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $slug = strtolower(str_replace(' ', '-', $_POST['name']));

            $imagePath = '';
            if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
                $uploadDir = BASE_PATH . '/public/uploads/';
                $imagePath = 'uploads/' . time() . '_' . $_FILES['image']['name'];
                move_uploaded_file($_FILES['image']['tmp_name'], $uploadDir . basename($imagePath));
            }

            $data = [
                ':category_id' => $_POST['category_id'],
                ':name' => $_POST['name'],
                ':slug' => $slug,
                ':description' => $_POST['description'],
                ':price' => $_POST['price'],
                ':discount_price' => $_POST['discount_price'] ?: null,
                ':stock' => $_POST['stock'],
                ':image' => $imagePath,
                ':featured' => isset($_POST['featured']) ? 1 : 0
            ];

            $this->productModel->create($data);
            $_SESSION['success'] = 'Product added successfully';

            header('Location: /admin/products');
            exit;
        }

        $categories = $this->categoryModel->getAll();
        require_once BASE_PATH . '/app/views/admin/add_product.php';
    }

    public function editProduct() {
        $id = $_GET['id'] ?? 0;
        $product = $this->productModel->findById($id);

        if (!$product) {
            header('Location: /admin/products');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $slug = strtolower(str_replace(' ', '-', $_POST['name']));

            $imagePath = $product['image'];
            if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
                $uploadDir = BASE_PATH . '/public/uploads/';
                $imagePath = 'uploads/' . time() . '_' . $_FILES['image']['name'];
                move_uploaded_file($_FILES['image']['tmp_name'], $uploadDir . basename($imagePath));
            }

            $data = [
                ':category_id' => $_POST['category_id'],
                ':name' => $_POST['name'],
                ':slug' => $slug,
                ':description' => $_POST['description'],
                ':price' => $_POST['price'],
                ':discount_price' => $_POST['discount_price'] ?: null,
                ':stock' => $_POST['stock'],
                ':image' => $imagePath,
                ':featured' => isset($_POST['featured']) ? 1 : 0
            ];

            $this->productModel->update($id, $data);
            $_SESSION['success'] = 'Product updated successfully';

            header('Location: /admin/products');
            exit;
        }

        $categories = $this->categoryModel->getAll();
        require_once BASE_PATH . '/app/views/admin/edit_product.php';
    }

    public function deleteProduct() {
        $id = $_GET['id'] ?? 0;
        $this->productModel->delete($id);
        $_SESSION['success'] = 'Product deleted successfully';

        header('Location: /admin/products');
        exit;
    }

    public function orders() {
        $orders = $this->orderModel->getAll();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $orderId = $_POST['order_id'];
            $status = $_POST['status'];
            $this->orderModel->updateStatus($orderId, $status);
            $_SESSION['success'] = 'Order status updated';

            header('Location: /admin/orders');
            exit;
        }

        require_once BASE_PATH . '/app/views/admin/orders.php';
    }

    public function users() {
        $users = $this->userModel->getAll();
        require_once BASE_PATH . '/app/views/admin/users.php';
    }

    public function categories() {
        $categories = $this->categoryModel->getAll();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $slug = strtolower(str_replace(' ', '-', $_POST['name']));

            if (isset($_POST['id']) && $_POST['id']) {
                // Update
                $data = [
                    ':name' => $_POST['name'],
                    ':slug' => $slug,
                    ':description' => $_POST['description'] ?? '',
                    ':image' => ''
                ];
                $this->categoryModel->update($_POST['id'], $data);
                $_SESSION['success'] = 'Category updated successfully';
            } else {
                // Create
                $data = [
                    ':name' => $_POST['name'],
                    ':slug' => $slug,
                    ':description' => $_POST['description'] ?? '',
                    ':image' => ''
                ];
                $this->categoryModel->create($data);
                $_SESSION['success'] = 'Category added successfully';
            }

            header('Location: /admin/categories');
            exit;
        }

        require_once BASE_PATH . '/app/views/admin/categories.php';
    }
}
