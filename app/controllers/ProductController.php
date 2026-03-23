<?php

class ProductController {
    private $productModel;
    private $categoryModel;

    public function __construct() {
        $this->productModel = new Product();
        $this->categoryModel = new Category();
    }

    public function index() {
        $categoryId = $_GET['category'] ?? null;

        if ($categoryId) {
            $products = $this->productModel->getByCategory($categoryId);
            $category = $this->categoryModel->findById($categoryId);
        } else {
            $products = $this->productModel->getAll();
            $category = null;
        }

        $categories = $this->categoryModel->getAll();

        require_once BASE_PATH . '/app/views/products/index.php';
    }

    public function show() {
        $id = $_GET['id'] ?? 0;
        $product = $this->productModel->findById($id);

        if (!$product) {
            http_response_code(404);
            echo "Product not found";
            return;
        }

        $reviews = $this->productModel->getReviews($id);
        $ratingData = $this->productModel->getAverageRating($id);

        require_once BASE_PATH . '/app/views/products/show.php';
    }

    public function search() {
        $keyword = $_GET['q'] ?? '';
        $products = $this->productModel->search($keyword);
        $categories = $this->categoryModel->getAll();

        require_once BASE_PATH . '/app/views/products/search.php';
    }
}
