<?php
$cartCount = array_sum($_SESSION['cart'] ?? []);
$pageTitle = $pageTitle ?? 'Achar Club | Modern Pickle Boutique';
$flash = $flash ?? ($_SESSION['flash'] ?? null);
unset($_SESSION['flash']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle, ENT_QUOTES) ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        noir: '#0d0d0f',
                        accent: '#f59e0b',
                        mint: '#5ce1e6',
                    },
                    fontFamily: {
                        display: ['Space Grotesk', 'system-ui', 'sans-serif'],
                    },
                }
            }
        }
    </script>
</head>
<body class="bg-noir text-white font-display antialiased min-h-screen">
    <div class="absolute inset-0 -z-10">
        <div class="absolute -left-20 top-0 h-80 w-80 rounded-full bg-gradient-to-r from-mint/30 via-accent/20 to-amber-500/10 blur-3xl"></div>
        <div class="absolute right-0 bottom-0 h-72 w-72 rounded-full bg-gradient-to-l from-emerald-500/20 via-sky-500/20 to-indigo-500/10 blur-3xl"></div>
    </div>

    <header class="sticky top-0 z-20 backdrop-blur bg-noir/80 border-b border-white/5">
        <nav class="max-w-6xl mx-auto px-4 py-4 flex items-center justify-between">
            <a href="?route=home" class="flex items-center gap-3 text-lg font-semibold tracking-tight">
                <span class="grid place-items-center h-10 w-10 rounded-2xl bg-white/10 text-accent border border-white/10 shadow-lg shadow-accent/10">
                    <i class="bi bi-lightning-charge"></i>
                </span>
                <div>
                    <div>Achar Club</div>
                    <p class="text-xs text-white/60">Premium pickle atelier</p>
                </div>
            </a>
            <div class="flex items-center gap-2">
                <a href="?route=products" class="px-3 py-2 rounded-full text-sm hover:bg-white/10 transition">Shop</a>
                <a href="?route=admin" class="px-3 py-2 rounded-full text-sm hover:bg-white/10 transition">Admin</a>
                <a href="?route=cart" class="relative px-4 py-2 rounded-full bg-white text-noir font-semibold shadow-lg shadow-accent/20">
                    <i class="bi bi-bag-heart-fill"></i>
                    <span class="ml-1">Cart</span>
                    <?php if ($cartCount > 0): ?>
                        <span class="absolute -top-2 -right-2 inline-flex items-center justify-center h-6 w-6 rounded-full bg-accent text-noir text-xs font-bold shadow-lg shadow-amber-500/30">
                            <?= $cartCount ?>
                        </span>
                    <?php endif; ?>
                </a>
            </div>
        </nav>
    </header>

    <main class="max-w-6xl mx-auto px-4 py-10 space-y-6">
        <?php if (!empty($flash['message'])): ?>
            <div class="rounded-2xl border <?= ($flash['type'] ?? '') === 'error' ? 'border-rose-500/30 bg-rose-500/10' : 'border-emerald-400/30 bg-emerald-400/10' ?> px-4 py-3 text-sm flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <i class="bi <?= ($flash['type'] ?? '') === 'error' ? 'bi-exclamation-octagon' : 'bi-stars' ?>"></i>
                    <span><?= htmlspecialchars($flash['message'], ENT_QUOTES) ?></span>
                </div>
                <a href="<?= htmlspecialchars($_SERVER['REQUEST_URI'], ENT_QUOTES) ?>" class="text-white/50 text-xs hover:text-white">dismiss</a>
            </div>
        <?php endif; ?>

        <section class="bg-white/5 border border-white/10 rounded-3xl shadow-2xl shadow-black/40 overflow-hidden">
            <?php include $viewFile; ?>
        </section>
    </main>

    <footer class="max-w-6xl mx-auto px-4 pb-10 text-sm text-white/50">
        <div class="flex flex-col sm:flex-row gap-2 justify-between items-center">
            <p>Handcrafted in MVC PHP • Tailwind + Bootstrap Icons</p>
            <div class="flex items-center gap-3">
                <span class="h-2 w-2 rounded-full bg-emerald-400 animate-pulse"></span>
                <span>Live &amp; responsive</span>
            </div>
        </div>
    </footer>
</body>
</html>
