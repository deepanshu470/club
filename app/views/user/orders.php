<?php
$pageTitle = 'My Orders - ShopPremium';
require_once BASE_PATH . '/app/views/layouts/header.php';
?>

<div class="container" style="margin-top: 2rem;">
    <h1 style="margin-bottom: 2rem;"><i class="fas fa-box"></i> My Orders</h1>

    <?php if (empty($orders)): ?>
        <div class="card" style="text-align: center; padding: 3rem;">
            <i class="fas fa-box-open" style="font-size: 4rem; color: #9CA3AF; margin-bottom: 1rem;"></i>
            <h3>No orders yet</h3>
            <p style="color: #6B7280; margin-bottom: 2rem;">Start shopping to see your orders here</p>
            <a href="/products" class="btn btn-primary">
                <i class="fas fa-shopping-bag"></i> Browse Products
            </a>
        </div>
    <?php else: ?>
        <?php foreach ($orders as $order): ?>
            <div class="card" style="margin-bottom: 1.5rem;">
                <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 1rem; padding-bottom: 1rem; border-bottom: 2px solid var(--border-color);">
                    <div>
                        <h3 style="margin-bottom: 0.5rem;">
                            <i class="fas fa-receipt"></i> Order #<?= htmlspecialchars($order['order_number']) ?>
                        </h3>
                        <p style="color: #6B7280;">
                            <i class="fas fa-calendar"></i> Placed on <?= date('M d, Y', strtotime($order['created_at'])) ?>
                        </p>
                    </div>
                    <div style="text-align: right;">
                        <div style="font-size: 1.5rem; font-weight: 700; color: var(--primary-color); margin-bottom: 0.5rem;">
                            ₹<?= number_format($order['total_amount'], 2) ?>
                        </div>
                        <?php
                        $statusColors = [
                            'pending' => '#F59E0B',
                            'processing' => '#3B82F6',
                            'shipped' => '#8B5CF6',
                            'delivered' => '#10B981',
                            'cancelled' => '#EF4444'
                        ];
                        $statusColor = $statusColors[$order['status']] ?? '#6B7280';
                        ?>
                        <span style="background: <?= $statusColor ?>; color: white; padding: 0.25rem 0.75rem; border-radius: 0.25rem; font-size: 0.875rem; font-weight: 600;">
                            <i class="fas fa-circle" style="font-size: 0.5rem;"></i> <?= ucfirst($order['status']) ?>
                        </span>
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                    <div>
                        <strong><i class="fas fa-shipping-fast"></i> Shipping Address:</strong>
                        <p style="color: #6B7280; margin-top: 0.5rem;">
                            <?= htmlspecialchars($order['shipping_address']) ?><br>
                            <?= htmlspecialchars($order['shipping_city']) ?>, <?= htmlspecialchars($order['shipping_state']) ?><br>
                            PIN: <?= htmlspecialchars($order['shipping_pincode']) ?><br>
                            Phone: <?= htmlspecialchars($order['shipping_phone']) ?>
                        </p>
                    </div>
                    <div>
                        <strong><i class="fas fa-credit-card"></i> Payment:</strong>
                        <p style="color: #6B7280; margin-top: 0.5rem;">
                            Method: <?= ucfirst($order['payment_method']) ?><br>
                            Status: <?= ucfirst($order['payment_status']) ?>
                        </p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<?php require_once BASE_PATH . '/app/views/layouts/footer.php'; ?>
