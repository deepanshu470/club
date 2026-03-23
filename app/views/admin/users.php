<?php require_once BASE_PATH . '/app/views/admin/header.php'; ?>

<h1 style="margin-bottom: 2rem;"><i class="fas fa-users"></i> Users Management</h1>

<div class="card">
    <?php if (empty($users)): ?>
        <p style="text-align: center; color: #6B7280; padding: 2rem;">No users found</p>
    <?php else: ?>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Location</th>
                    <th>Role</th>
                    <th>Joined</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= $user['id'] ?></td>
                        <td><strong><?= htmlspecialchars($user['name']) ?></strong></td>
                        <td><?= htmlspecialchars($user['email']) ?></td>
                        <td><?= htmlspecialchars($user['phone'] ?? 'N/A') ?></td>
                        <td>
                            <?php if ($user['city'] || $user['state']): ?>
                                <?= htmlspecialchars(($user['city'] ?? '') . ', ' . ($user['state'] ?? '')) ?>
                            <?php else: ?>
                                N/A
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if ($user['is_admin']): ?>
                                <span style="background: var(--primary-color); color: white; padding: 0.25rem 0.75rem; border-radius: 0.25rem; font-size: 0.875rem;">
                                    <i class="fas fa-shield-alt"></i> Admin
                                </span>
                            <?php else: ?>
                                <span style="background: var(--secondary-color); color: white; padding: 0.25rem 0.75rem; border-radius: 0.25rem; font-size: 0.875rem;">
                                    <i class="fas fa-user"></i> Customer
                                </span>
                            <?php endif; ?>
                        </td>
                        <td><?= date('M d, Y', strtotime($user['created_at'])) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<?php require_once BASE_PATH . '/app/views/admin/footer.php'; ?>
