<?php
$pageTitle = 'Search Results - ShopPremium';
require_once BASE_PATH . '/app/views/layouts/header.php';
?>

<div class="container" style="margin-top: 2rem;">
    <h1 style="margin-bottom: 2rem;">
        <i class="fas fa-search"></i> Search Results for "<?= htmlspecialchars($keyword) ?>"
    </h1>

    <?php if (empty($products)): ?>
        <div class="card" style="text-align: center; padding: 3rem;">
            <i class="fas fa-search" style="font-size: 4rem; color: #9CA3AF; margin-bottom: 1rem;"></i>
            <h3>No products found</h3>
            <p style="color: #6B7280;">Try searching with different keywords</p>
        </div>
    <?php else: ?>
        <p style="margin-bottom: 2rem; color: #6B7280;">Found <?= count($products) ?> product(s)</p>

        <div class="grid grid-4">
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
                            <?php else: ?>
                                <span class="price-current">₹<?= number_format($product['price'], 2) ?></span>
                            <?php endif; ?>
                        </div>

                        <a href="/product?id=<?= $product['id'] ?>" class="btn btn-primary" style="width: 100%; text-align: center;">
                            <i class="fas fa-eye"></i> View Details
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<?php require_once BASE_PATH . '/app/views/layouts/footer.php'; ?>
