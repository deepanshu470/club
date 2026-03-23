<section class="space-y-6">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="text-3xl font-semibold text-white">All products</h1>
            <p class="text-slate-400">Browse the full collection with category and search filters.</p>
        </div>
        <form method="GET" action="index.php" class="flex flex-wrap items-center gap-3">
            <input type="hidden" name="route" value="catalog">
            <select name="category" class="form-select bg-slate-900 text-white border-white/10">
                <option value="">All categories</option>
                <?php foreach ($categories as $category): ?>
                    <option value="<?= h($category); ?>" <?= $activeCategory === $category ? 'selected' : ''; ?>><?= h($category); ?></option>
                <?php endforeach; ?>
            </select>
            <input type="search" name="q" placeholder="Search products" value="<?= h($query ?? ''); ?>" class="form-control bg-slate-900 text-white border-white/10" />
            <button class="gradient-cta glass-button px-4 py-2 rounded-xl text-slate-900 font-semibold border-0">Apply</button>
        </form>
    </div>

    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php if (empty($products)): ?>
            <div class="col-span-full frosted-card p-6 text-center text-slate-300">
                No products found. Try a different filter.
            </div>
        <?php endif; ?>
        <?php foreach ($products as $product): ?>
            <div class="frosted-card overflow-hidden flex flex-col">
                <div class="relative">
                    <img src="<?= h($product['image']); ?>" alt="<?= h($product['name']); ?>" class="h-52 w-full object-cover">
                    <div class="absolute top-3 left-3 tag-badge"><?= h($product['badge']); ?></div>
                </div>
                <div class="p-5 flex-1 flex flex-col gap-3">
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-slate-400"><?= h($product['category']); ?></span>
                        <span class="text-white font-semibold">$<?= number_format($product['price'], 2); ?></span>
                    </div>
                    <h3 class="text-lg font-semibold text-white"><?= h($product['name']); ?></h3>
                    <p class="text-sm text-slate-400"><?= h($product['description']); ?></p>
                    <div class="flex items-center gap-2 text-xs text-slate-300">
                        <i class="bi bi-star-fill text-amber-300"></i> <?= number_format($product['rating'], 1); ?>
                        <span class="chip">Stock: <?= (int) $product['stock']; ?></span>
                    </div>
                    <div class="flex items-center justify-between gap-3 mt-auto">
                        <a href="<?= route_url('product', ['id' => $product['id']]); ?>" class="text-cyan-300 text-sm hover:text-cyan-100">Details</a>
                        <form method="POST" action="<?= route_url('cart/add'); ?>">
                            <input type="hidden" name="id" value="<?= (int) $product['id']; ?>">
                            <button class="px-4 py-2 rounded-xl border border-white/10 bg-white/5 text-white hover:bg-white/10 text-sm">Add</button>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>
