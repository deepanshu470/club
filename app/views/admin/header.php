<?php
$pageTitle = 'Admin Dashboard - ShopPremium';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?></title>
    <link rel="stylesheet" href="/public/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body>
    <div style="display: grid; grid-template-columns: 250px 1fr; min-height: 100vh;">
        <!-- Admin Sidebar -->
        <aside class="admin-sidebar">
            <h2 style="margin-bottom: 2rem;">
                <i class="fas fa-shopping-bag"></i> ShopPremium
            </h2>

            <ul class="admin-menu">
                <li class="admin-menu-item">
                    <a href="/admin" class="admin-menu-link">
                        <i class="fas fa-dashboard"></i> Dashboard
                    </a>
                </li>
                <li class="admin-menu-item">
                    <a href="/admin/products" class="admin-menu-link">
                        <i class="fas fa-box"></i> Products
                    </a>
                </li>
                <li class="admin-menu-item">
                    <a href="/admin/categories" class="admin-menu-link">
                        <i class="fas fa-tags"></i> Categories
                    </a>
                </li>
                <li class="admin-menu-item">
                    <a href="/admin/orders" class="admin-menu-link">
                        <i class="fas fa-shopping-cart"></i> Orders
                    </a>
                </li>
                <li class="admin-menu-item">
                    <a href="/admin/users" class="admin-menu-link">
                        <i class="fas fa-users"></i> Users
                    </a>
                </li>
                <li class="admin-menu-item" style="margin-top: 2rem; border-top: 1px solid rgba(255,255,255,0.1); padding-top: 1rem;">
                    <a href="/" class="admin-menu-link">
                        <i class="fas fa-globe"></i> View Website
                    </a>
                </li>
                <li class="admin-menu-item">
                    <a href="/logout" class="admin-menu-link">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </li>
            </ul>
        </aside>

        <!-- Main Content -->
        <main style="background: var(--light-gray); padding: 2rem;">
