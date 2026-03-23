<div class="max-w-2xl mx-auto frosted-card p-10 text-center space-y-3">
    <div class="text-6xl text-cyan-300 font-bold">404</div>
    <div class="text-2xl text-white font-semibold"><?= h($title ?? 'Page not found'); ?></div>
    <p class="text-slate-400">The page you are looking for is not available. Head back to the home page or browse the catalog.</p>
    <div class="flex justify-center gap-3">
        <a href="index.php" class="px-4 py-3 rounded-xl border border-white/10 bg-white/5 text-white hover:bg-white/10">Home</a>
        <a href="<?= route_url('catalog'); ?>" class="gradient-cta glass-button px-4 py-3 rounded-xl text-slate-900 font-semibold border-0">Shop</a>
    </div>
</div>
