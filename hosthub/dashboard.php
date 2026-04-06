<?php
require_once 'includes/config.php';

if (!is_logged_in()) {
    redirect('login.php');
}

$user_id = $_SESSION['user_id'];
$user = get_user_data($user_id);

// Get user's orders
$orders_query = "SELECT o.*, h.plan_name, h.disk_space, h.bandwidth
                FROM orders o
                JOIN hosting_plans h ON o.plan_id = h.id
                WHERE o.user_id = $user_id
                ORDER BY o.order_date DESC";
$orders_result = $conn->query($orders_query);

include 'includes/header.php';
?>

<main class="dashboard-page">
    <div class="container">
        <div class="dashboard-header">
            <h1>Welcome, <?php echo htmlspecialchars($user['full_name']); ?>! 👋</h1>
            <p>Manage your hosting services and account settings</p>
        </div>

        <?php
        echo get_error_message();
        echo get_success_message();
        ?>

        <!-- Dashboard Stats -->
        <div class="dashboard-stats">
            <div class="stat-card">
                <div class="stat-icon">🌐</div>
                <div class="stat-info">
                    <h3><?php echo $orders_result->num_rows; ?></h3>
                    <p>Active Services</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">📊</div>
                <div class="stat-info">
                    <h3>99.9%</h3>
                    <p>Uptime</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">💬</div>
                <div class="stat-info">
                    <h3>24/7</h3>
                    <p>Support Available</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">✓</div>
                <div class="stat-info">
                    <h3>Active</h3>
                    <p>Account Status</p>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="quick-actions">
            <h2>Quick Actions</h2>
            <div class="actions-grid">
                <a href="plans.php" class="action-card">
                    <div class="action-icon">➕</div>
                    <h3>Order New Service</h3>
                    <p>Upgrade or add new hosting</p>
                </a>
                <a href="#" class="action-card">
                    <div class="action-icon">📧</div>
                    <h3>Email Management</h3>
                    <p>Manage email accounts</p>
                </a>
                <a href="#" class="action-card">
                    <div class="action-icon">🔒</div>
                    <h3>SSL Certificates</h3>
                    <p>View & manage SSL</p>
                </a>
                <a href="contact.php" class="action-card">
                    <div class="action-icon">💬</div>
                    <h3>Support Tickets</h3>
                    <p>Get help from support</p>
                </a>
            </div>
        </div>

        <!-- Services List -->
        <div class="services-section">
            <h2>Your Hosting Services</h2>

            <?php if ($orders_result->num_rows > 0): ?>
            <div class="table-responsive">
                <table class="services-table">
                    <thead>
                        <tr>
                            <th>Plan</th>
                            <th>Domain</th>
                            <th>Storage</th>
                            <th>Bandwidth</th>
                            <th>Status</th>
                            <th>Expiry Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($order = $orders_result->fetch_assoc()): ?>
                        <tr>
                            <td><strong><?php echo htmlspecialchars($order['plan_name']); ?></strong></td>
                            <td><?php echo htmlspecialchars($order['domain_name']); ?></td>
                            <td><?php echo htmlspecialchars($order['disk_space']); ?></td>
                            <td><?php echo htmlspecialchars($order['bandwidth']); ?></td>
                            <td>
                                <span class="status-badge status-<?php echo $order['order_status']; ?>">
                                    <?php echo ucfirst($order['order_status']); ?>
                                </span>
                            </td>
                            <td>
                                <?php
                                echo $order['expiry_date'] ? date('M d, Y', strtotime($order['expiry_date'])) : 'N/A';
                                ?>
                            </td>
                            <td>
                                <a href="#" class="btn btn-sm">Manage</a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
            <?php else: ?>
            <div class="empty-state">
                <div class="empty-icon">📦</div>
                <h3>No Active Services</h3>
                <p>You don't have any hosting services yet.</p>
                <a href="plans.php" class="btn btn-primary">View Hosting Plans</a>
            </div>
            <?php endif; ?>
        </div>

        <!-- Account Information -->
        <div class="account-info">
            <h2>Account Information</h2>
            <div class="info-grid">
                <div class="info-item">
                    <label>Username:</label>
                    <span><?php echo htmlspecialchars($user['username']); ?></span>
                </div>
                <div class="info-item">
                    <label>Email:</label>
                    <span><?php echo htmlspecialchars($user['email']); ?></span>
                </div>
                <div class="info-item">
                    <label>Phone:</label>
                    <span><?php echo htmlspecialchars($user['phone'] ?? 'Not provided'); ?></span>
                </div>
                <div class="info-item">
                    <label>Member Since:</label>
                    <span><?php echo date('M d, Y', strtotime($user['created_at'])); ?></span>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include 'includes/footer.php'; ?>
