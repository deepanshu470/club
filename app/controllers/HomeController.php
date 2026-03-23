<?php

declare(strict_types=1);

class HomeController extends BaseController
{
    private ProductRepository $products;

    public function __construct(ProductRepository $products)
    {
        $this->products = $products;
    }

    public function index(): void
    {
        $this->render('home', [
            'featured' => $this->products->featured(3),
            'all' => $this->products->all(),
        ]);
    }
}
