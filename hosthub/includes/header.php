<?php require_once 'includes/config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITE_NAME; ?> - Premium Web Hosting Solutions</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">
</head>
<body>
    <header>
        <nav class="navbar">
            <div class="container">
                <div class="logo">
                    <h1><span class="logo-icon">⚡</span>HostHub</h1>
                </div>
                <ul class="nav-menu" id="navMenu">
                    <li><a href="index.php" class="active">Home</a></li>
                    <li><a href="plans.php">Hosting Plans</a></li>
                    <li><a href="contact.php">Contact</a></li>
                    <?php if (is_logged_in()): ?>
                        <li><a href="dashboard.php">Dashboard</a></li>
                        <?php if (is_admin()): ?>
                            <li><a href="admin/index.php">Admin</a></li>
                        <?php endif; ?>
                        <li><a href="logout.php" class="btn-logout">Logout</a></li>
                    <?php else: ?>
                        <li><a href="login.php" class="btn-login">Login</a></li>
                        <li><a href="register.php" class="btn-register">Sign Up</a></li>
                    <?php endif; ?>
                </ul>
                <div class="hamburger" id="hamburger">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
        </nav>
    </header>
