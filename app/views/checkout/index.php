<?php
$pageTitle = 'Checkout - ShopPremium';
require_once BASE_PATH . '/app/views/layouts/header.php';
?>

<div class="container" style="margin-top: 2rem;">
    <h1 style="margin-bottom: 2rem;"><i class="fas fa-credit-card"></i> Checkout</h1>

    <div style="display: grid; grid-template-columns: 1fr 400px; gap: 2rem;">
        <!-- Checkout Form -->
        <div class="card">
            <h2 style="margin-bottom: 1.5rem;">Shipping Information</h2>

            <form method="POST" action="/checkout/process">
                <div class="form-group">
                    <label class="form-label">Full Name *</label>
                    <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($user['name']) ?>" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Phone Number *</label>
                    <input type="tel" name="phone" class="form-control" value="<?= htmlspecialchars($user['phone'] ?? '') ?>" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Address *</label>
                    <textarea name="address" class="form-control" rows="3" required><?= htmlspecialchars($user['address'] ?? '') ?></textarea>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                    <div class="form-group">
                        <label class="form-label">City *</label>
                        <input type="text" name="city" class="form-control" value="<?= htmlspecialchars($user['city'] ?? '') ?>" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">State *</label>
                        <input type="text" name="state" class="form-control" value="<?= htmlspecialchars($user['state'] ?? '') ?>" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">PIN Code *</label>
                    <input type="text" name="pincode" class="form-control" value="<?= htmlspecialchars($user['pincode'] ?? '') ?>" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Payment Method *</label>
                    <select name="payment_method" class="form-control" required>
                        <option value="cod">Cash on Delivery</option>
                        <option value="upi">UPI</option>
                        <option value="card">Credit/Debit Card</option>
                        <option value="netbanking">Net Banking</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Order Notes (Optional)</label>
                    <textarea name="notes" class="form-control" rows="3"></textarea>
                </div>

                <button type="submit" class="btn btn-primary" style="width: 100%;">
                    <i class="fas fa-check"></i> Place Order
                </button>
            </form>
        </div>

        <!-- Order Summary -->
        <div>
            <div class="card">
                <h3 style="margin-bottom: 1.5rem;"><i class="fas fa-box"></i> Order Summary</h3>

                <?php foreach ($cartItems as $item): ?>
                    <div style="display: flex; justify-content: space-between; margin-bottom: 1rem; padding-bottom: 1rem; border-bottom: 1px solid var(--border-color);">
                        <div>
                            <strong><?= htmlspecialchars($item['product']['name']) ?></strong>
                            <br>
                            <small style="color: #6B7280;">Qty: <?= $item['quantity'] ?></small>
                        </div>
                        <div style="font-weight: 600;">
                            ₹<?= number_format($item['subtotal'], 2) ?>
                        </div>
                    </div>
                <?php endforeach; ?>

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

                <div style="display: flex; justify-content: space-between; font-size: 1.25rem;">
                    <strong>Total:</strong>
                    <strong style="color: var(--primary-color);">
                        ₹<?= number_format($total >= 999 ? $total : $total + 50, 2) ?>
                    </strong>
                </div>
            </div>

            <div class="card" style="margin-top: 1rem; background: var(--light-gray);">
                <div style="display: flex; align-items: start; gap: 1rem;">
                    <i class="fas fa-shield-alt" style="color: var(--primary-color); font-size: 2rem;"></i>
                    <div>
                        <strong>Secure Checkout</strong>
                        <p style="color: #6B7280; margin-top: 0.5rem; font-size: 0.875rem;">
                            Your payment information is processed securely. We do not store credit card details.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once BASE_PATH . '/app/views/layouts/footer.php'; ?>
