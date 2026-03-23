<?php require_once BASE_PATH . '/app/views/admin/header.php'; ?>

<h1 style="margin-bottom: 2rem;"><i class="fas fa-dashboard"></i> Dashboard</h1>

<!-- Stats Cards -->
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-value"><?= $totalProducts ?></div>
        <div class="stat-label"><i class="fas fa-box"></i> Total Products</div>
    </div>

    <div class="stat-card">
        <div class="stat-value"><?= $totalOrders ?></div>
        <div class="stat-label"><i class="fas fa-shopping-cart"></i> Total Orders</div>
    </div>

    <div class="stat-card">
        <div class="stat-value"><?= $totalUsers ?></div>
        <div class="stat-label"><i class="fas fa-users"></i> Total Users</div>
    </div>

    <div class="stat-card">
        <div class="stat-value" style="color: var(--secondary-color);">
            <?php
            $revenue = 0;
            foreach ($recentOrders as $order) {
                if ($order['payment_status'] === 'completed') {
                    $revenue += $order['total_amount'];
                }
            }
            echo '₹' . number_format($revenue, 0);
            ?>
        </div>
        <div class="stat-label"><i class="fas fa-dollar-sign"></i> Revenue</div>
    </div>
</div>

<!-- Recent Orders -->
<div class="card">
    <h2 style="margin-bottom: 1.5rem;"><i class="fas fa-clock"></i> Recent Orders</h2>

    <?php if (empty($recentOrders)): ?>
        <p style="text-align: center; color: #6B7280; padding: 2rem;">No orders yet</p>
    <?php else: ?>
        <table class="table">
            <thead>
                <tr>
                    <th>Order #</th>
                    <th>Customer</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($recentOrders as $order): ?>
                    <tr>
                        <td><strong><?= htmlspecialchars($order['order_number']) ?></strong></td>
                        <td><?= htmlspecialchars($order['user_name']) ?></td>
                        <td><strong>₹<?= number_format($order['total_amount'], 2) ?></strong></td>
                        <td>
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
                            <span style="background: <?= $statusColor ?>; color: white; padding: 0.25rem 0.75rem; border-radius: 0.25rem; font-size: 0.875rem;">
                                <?= ucfirst($order['status']) ?>
                            </span>
                        </td>
                        <td><?= date('M d, Y', strtotime($order['created_at'])) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div style="text-align: center; margin-top: 1.5rem;">
            <a href="/admin/orders" class="btn btn-outline">
                <i class="fas fa-arrow-right"></i> View All Orders
            </a>
        </div>
    <?php endif; ?>
</div>

<?php require_once BASE_PATH . '/app/views/admin/footer.php'; ?>
