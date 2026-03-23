<?php
$pageTitle = 'Login - ShopPremium';
require_once BASE_PATH . '/app/views/layouts/header.php';
?>

<div class="container" style="margin-top: 3rem; margin-bottom: 3rem;">
    <div style="max-width: 500px; margin: 0 auto;">
        <div class="card">
            <h1 style="text-align: center; margin-bottom: 2rem;">
                <i class="fas fa-sign-in-alt"></i> Login
            </h1>

            <form method="POST" action="/login">
                <div class="form-group">
                    <label class="form-label"><i class="fas fa-envelope"></i> Email Address</label>
                    <input type="email" name="email" class="form-control" required>
                </div>

                <div class="form-group">
                    <label class="form-label"><i class="fas fa-lock"></i> Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary" style="width: 100%;">
                    <i class="fas fa-sign-in-alt"></i> Login
                </button>
            </form>

            <div style="text-align: center; margin-top: 1.5rem; padding-top: 1.5rem; border-top: 1px solid var(--border-color);">
                <p style="color: #6B7280;">
                    Don't have an account?
                    <a href="/register" style="color: var(--primary-color); font-weight: 600;">
                        Register here
                    </a>
                </p>
            </div>
        </div>

        <div class="card" style="margin-top: 1rem; background: var(--light-gray);">
            <h3 style="margin-bottom: 1rem;"><i class="fas fa-info-circle"></i> Demo Credentials</h3>
            <p><strong>Admin:</strong> admin@ecommerce.com / admin123</p>
        </div>
    </div>
</div>

<?php require_once BASE_PATH . '/app/views/layouts/footer.php'; ?>
