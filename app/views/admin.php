<?php $pageTitle = 'Admin | Achar Club'; ?>
<div class="p-8 space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <p class="text-sm uppercase tracking-[0.3em] text-white/50">Admin panel</p>
            <h1 class="text-3xl font-semibold text-white">Product atelier</h1>
            <p class="text-white/60 text-sm">Manage jars, pricing, and drops. Default login: <span class="font-semibold text-white">admin@achar.club / letmein123</span></p>
        </div>
        <?php if ($isAuthenticated): ?>
            <form method="post">
                <input type="hidden" name="action" value="logout_admin">
                <button type="submit" class="px-4 py-2 rounded-full bg-white/10 border border-white/20 text-white text-sm">Logout</button>
            </form>
        <?php endif; ?>
    </div>

    <?php if (!$isAuthenticated): ?>
        <div class="rounded-3xl border border-white/10 bg-white/5 p-6 max-w-lg">
            <form method="post" class="space-y-4">
                <input type="hidden" name="action" value="login_admin">
                <div>
                    <label class="block text-sm text-white/70 mb-1">Email</label>
                    <input type="email" name="email" required class="w-full bg-white/10 border border-white/20 rounded-2xl px-3 py-2 text-white">
                </div>
                <div>
                    <label class="block text-sm text-white/70 mb-1">Password</label>
                    <input type="password" name="password" required class="w-full bg-white/10 border border-white/20 rounded-2xl px-3 py-2 text-white">
                </div>
                <button type="submit" class="w-full px-4 py-3 rounded-full bg-accent text-noir font-semibold shadow-lg shadow-amber-500/30">Enter studio</button>
            </form>
        </div>
    <?php else: ?>
        <div class="rounded-3xl border border-white/10 bg-white/5 p-6 space-y-4">
            <h2 class="text-xl font-semibold text-white">Add / update product</h2>
            <form method="post" class="grid md:grid-cols-2 gap-4">
                <input type="hidden" name="action" value="save_product">
                <div>
                    <label class="block text-sm text-white/70 mb-1">Product ID (leave blank for new)</label>
                    <input type="number" name="id" class="w-full bg-white/10 border border-white/20 rounded-2xl px-3 py-2 text-white" placeholder="auto">
                </div>
                <div>
                    <label class="block text-sm text-white/70 mb-1">Name</label>
                    <input type="text" name="name" required class="w-full bg-white/10 border border-white/20 rounded-2xl px-3 py-2 text-white">
                </div>
                <div>
                    <label class="block text-sm text-white/70 mb-1">Price</label>
                    <input type="number" name="price" step="0.01" min="0" required class="w-full bg-white/10 border border-white/20 rounded-2xl px-3 py-2 text-white">
                </div>
                <div>
                    <label class="block text-sm text-white/70 mb-1">Category</label>
                    <input type="text" name="category" class="w-full bg-white/10 border border-white/20 rounded-2xl px-3 py-2 text-white" placeholder="Limited / Signature">
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm text-white/70 mb-1">Image URL</label>
                    <input type="url" name="image" class="w-full bg-white/10 border border-white/20 rounded-2xl px-3 py-2 text-white" placeholder="https://...">
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm text-white/70 mb-1">Description</label>
                    <textarea name="description" rows="2" class="w-full bg-white/10 border border-white/20 rounded-2xl px-3 py-2 text-white"></textarea>
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm text-white/70 mb-1">Tags (comma separated)</label>
                    <input type="text" name="tags" class="w-full bg-white/10 border border-white/20 rounded-2xl px-3 py-2 text-white" placeholder="spicy, limited">
                </div>
                <div class="md:col-span-2 flex justify-end">
                    <button type="submit" class="px-6 py-3 rounded-full bg-accent text-noir font-semibold shadow-lg shadow-amber-500/30 hover:-translate-y-0.5 transition">
                        Save product
                    </button>
                </div>
            </form>
        </div>

        <div class="rounded-3xl border border-white/10 bg-white/5 p-6 space-y-4">
            <h2 class="text-xl font-semibold text-white">Current catalog</h2>
            <div class="grid gap-4">
                <?php foreach ($products as $product): ?>
                    <div class="rounded-2xl border border-white/10 bg-white/5 p-4 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                        <div class="flex items-center gap-3">
                            <div class="h-14 w-14 rounded-xl overflow-hidden">
                                <img src="<?= htmlspecialchars($product['image'], ENT_QUOTES) ?>" alt="<?= htmlspecialchars($product['name'], ENT_QUOTES) ?>" class="h-full w-full object-cover">
                            </div>
                            <div>
                                <p class="text-xs text-white/60 uppercase tracking-[0.2em]"><?= htmlspecialchars($product['category'], ENT_QUOTES) ?></p>
                                <p class="text-white font-semibold"><?= htmlspecialchars($product['name'], ENT_QUOTES) ?></p>
                                <p class="text-sm text-accent font-semibold">$<?= number_format((float) $product['price'], 2) ?></p>
                            </div>
                        </div>
                        <div class="flex items-center gap-2">
                            <form method="post">
                                <input type="hidden" name="action" value="delete_product">
                                <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                                <button type="submit" class="px-3 py-2 rounded-full bg-rose-500/20 border border-rose-400/40 text-rose-100 text-sm hover:bg-rose-500/30">Delete</button>
                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>
</div>
