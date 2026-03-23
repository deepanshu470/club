<?php
$pageTitle = 'Register - ShopPremium';
require_once BASE_PATH . '/app/views/layouts/header.php';
?>

<div class="container" style="margin-top: 3rem; margin-bottom: 3rem;">
    <div style="max-width: 600px; margin: 0 auto;">
        <div class="card">
            <h1 style="text-align: center; margin-bottom: 2rem;">
                <i class="fas fa-user-plus"></i> Create Account
            </h1>

            <form method="POST" action="/register">
                <div class="form-group">
                    <label class="form-label"><i class="fas fa-user"></i> Full Name</label>
                    <input type="text" name="name" class="form-control" required>
                </div>

                <div class="form-group">
                    <label class="form-label"><i class="fas fa-envelope"></i> Email Address</label>
                    <input type="email" name="email" class="form-control" required>
                </div>

                <div class="form-group">
                    <label class="form-label"><i class="fas fa-lock"></i> Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <div class="form-group">
                    <label class="form-label"><i class="fas fa-phone"></i> Phone Number</label>
                    <input type="tel" name="phone" class="form-control">
                </div>

                <div class="form-group">
                    <label class="form-label"><i class="fas fa-map-marker-alt"></i> Address</label>
                    <textarea name="address" class="form-control" rows="2"></textarea>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                    <div class="form-group">
                        <label class="form-label">City</label>
                        <input type="text" name="city" class="form-control">
                    </div>

                    <div class="form-group">
                        <label class="form-label">State</label>
                        <input type="text" name="state" class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">PIN Code</label>
                    <input type="text" name="pincode" class="form-control">
                </div>

                <button type="submit" class="btn btn-primary" style="width: 100%;">
                    <i class="fas fa-user-plus"></i> Create Account
                </button>
            </form>

            <div style="text-align: center; margin-top: 1.5rem; padding-top: 1.5rem; border-top: 1px solid var(--border-color);">
                <p style="color: #6B7280;">
                    Already have an account?
                    <a href="/login" style="color: var(--primary-color); font-weight: 600;">
                        Login here
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>

<?php require_once BASE_PATH . '/app/views/layouts/footer.php'; ?>
