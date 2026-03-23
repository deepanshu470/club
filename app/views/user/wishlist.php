<?php
$pageTitle = 'My Wishlist - ShopPremium';
require_once BASE_PATH . '/app/views/layouts/header.php';
?>

<div class="container" style="margin-top: 2rem;">
    <h1 style="margin-bottom: 2rem;"><i class="fas fa-heart"></i> My Wishlist</h1>

    <?php if (empty($wishlistItems)): ?>
        <div class="card" style="text-align: center; padding: 3rem;">
            <i class="fas fa-heart" style="font-size: 4rem; color: #9CA3AF; margin-bottom: 1rem;"></i>
            <h3>Your wishlist is empty</h3>
            <p style="color: #6B7280; margin-bottom: 2rem;">Save your favorite products to wishlist</p>
            <a href="/products" class="btn btn-primary">
                <i class="fas fa-shopping-bag"></i> Browse Products
            </a>
        </div>
    <?php else: ?>
        <div class="grid grid-4">
            <?php foreach ($wishlistItems as $product): ?>
                <div class="product-card">
                    <?php if ($product['image']): ?>
                        <img src="/public/<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>" class="product-image">
                    <?php else: ?>
                        <div class="product-image" style="background: var(--light-gray); display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-image" style="font-size: 3rem; color: #9CA3AF;"></i>
                        </div>
                    <?php endif; ?>

                    <div class="product-info">
                        <h3 class="product-title"><?= htmlspecialchars($product['name']) ?></h3>

                        <div class="product-price">
                            <?php if ($product['discount_price']): ?>
                                <span class="price-current">₹<?= number_format($product['discount_price'], 2) ?></span>
                                <span class="price-original">₹<?= number_format($product['price'], 2) ?></span>
                            <?php else: ?>
                                <span class="price-current">₹<?= number_format($product['price'], 2) ?></span>
                            <?php endif; ?>
                        </div>

                        <div style="display: flex; gap: 0.5rem;">
                            <a href="/product?id=<?= $product['id'] ?>" class="btn btn-primary" style="flex: 1; text-align: center;">
                                <i class="fas fa-eye"></i> View
                            </a>
                            <a href="/wishlist/remove?id=<?= $product['id'] ?>" class="btn btn-danger">
                                <i class="fas fa-trash"></i>
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<?php require_once BASE_PATH . '/app/views/layouts/footer.php'; ?>
