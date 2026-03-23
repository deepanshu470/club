<?php
$pageTitle = 'My Profile - ShopPremium';
require_once BASE_PATH . '/app/views/layouts/header.php';
?>

<div class="container" style="margin-top: 2rem;">
    <h1 style="margin-bottom: 2rem;"><i class="fas fa-user-circle"></i> My Profile</h1>

    <div style="max-width: 800px; margin: 0 auto;">
        <div class="card">
            <form method="POST" action="/profile">
                <div class="form-group">
                    <label class="form-label"><i class="fas fa-user"></i> Full Name</label>
                    <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($user['name']) ?>" required>
                </div>

                <div class="form-group">
                    <label class="form-label"><i class="fas fa-envelope"></i> Email Address</label>
                    <input type="email" class="form-control" value="<?= htmlspecialchars($user['email']) ?>" disabled>
                    <small style="color: #6B7280;">Email cannot be changed</small>
                </div>

                <div class="form-group">
                    <label class="form-label"><i class="fas fa-phone"></i> Phone Number</label>
                    <input type="tel" name="phone" class="form-control" value="<?= htmlspecialchars($user['phone'] ?? '') ?>">
                </div>

                <div class="form-group">
                    <label class="form-label"><i class="fas fa-map-marker-alt"></i> Address</label>
                    <textarea name="address" class="form-control" rows="3"><?= htmlspecialchars($user['address'] ?? '') ?></textarea>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                    <div class="form-group">
                        <label class="form-label">City</label>
                        <input type="text" name="city" class="form-control" value="<?= htmlspecialchars($user['city'] ?? '') ?>">
                    </div>

                    <div class="form-group">
                        <label class="form-label">State</label>
                        <input type="text" name="state" class="form-control" value="<?= htmlspecialchars($user['state'] ?? '') ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">PIN Code</label>
                    <input type="text" name="pincode" class="form-control" value="<?= htmlspecialchars($user['pincode'] ?? '') ?>">
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Update Profile
                </button>
            </form>
        </div>
    </div>
</div>

<?php require_once BASE_PATH . '/app/views/layouts/footer.php'; ?>
