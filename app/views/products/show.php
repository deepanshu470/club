<?php
$pageTitle = htmlspecialchars($product['name']) . ' - ShopPremium';
require_once BASE_PATH . '/app/views/layouts/header.php';
?>

<div class="container" style="margin-top: 2rem;">
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 3rem;">
        <!-- Product Image -->
        <div>
            <?php if ($product['image']): ?>
                <img src="/public/<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>"
                     style="width: 100%; border-radius: 1rem; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
            <?php else: ?>
                <div style="width: 100%; height: 500px; background: var(--light-gray); border-radius: 1rem; display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-image" style="font-size: 5rem; color: #9CA3AF;"></i>
                </div>
            <?php endif; ?>
        </div>

        <!-- Product Details -->
        <div class="card">
            <div class="product-category" style="margin-bottom: 1rem;">
                <i class="fas fa-tag"></i> <?= htmlspecialchars($product['category_name'] ?? 'Uncategorized') ?>
            </div>

            <h1 style="margin-bottom: 1rem; font-size: 2rem;"><?= htmlspecialchars($product['name']) ?></h1>

            <?php if ($ratingData['total_reviews'] > 0): ?>
                <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 1rem;">
                    <?php
                    $avgRating = round($ratingData['avg_rating']);
                    for ($i = 1; $i <= 5; $i++):
                        if ($i <= $avgRating):
                    ?>
                        <i class="fas fa-star" style="color: #F59E0B;"></i>
                    <?php else: ?>
                        <i class="far fa-star" style="color: #F59E0B;"></i>
                    <?php
                        endif;
                    endfor;
                    ?>
                    <span style="color: #6B7280;">(<?= $ratingData['total_reviews'] ?> reviews)</span>
                </div>
            <?php endif; ?>

            <div class="product-price" style="margin-bottom: 2rem;">
                <?php if ($product['discount_price']): ?>
                    <span class="price-current" style="font-size: 2.5rem;">₹<?= number_format($product['discount_price'], 2) ?></span>
                    <span class="price-original" style="font-size: 1.5rem;">₹<?= number_format($product['price'], 2) ?></span>
                    <?php
                    $discount = round((($product['price'] - $product['discount_price']) / $product['price']) * 100);
                    ?>
                    <span class="discount-badge"><?= $discount ?>% OFF</span>
                <?php else: ?>
                    <span class="price-current" style="font-size: 2.5rem;">₹<?= number_format($product['price'], 2) ?></span>
                <?php endif; ?>
            </div>

            <p style="color: #6B7280; margin-bottom: 2rem; line-height: 1.8;">
                <?= nl2br(htmlspecialchars($product['description'])) ?>
            </p>

            <div style="margin-bottom: 2rem;">
                <span style="font-weight: 600;">Stock:</span>
                <?php if ($product['stock'] > 0): ?>
                    <span style="color: var(--secondary-color);">
                        <i class="fas fa-check-circle"></i> In Stock (<?= $product['stock'] ?> available)
                    </span>
                <?php else: ?>
                    <span style="color: #EF4444;">
                        <i class="fas fa-times-circle"></i> Out of Stock
                    </span>
                <?php endif; ?>
            </div>

            <?php if ($product['stock'] > 0): ?>
                <form method="POST" action="/cart/add">
                    <input type="hidden" name="product_id" value="<?= $product['id'] ?>">

                    <div class="form-group">
                        <label class="form-label">Quantity</label>
                        <input type="number" name="quantity" value="1" min="1" max="<?= $product['stock'] ?>"
                               class="form-control" style="max-width: 150px;">
                    </div>

                    <div style="display: flex; gap: 1rem;">
                        <button type="submit" class="btn btn-primary" style="flex: 1;">
                            <i class="fas fa-cart-plus"></i> Add to Cart
                        </button>
                        <?php if (isset($_SESSION['user_id'])): ?>
                            <form method="POST" action="/wishlist/add" style="flex: 0;">
                                <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                                <button type="submit" class="btn btn-outline">
                                    <i class="fas fa-heart"></i>
                                </button>
                            </form>
                        <?php endif; ?>
                    </div>
                </form>
            <?php endif; ?>
        </div>
    </div>

    <!-- Reviews Section -->
    <div style="margin-top: 3rem;">
        <h2 style="margin-bottom: 2rem;"><i class="fas fa-comments"></i> Customer Reviews</h2>

        <?php if (empty($reviews)): ?>
            <div class="card" style="text-align: center; padding: 2rem;">
                <i class="fas fa-comment-slash" style="font-size: 3rem; color: #9CA3AF; margin-bottom: 1rem;"></i>
                <p style="color: #6B7280;">No reviews yet. Be the first to review this product!</p>
            </div>
        <?php else: ?>
            <?php foreach ($reviews as $review): ?>
                <div class="card" style="margin-bottom: 1rem;">
                    <div style="display: flex; justify-content: space-between; margin-bottom: 0.5rem;">
                        <strong><i class="fas fa-user"></i> <?= htmlspecialchars($review['user_name']) ?></strong>
                        <div>
                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                <?php if ($i <= $review['rating']): ?>
                                    <i class="fas fa-star" style="color: #F59E0B;"></i>
                                <?php else: ?>
                                    <i class="far fa-star" style="color: #F59E0B;"></i>
                                <?php endif; ?>
                            <?php endfor; ?>
                        </div>
                    </div>
                    <p style="color: #6B7280;"><?= nl2br(htmlspecialchars($review['comment'])) ?></p>
                    <small style="color: #9CA3AF;">
                        <i class="fas fa-clock"></i> <?= date('M d, Y', strtotime($review['created_at'])) ?>
                    </small>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<?php require_once BASE_PATH . '/app/views/layouts/footer.php'; ?>
