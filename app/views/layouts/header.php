<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?? 'Premium E-Commerce Store' ?></title>

    <!-- CSS -->
    <link rel="stylesheet" href="/public/css/style.css">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="navbar-container">
            <a href="/" class="logo">
                <i class="fas fa-shopping-bag"></i> ShopPremium
            </a>

            <ul class="nav-menu">
                <li><a href="/" class="nav-link">Home</a></li>
                <li><a href="/products" class="nav-link">Products</a></li>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin']): ?>
                        <li><a href="/admin" class="nav-link"><i class="fas fa-dashboard"></i> Admin</a></li>
                    <?php endif; ?>
                    <li><a href="/wishlist" class="nav-link nav-icon">
                        <i class="fas fa-heart"></i>
                    </a></li>
                    <li><a href="/cart" class="nav-link nav-icon">
                        <i class="fas fa-shopping-cart"></i>
                        <?php if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0): ?>
                            <span class="cart-badge"><?= count($_SESSION['cart']) ?></span>
                        <?php endif; ?>
                    </a></li>
                    <li class="nav-link">
                        <i class="fas fa-user"></i> <?= htmlspecialchars($_SESSION['user_name']) ?>
                    </li>
                    <li><a href="/orders" class="nav-link">Orders</a></li>
                    <li><a href="/profile" class="nav-link">Profile</a></li>
                    <li><a href="/logout" class="nav-link">Logout</a></li>
                <?php else: ?>
                    <li><a href="/login" class="nav-link">Login</a></li>
                    <li><a href="/register" class="btn btn-primary">Sign Up</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>

    <!-- Search Bar -->
    <div class="container" style="padding-top: 1rem;">
        <form action="/search" method="GET" class="form-group" style="max-width: 600px; margin: 0 auto;">
            <div style="position: relative;">
                <input type="text" name="q" class="form-control" placeholder="Search products..."
                       value="<?= htmlspecialchars($_GET['q'] ?? '') ?>" style="padding-right: 3rem;">
                <button type="submit" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); background: none; border: none; cursor: pointer;">
                    <i class="fas fa-search" style="color: #6B7280; font-size: 1.2rem;"></i>
                </button>
            </div>
        </form>
    </div>

    <!-- Flash Messages -->
    <?php if (isset($_SESSION['success'])): ?>
        <div class="container">
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i> <?= htmlspecialchars($_SESSION['success']) ?>
            </div>
        </div>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['error'])): ?>
        <div class="container">
            <div class="alert alert-error">
                <i class="fas fa-exclamation-circle"></i> <?= htmlspecialchars($_SESSION['error']) ?>
            </div>
        </div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <!-- Main Content -->
    <main>
