<?php
$pageTitle = 'All Products - ShopPremium';
require_once BASE_PATH . '/app/views/layouts/header.php';
?>

<div class="container" style="margin-top: 2rem;">
    <h1 style="margin-bottom: 2rem;">
        <i class="fas fa-shopping-bag"></i>
        <?= $category ? htmlspecialchars($category['name']) : 'All Products' ?>
    </h1>

    <div style="display: grid; grid-template-columns: 250px 1fr; gap: 2rem;">
        <!-- Sidebar -->
        <aside class="sidebar">
            <h3 class="sidebar-title"><i class="fas fa-filter"></i> Categories</h3>
            <ul class="category-list">
                <li class="category-item">
                    <a href="/products" style="text-decoration: none; color: inherit;">
                        <i class="fas fa-list"></i> All Products
                    </a>
                </li>
                <?php foreach ($categories as $cat): ?>
                    <li class="category-item">
                        <a href="/products?category=<?= $cat['id'] ?>" style="text-decoration: none; color: inherit;">
                            <i class="fas fa-tag"></i> <?= htmlspecialchars($cat['name']) ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </aside>

        <!-- Products Grid -->
        <div>
            <?php if (empty($products)): ?>
                <div class="card" style="text-align: center; padding: 3rem;">
                    <i class="fas fa-box-open" style="font-size: 4rem; color: #9CA3AF; margin-bottom: 1rem;"></i>
                    <h3>No products found</h3>
                    <p style="color: #6B7280;">Check back later for new products!</p>
                </div>
            <?php else: ?>
                <div class="grid grid-3">
                    <?php foreach ($products as $product): ?>
                        <div class="product-card">
                            <?php if ($product['image']): ?>
                                <img src="/public/<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>" class="product-image">
                            <?php else: ?>
                                <div class="product-image" style="background: var(--light-gray); display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-image" style="font-size: 3rem; color: #9CA3AF;"></i>
                                </div>
                            <?php endif; ?>

                            <div class="product-info">
                                <div class="product-category">
                                    <i class="fas fa-tag"></i> <?= htmlspecialchars($product['category_name'] ?? 'Uncategorized') ?>
                                </div>
                                <h3 class="product-title"><?= htmlspecialchars($product['name']) ?></h3>

                                <div class="product-price">
                                    <?php if ($product['discount_price']): ?>
                                        <span class="price-current">₹<?= number_format($product['discount_price'], 2) ?></span>
                                        <span class="price-original">₹<?= number_format($product['price'], 2) ?></span>
                                        <?php
                                        $discount = round((($product['price'] - $product['discount_price']) / $product['price']) * 100);
                                        ?>
                                        <span class="discount-badge"><?= $discount ?>% OFF</span>
                                    <?php else: ?>
                                        <span class="price-current">₹<?= number_format($product['price'], 2) ?></span>
                                    <?php endif; ?>
                                </div>

                                <div style="display: flex; gap: 0.5rem;">
                                    <a href="/product?id=<?= $product['id'] ?>" class="btn btn-primary" style="flex: 1; text-align: center;">
                                        <i class="fas fa-eye"></i> View
                                    </a>
                                    <form method="POST" action="/cart/add" style="flex: 1;">
                                        <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                                        <input type="hidden" name="quantity" value="1">
                                        <button type="submit" class="btn btn-secondary" style="width: 100%;">
                                            <i class="fas fa-cart-plus"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php require_once BASE_PATH . '/app/views/layouts/footer.php'; ?>
