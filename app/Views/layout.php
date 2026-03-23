<?php $cartCount = $cartCount ?? 0; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Club Commerce</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/custom.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: '#111827',
                        accent: '#22d3ee',
                        muted: '#6b7280'
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-slate-950 text-slate-100">
    <div class="bg-gradient-to-br from-slate-900 via-slate-900 to-slate-950 min-h-screen">
        <header class="sticky top-0 z-30 backdrop-blur bg-slate-950/70 border-b border-white/5">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3 flex items-center justify-between">
                <a href="index.php" class="flex items-center gap-3 text-white font-semibold tracking-tight">
                    <span class="h-9 w-9 rounded-xl bg-gradient-to-br from-cyan-400 to-blue-500 shadow-lg shadow-cyan-500/40 flex items-center justify-center text-xl">C</span>
                    <div>
                        <div class="text-lg leading-tight">Club Commerce</div>
                        <div class="text-xs text-slate-400">Premium storefront</div>
                    </div>
                </a>
                <nav class="hidden md:flex items-center gap-6 text-sm font-medium">
                    <a class="nav-link" href="index.php">Home</a>
                    <a class="nav-link" href="<?= route_url('catalog'); ?>">Shop</a>
                    <a class="nav-link" href="<?= route_url('cart'); ?>">Cart</a>
                    <a class="nav-link" href="<?= route_url('admin/login'); ?>">Admin</a>
                </nav>
                <div class="flex items-center gap-3">
                    <a href="<?= route_url('cart'); ?>" class="relative rounded-full border border-white/10 px-3 py-2 flex items-center gap-2 text-sm bg-white/5 hover:bg-white/10 transition">
                        <i class="bi bi-bag"></i>
                        <span>Cart</span>
                        <span class="cart-pill"><?= (int) $cartCount; ?></span>
                    </a>
                    <button class="md:hidden inline-flex items-center justify-center h-10 w-10 rounded-xl border border-white/10 bg-white/5 text-white hover:bg-white/10" id="mobileMenuButton">
                        <i class="bi bi-list text-xl"></i>
                    </button>
                </div>
            </div>
            <div id="mobileMenu" class="md:hidden hidden px-4 pb-4 space-y-2">
                <a class="mobile-link" href="index.php">Home</a>
                <a class="mobile-link" href="<?= route_url('catalog'); ?>">Shop</a>
                <a class="mobile-link" href="<?= route_url('cart'); ?>">Cart</a>
                <a class="mobile-link" href="<?= route_url('admin/login'); ?>">Admin</a>
            </div>
        </header>

        <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            <?= $content; ?>
        </main>

        <footer class="border-t border-white/5 mt-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 flex flex-col md:flex-row items-start md:items-center justify-between gap-6 text-sm text-slate-400">
                <div>
                    <div class="text-white font-semibold">Club Commerce</div>
                    <p class="text-slate-400">Modern storefront with admin panel, responsive and ready.</p>
                </div>
                <div class="flex gap-4 text-lg text-slate-300">
                    <i class="bi bi-twitter"></i>
                    <i class="bi bi-instagram"></i>
                    <i class="bi bi-linkedin"></i>
                </div>
            </div>
        </footer>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/app.js"></script>
</body>
</html>
