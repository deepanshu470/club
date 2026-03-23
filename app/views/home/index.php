<?php
$pageTitle = 'Premium E-Commerce Store - Shop the Best Products';
require_once BASE_PATH . '/app/views/layouts/header.php';
?>

<!-- Hero Section -->
<section class="hero">
    <div class="container">
        <h1><i class="fas fa-gift"></i> Welcome to ShopPremium</h1>
        <p>Discover amazing products at unbeatable prices</p>
        <a href="/products" class="btn btn-outline" style="margin-right: 1rem;">
            <i class="fas fa-shopping-bag"></i> Shop Now
        </a>
        <a href="#featured" class="btn btn-secondary">
            <i class="fas fa-star"></i> View Featured
        </a>
    </div>
</section>

<!-- Categories Section -->
<section class="container" style="margin-top: 3rem;">
    <h2 style="text-align: center; margin-bottom: 2rem; font-size: 2rem;">
        <i class="fas fa-th-large"></i> Shop by Category
    </h2>
    <div class="grid grid-3">
        <?php foreach ($categories as $category): ?>
            <a href="/products?category=<?= $category['id'] ?>" class="card" style="text-decoration: none; text-align: center; transition: all 0.3s;">
                <i class="fas fa-box" style="font-size: 3rem; color: var(--primary-color); margin-bottom: 1rem;"></i>
                <h3 style="color: var(--dark-color); margin-bottom: 0.5rem;"><?= htmlspecialchars($category['name']) ?></h3>
                <p style="color: #6B7280;"><?= htmlspecialchars($category['description']) ?></p>
            </a>
        <?php endforeach; ?>
    </div>
</section>

<!-- Featured Products -->
<section class="container" id="featured" style="margin-top: 4rem;">
    <h2 style="text-align: center; margin-bottom: 2rem; font-size: 2rem;">
        <i class="fas fa-star"></i> Featured Products
    </h2>

    <?php if (empty($featuredProducts)): ?>
        <p style="text-align: center; color: #6B7280;">No featured products available at the moment.</p>
    <?php else: ?>
        <div class="grid grid-4">
            <?php foreach ($featuredProducts as $product): ?>
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
                                    <i class="fas fa-cart-plus"></i> Add
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <div style="text-align: center; margin-top: 2rem;">
        <a href="/products" class="btn btn-outline">
            <i class="fas fa-arrow-right"></i> View All Products
        </a>
    </div>
</section>

<!-- Features Section -->
<section class="container" style="margin-top: 4rem;">
    <div class="grid grid-4">
        <div class="card" style="text-align: center;">
            <i class="fas fa-shipping-fast" style="font-size: 3rem; color: var(--primary-color); margin-bottom: 1rem;"></i>
            <h3 style="margin-bottom: 0.5rem;">Fast Shipping</h3>
            <p style="color: #6B7280;">Free shipping on orders over ₹999</p>
        </div>
        <div class="card" style="text-align: center;">
            <i class="fas fa-shield-alt" style="font-size: 3rem; color: var(--primary-color); margin-bottom: 1rem;"></i>
            <h3 style="margin-bottom: 0.5rem;">Secure Payment</h3>
            <p style="color: #6B7280;">100% secure payment processing</p>
        </div>
        <div class="card" style="text-align: center;">
            <i class="fas fa-undo" style="font-size: 3rem; color: var(--primary-color); margin-bottom: 1rem;"></i>
            <h3 style="margin-bottom: 0.5rem;">Easy Returns</h3>
            <p style="color: #6B7280;">30-day return policy</p>
        </div>
        <div class="card" style="text-align: center;">
            <i class="fas fa-headset" style="font-size: 3rem; color: var(--primary-color); margin-bottom: 1rem;"></i>
            <h3 style="margin-bottom: 0.5rem;">24/7 Support</h3>
            <p style="color: #6B7280;">Round the clock customer support</p>
        </div>
    </div>
</section>

<?php require_once BASE_PATH . '/app/views/layouts/footer.php'; ?>
