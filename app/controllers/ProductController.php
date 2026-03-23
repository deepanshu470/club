<?php

declare(strict_types=1);

class ProductController extends BaseController
{
    private ProductRepository $products;

    public function __construct(ProductRepository $products)
    {
        $this->products = $products;
    }

    public function index(): void
    {
        $this->render('products', [
            'products' => $this->products->all(),
        ]);
    }

    public function show(int $id): void
    {
        $product = $this->products->find($id);

        if (!$product) {
            http_response_code(404);
            $this->render('not-found', ['message' => 'Product not found']);
            return;
        }

        $this->render('product-detail', [
            'product' => $product,
            'recommendations' => $this->products->featured(),
        ]);
    }
}
