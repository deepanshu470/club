<?php
require_once '../includes/config.php';

// Check if user is admin
if (!is_logged_in() || !is_admin()) {
    redirect('../login.php');
}

// Get statistics
$total_users = $conn->query("SELECT COUNT(*) as count FROM users")->fetch_assoc()['count'];
$total_plans = $conn->query("SELECT COUNT(*) as count FROM hosting_plans WHERE is_active = 1")->fetch_assoc()['count'];
$total_orders = $conn->query("SELECT COUNT(*) as count FROM orders")->fetch_assoc()['count'];
$active_orders = $conn->query("SELECT COUNT(*) as count FROM orders WHERE order_status = 'active'")->fetch_assoc()['count'];
$pending_messages = $conn->query("SELECT COUNT(*) as count FROM contact_messages WHERE status = 'new'")->fetch_assoc()['count'];

// Get recent orders
$recent_orders_query = "SELECT o.*, u.username, u.email, h.plan_name
                       FROM orders o
                       JOIN users u ON o.user_id = u.id
                       JOIN hosting_plans h ON o.plan_id = h.id
                       ORDER BY o.order_date DESC
                       LIMIT 10";
$recent_orders = $conn->query($recent_orders_query);

// Get recent messages
$recent_messages_query = "SELECT * FROM contact_messages ORDER BY created_at DESC LIMIT 5";
$recent_messages = $conn->query($recent_messages_query);

include '../includes/header.php';
?>

<main class="admin-page">
    <div class="container">
        <div class="admin-header">
            <h1>Admin Dashboard</h1>
            <p>Manage your hosting platform</p>
        </div>

        <?php echo get_success_message(); echo get_error_message(); ?>

        <!-- Stats Overview -->
        <div class="admin-stats">
            <div class="admin-stat-card">
                <div class="stat-icon">👥</div>
                <div class="stat-content">
                    <h3><?php echo $total_users; ?></h3>
                    <p>Total Users</p>
                </div>
            </div>

            <div class="admin-stat-card">
                <div class="stat-icon">📦</div>
                <div class="stat-content">
                    <h3><?php echo $total_plans; ?></h3>
                    <p>Active Plans</p>
                </div>
            </div>

            <div class="admin-stat-card">
                <div class="stat-icon">🛒</div>
                <div class="stat-content">
                    <h3><?php echo $total_orders; ?></h3>
                    <p>Total Orders</p>
                </div>
            </div>

            <div class="admin-stat-card">
                <div class="stat-icon">✅</div>
                <div class="stat-content">
                    <h3><?php echo $active_orders; ?></h3>
                    <p>Active Services</p>
                </div>
            </div>

            <div class="admin-stat-card">
                <div class="stat-icon">💬</div>
                <div class="stat-content">
                    <h3><?php echo $pending_messages; ?></h3>
                    <p>New Messages</p>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="admin-actions">
            <h2>Quick Actions</h2>
            <div class="admin-buttons">
                <a href="manage-users.php" class="btn btn-primary">Manage Users</a>
                <a href="manage-plans.php" class="btn btn-primary">Manage Plans</a>
                <a href="manage-orders.php" class="btn btn-primary">View Orders</a>
                <a href="manage-messages.php" class="btn btn-primary">View Messages</a>
            </div>
        </div>

        <!-- Recent Orders -->
        <div class="admin-section">
            <h2>Recent Orders</h2>
            <div class="table-responsive">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>User</th>
                            <th>Plan</th>
                            <th>Domain</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($recent_orders->num_rows > 0): ?>
                            <?php while($order = $recent_orders->fetch_assoc()): ?>
                            <tr>
                                <td>#<?php echo $order['id']; ?></td>
                                <td><?php echo htmlspecialchars($order['username']); ?></td>
                                <td><?php echo htmlspecialchars($order['plan_name']); ?></td>
                                <td><?php echo htmlspecialchars($order['domain_name']); ?></td>
                                <td><?php echo format_price($order['total_amount']); ?></td>
                                <td>
                                    <span class="status-badge status-<?php echo $order['order_status']; ?>">
                                        <?php echo ucfirst($order['order_status']); ?>
                                    </span>
                                </td>
                                <td><?php echo date('M d, Y', strtotime($order['order_date'])); ?></td>
                            </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" class="text-center">No orders yet</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Recent Messages -->
        <div class="admin-section">
            <h2>Recent Contact Messages</h2>
            <div class="messages-list">
                <?php if ($recent_messages->num_rows > 0): ?>
                    <?php while($msg = $recent_messages->fetch_assoc()): ?>
                    <div class="message-card <?php echo $msg['status'] == 'new' ? 'unread' : ''; ?>">
                        <div class="message-header">
                            <h4><?php echo htmlspecialchars($msg['name']); ?></h4>
                            <span class="message-date"><?php echo date('M d, Y H:i', strtotime($msg['created_at'])); ?></span>
                        </div>
                        <p class="message-email"><?php echo htmlspecialchars($msg['email']); ?></p>
                        <p class="message-subject"><strong>Subject:</strong> <?php echo htmlspecialchars($msg['subject']); ?></p>
                        <p class="message-text"><?php echo htmlspecialchars(substr($msg['message'], 0, 150)) . '...'; ?></p>
                        <span class="status-badge status-<?php echo $msg['status']; ?>">
                            <?php echo ucfirst($msg['status']); ?>
                        </span>
                    </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p class="text-center">No messages yet</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</main>

