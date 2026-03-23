<?php
$pageTitle = 'Shopping Cart - ShopPremium';
require_once BASE_PATH . '/app/views/layouts/header.php';
?>

<div class="container" style="margin-top: 2rem;">
    <h1 style="margin-bottom: 2rem;"><i class="fas fa-shopping-cart"></i> Shopping Cart</h1>

    <?php if (empty($cartItems)): ?>
        <div class="card" style="text-align: center; padding: 3rem;">
            <i class="fas fa-shopping-cart" style="font-size: 4rem; color: #9CA3AF; margin-bottom: 1rem;"></i>
            <h3>Your cart is empty</h3>
            <p style="color: #6B7280; margin-bottom: 2rem;">Add some products to your cart</p>
            <a href="/products" class="btn btn-primary">
                <i class="fas fa-shopping-bag"></i> Continue Shopping
            </a>
        </div>
    <?php else: ?>
        <div style="display: grid; grid-template-columns: 1fr 400px; gap: 2rem;">
            <!-- Cart Items -->
            <div>
                <?php foreach ($cartItems as $item): ?>
                    <div class="card" style="margin-bottom: 1rem;">
                        <div style="display: grid; grid-template-columns: 120px 1fr auto; gap: 1.5rem; align-items: center;">
                            <!-- Product Image -->
                            <div>
                                <?php if ($item['product']['image']): ?>
                                    <img src="/public/<?= htmlspecialchars($item['product']['image']) ?>"
                                         alt="<?= htmlspecialchars($item['product']['name']) ?>"
                                         style="width: 100%; border-radius: 0.5rem;">
                                <?php else: ?>
                                    <div style="width: 100%; height: 120px; background: var(--light-gray); border-radius: 0.5rem; display: flex; align-items: center; justify-content: center;">
                                        <i class="fas fa-image" style="font-size: 2rem; color: #9CA3AF;"></i>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <!-- Product Info -->
                            <div>
                                <h3 style="margin-bottom: 0.5rem;">
                                    <a href="/product?id=<?= $item['product']['id'] ?>" style="text-decoration: none; color: inherit;">
                                        <?= htmlspecialchars($item['product']['name']) ?>
                                    </a>
                                </h3>
                                <p style="color: #6B7280; margin-bottom: 1rem;">
                                    ₹<?= number_format($item['product']['discount_price'] ?? $item['product']['price'], 2) ?> each
                                </p>

                                <form method="POST" action="/cart/update" style="display: flex; align-items: center; gap: 1rem;">
                                    <input type="hidden" name="product_id" value="<?= $item['product']['id'] ?>">
                                    <label style="font-weight: 600;">Quantity:</label>
                                    <input type="number" name="quantity" value="<?= $item['quantity'] ?>" min="1"
                                           max="<?= $item['product']['stock'] ?>" class="form-control" style="width: 80px;">
                                    <button type="submit" class="btn btn-secondary">
                                        <i class="fas fa-sync"></i> Update
                                    </button>
                                </form>
                            </div>

                            <!-- Subtotal & Actions -->
                            <div style="text-align: right;">
                                <div style="font-size: 1.5rem; font-weight: 700; color: var(--primary-color); margin-bottom: 1rem;">
                                    ₹<?= number_format($item['subtotal'], 2) ?>
                                </div>
                                <a href="/cart/remove?id=<?= $item['product']['id'] ?>" class="btn btn-danger">
                                    <i class="fas fa-trash"></i> Remove
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Cart Summary -->
            <div>
                <div class="card">
                    <h3 style="margin-bottom: 1.5rem;"><i class="fas fa-receipt"></i> Order Summary</h3>

                    <div style="display: flex; justify-content: space-between; margin-bottom: 1rem; padding-bottom: 1rem; border-bottom: 2px solid var(--border-color);">
                        <span>Subtotal:</span>
                        <span style="font-weight: 600;">₹<?= number_format($total, 2) ?></span>
                    </div>

                    <div style="display: flex; justify-content: space-between; margin-bottom: 1rem; padding-bottom: 1rem; border-bottom: 2px solid var(--border-color);">
                        <span>Shipping:</span>
                        <span style="font-weight: 600; color: var(--secondary-color);">
                            <?= $total >= 999 ? 'FREE' : '₹50.00' ?>
                        </span>
                    </div>

                    <div style="display: flex; justify-content: space-between; margin-bottom: 2rem; font-size: 1.25rem;">
                        <strong>Total:</strong>
                        <strong style="color: var(--primary-color);">
                            ₹<?= number_format($total >= 999 ? $total : $total + 50, 2) ?>
                        </strong>
                    </div>

                    <?php if (isset($_SESSION['user_id'])): ?>
                        <a href="/checkout" class="btn btn-primary" style="width: 100%; text-align: center;">
                            <i class="fas fa-lock"></i> Proceed to Checkout
                        </a>
                    <?php else: ?>
                        <a href="/login" class="btn btn-primary" style="width: 100%; text-align: center;">
                            <i class="fas fa-sign-in-alt"></i> Login to Checkout
                        </a>
                    <?php endif; ?>

                    <a href="/products" class="btn btn-outline" style="width: 100%; text-align: center; margin-top: 1rem;">
                        <i class="fas fa-arrow-left"></i> Continue Shopping
                    </a>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>

<?php require_once BASE_PATH . '/app/views/layouts/footer.php'; ?>
