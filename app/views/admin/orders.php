<?php require_once BASE_PATH . '/app/views/admin/header.php'; ?>

<h1 style="margin-bottom: 2rem;"><i class="fas fa-shopping-cart"></i> Orders Management</h1>

<?php if (isset($_SESSION['success'])): ?>
    <div class="alert alert-success">
        <i class="fas fa-check-circle"></i> <?= htmlspecialchars($_SESSION['success']) ?>
    </div>
    <?php unset($_SESSION['success']); ?>
<?php endif; ?>

<div class="card">
    <?php if (empty($orders)): ?>
        <p style="text-align: center; color: #6B7280; padding: 2rem;">No orders found</p>
    <?php else: ?>
        <table class="table">
            <thead>
                <tr>
                    <th>Order #</th>
                    <th>Customer</th>
                    <th>Email</th>
                    <th>Amount</th>
                    <th>Payment</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orders as $order): ?>
                    <tr>
                        <td><strong><?= htmlspecialchars($order['order_number']) ?></strong></td>
                        <td><?= htmlspecialchars($order['user_name']) ?></td>
                        <td><?= htmlspecialchars($order['user_email']) ?></td>
                        <td><strong>₹<?= number_format($order['total_amount'], 2) ?></strong></td>
                        <td><?= ucfirst($order['payment_method']) ?></td>
                        <td>
                            <form method="POST" action="/admin/orders" style="display: inline;">
                                <input type="hidden" name="order_id" value="<?= $order['id'] ?>">
                                <select name="status" class="form-control" style="width: auto; padding: 0.25rem 0.5rem; font-size: 0.875rem;" onchange="this.form.submit()">
                                    <option value="pending" <?= $order['status'] === 'pending' ? 'selected' : '' ?>>Pending</option>
                                    <option value="processing" <?= $order['status'] === 'processing' ? 'selected' : '' ?>>Processing</option>
                                    <option value="shipped" <?= $order['status'] === 'shipped' ? 'selected' : '' ?>>Shipped</option>
                                    <option value="delivered" <?= $order['status'] === 'delivered' ? 'selected' : '' ?>>Delivered</option>
                                    <option value="cancelled" <?= $order['status'] === 'cancelled' ? 'selected' : '' ?>>Cancelled</option>
                                </select>
                            </form>
                        </td>
                        <td><?= date('M d, Y', strtotime($order['created_at'])) ?></td>
                        <td>
                            <button onclick="toggleOrderDetails(<?= $order['id'] ?>)" class="btn btn-secondary" style="padding: 0.5rem 0.75rem;">
                                <i class="fas fa-eye"></i> View
                            </button>
                        </td>
                    </tr>
                    <tr id="order-details-<?= $order['id'] ?>" style="display: none;">
                        <td colspan="8" style="background: var(--light-gray);">
                            <div style="padding: 1rem;">
                                <strong><i class="fas fa-shipping-fast"></i> Shipping Address:</strong>
                                <p style="margin: 0.5rem 0;">
                                    <?= htmlspecialchars($order['shipping_address']) ?>,
                                    <?= htmlspecialchars($order['shipping_city']) ?>,
                                    <?= htmlspecialchars($order['shipping_state']) ?> -
                                    <?= htmlspecialchars($order['shipping_pincode']) ?>
                                    <br>Phone: <?= htmlspecialchars($order['shipping_phone']) ?>
                                </p>
                                <?php if ($order['notes']): ?>
                                    <strong><i class="fas fa-note-sticky"></i> Notes:</strong>
                                    <p style="margin: 0.5rem 0;"><?= htmlspecialchars($order['notes']) ?></p>
                                <?php endif; ?>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<script>
function toggleOrderDetails(orderId) {
    const row = document.getElementById('order-details-' + orderId);
    row.style.display = row.style.display === 'none' ? '' : 'none';
}
</script>

<?php require_once BASE_PATH . '/app/views/admin/footer.php'; ?>
