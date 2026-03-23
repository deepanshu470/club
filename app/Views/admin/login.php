<div class="max-w-xl mx-auto frosted-card p-8 space-y-6">
    <div class="space-y-2 text-center">
        <h1 class="text-2xl font-semibold text-white">Admin panel</h1>
        <p class="text-slate-400 text-sm">Use the demo credentials to manage products.</p>
        <div class="chip justify-center text-xs">Username: admin - Password: demo123</div>
    </div>

    <?php if (!empty($error)): ?>
        <div class="rounded-xl border border-red-500/40 bg-red-500/10 text-red-100 px-4 py-3 text-sm">
            <?= h($error); ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="<?= route_url('admin/authenticate'); ?>" class="space-y-4">
        <div>
            <label class="text-sm text-slate-300">Username</label>
            <input required name="username" class="form-control bg-slate-900 text-white border-white/10" placeholder="admin">
        </div>
        <div>
            <label class="text-sm text-slate-300">Password</label>
            <input required type="password" name="password" class="form-control bg-slate-900 text-white border-white/10" placeholder="demo123">
        </div>
        <button class="gradient-cta glass-button w-full py-3 rounded-xl text-slate-900 font-semibold border-0">Sign in</button>
    </form>
</div>