<style>
.admin-page {
    background: var(--light-bg);
    min-height: 80vh;
    padding: 2rem 0;
}

.admin-header {
    background: white;
    padding: 2rem;
    border-radius: 1rem;
    margin-bottom: 2rem;
    box-shadow: var(--shadow);
}

.admin-stats {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1.5rem;
    margin-bottom: 2rem;
}

.admin-stat-card {
    background: white;
    padding: 1.5rem;
    border-radius: 1rem;
    box-shadow: var(--shadow);
    display: flex;
    align-items: center;
    gap: 1rem;
}

.admin-stat-card .stat-icon {
    font-size: 2.5rem;
}

.admin-stat-card .stat-content h3 {
    font-size: 2rem;
    color: var(--primary-color);
    margin-bottom: 0.25rem;
}

.admin-stat-card .stat-content p {
    color: var(--text-light);
    font-size: 0.9rem;
}

.admin-actions {
    background: white;
    padding: 2rem;
    border-radius: 1rem;
    margin-bottom: 2rem;
    box-shadow: var(--shadow);
}

.admin-buttons {
    display: flex;
    gap: 1rem;
    flex-wrap: wrap;
    margin-top: 1rem;
}

.admin-section {
    background: white;
    padding: 2rem;
    border-radius: 1rem;
    margin-bottom: 2rem;
    box-shadow: var(--shadow);
}

.admin-table {
    width: 100%;
    border-collapse: collapse;
}

.admin-table th,
.admin-table td {
    padding: 1rem;
    text-align: left;
    border-bottom: 1px solid var(--border-color);
}

.admin-table th {
    background: var(--light-bg);
    font-weight: 600;
}

.messages-list {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.message-card {
    padding: 1.5rem;
    background: var(--light-bg);
    border-radius: 0.5rem;
    border-left: 4px solid var(--border-color);
}

.message-card.unread {
    background: #f0f9ff;
    border-left-color: var(--primary-color);
}

.message-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 0.5rem;
}

.message-header h4 {
    margin: 0;
    color: var(--text-dark);
}

.message-date {
    font-size: 0.875rem;
    color: var(--text-light);
}

.message-email {
    color: var(--text-light);
    font-size: 0.9rem;
    margin-bottom: 0.5rem;
}

.message-subject {
    margin-bottom: 0.5rem;
}

.message-text {
    color: var(--text-dark);
    margin-bottom: 1rem;
}
</style>

<?php include '../includes/footer.php'; ?>
