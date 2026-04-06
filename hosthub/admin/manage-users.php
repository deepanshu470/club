<?php
require_once '../includes/config.php';

// Check if user is admin
if (!is_logged_in() || !is_admin()) {
    redirect('../login.php');
}

// Handle user actions
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'])) {
    $user_id = (int)$_POST['user_id'];

    switch($_POST['action']) {
        case 'deactivate':
            $conn->query("UPDATE users SET is_active = 0 WHERE id = $user_id");
            $_SESSION['success'] = "User deactivated successfully!";
            break;

        case 'activate':
            $conn->query("UPDATE users SET is_active = 1 WHERE id = $user_id");
            $_SESSION['success'] = "User activated successfully!";
            break;

        case 'make_admin':
            $conn->query("UPDATE users SET is_admin = 1 WHERE id = $user_id");
            $_SESSION['success'] = "User promoted to admin!";
            break;

        case 'remove_admin':
            $conn->query("UPDATE users SET is_admin = 0 WHERE id = $user_id");
            $_SESSION['success'] = "Admin privileges removed!";
            break;
    }

    redirect('manage-users.php');
}

// Get all users
$users_query = "SELECT u.*, COUNT(o.id) as order_count
                FROM users u
                LEFT JOIN orders o ON u.id = o.user_id
                GROUP BY u.id
                ORDER BY u.created_at DESC";
$users_result = $conn->query($users_query);

include '../includes/header.php';
?>

<main class="admin-page">
    <div class="container">
        <div class="admin-header">
            <h1>Manage Users</h1>
            <p>View and manage all registered users</p>
            <a href="index.php" class="btn btn-outline">← Back to Dashboard</a>
        </div>

        <?php echo get_success_message(); echo get_error_message(); ?>

        <div class="admin-section">
            <div class="table-responsive">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Full Name</th>
                            <th>Orders</th>
                            <th>Status</th>
                            <th>Role</th>
                            <th>Joined</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($user = $users_result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $user['id']; ?></td>
                            <td><?php echo htmlspecialchars($user['username']); ?></td>
                            <td><?php echo htmlspecialchars($user['email']); ?></td>
                            <td><?php echo htmlspecialchars($user['full_name']); ?></td>
                            <td><?php echo $user['order_count']; ?></td>
                            <td>
                                <span class="status-badge status-<?php echo $user['is_active'] ? 'active' : 'suspended'; ?>">
                                    <?php echo $user['is_active'] ? 'Active' : 'Inactive'; ?>
                                </span>
                            </td>
                            <td>
                                <?php if ($user['is_admin']): ?>
                                    <span class="badge badge-admin">Admin</span>
                                <?php else: ?>
                                    <span class="badge badge-user">User</span>
                                <?php endif; ?>
                            </td>
                            <td><?php echo date('M d, Y', strtotime($user['created_at'])); ?></td>
                            <td>
                                <div class="action-buttons">
                                    <?php if ($user['id'] != $_SESSION['user_id']): ?>
                                        <form method="POST" style="display: inline;">
                                            <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">

                                            <?php if ($user['is_active']): ?>
                                                <button type="submit" name="action" value="deactivate"
                                                        class="btn btn-sm btn-warning"
                                                        onclick="return confirm('Deactivate this user?')">
                                                    Deactivate
                                                </button>
                                            <?php else: ?>
                                                <button type="submit" name="action" value="activate"
                                                        class="btn btn-sm btn-success"
                                                        onclick="return confirm('Activate this user?')">
                                                    Activate
                                                </button>
                                            <?php endif; ?>

                                            <?php if (!$user['is_admin']): ?>
                                                <button type="submit" name="action" value="make_admin"
                                                        class="btn btn-sm"
                                                        onclick="return confirm('Make this user an admin?')">
                                                    Make Admin
                                                </button>
                                            <?php else: ?>
                                                <button type="submit" name="action" value="remove_admin"
                                                        class="btn btn-sm"
                                                        onclick="return confirm('Remove admin privileges?')">
                                                    Remove Admin
                                                </button>
                                            <?php endif; ?>
                                        </form>
                                    <?php else: ?>
                                        <span class="text-muted">You</span>
                                    <?php endif; ?>
                                </div>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>

<style>
.badge {
    display: inline-block;
    padding: 0.25rem 0.75rem;
    border-radius: 1rem;
    font-size: 0.875rem;
    font-weight: 600;
}

.badge-admin {
    background: linear-gradient(135deg, var(--accent-color), var(--secondary-color));
    color: white;
}

.badge-user {
    background: var(--light-bg);
    color: var(--text-dark);
}

.action-buttons {
    display: flex;
    gap: 0.5rem;
    flex-wrap: wrap;
}

.btn-warning {
    background: var(--warning-color);
    color: white;
}

.btn-success {
    background: var(--success-color);
    color: white;
}

.text-muted {
    color: var(--text-light);
}
</style>

<?php include '../includes/footer.php'; ?>
