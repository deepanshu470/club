<?php $relatedItems = array_filter($related, fn ($item) => $item['id'] !== $product['id']); ?>
<section class="grid lg:grid-cols-2 gap-10">
    <div class="frosted-card overflow-hidden">
        <img src="<?= h($product['image']); ?>" alt="<?= h($product['name']); ?>" class="w-full h-full object-cover">
    </div>
    <div class="space-y-4">
        <div class="flex items-center gap-2">
            <span class="tag-badge"><?= h($product['badge']); ?></span>
            <span class="chip"><i class="bi bi-star-fill text-amber-300"></i> <?= number_format($product['rating'], 1); ?></span>
            <span class="chip">Stock <?= (int) $product['stock']; ?></span>
        </div>
        <h1 class="text-3xl font-semibold text-white"><?= h($product['name']); ?></h1>
        <div class="text-lg text-slate-300"><?= h($product['description']); ?></div>
        <div class="text-3xl font-bold text-white">$<?= number_format($product['price'], 2); ?></div>

        <div class="flex flex-wrap gap-2">
            <?php foreach ($product['tags'] as $tag): ?>
                <span class="chip text-xs"><?= h($tag); ?></span>
            <?php endforeach; ?>
        </div>

        <div class="grid sm:grid-cols-2 gap-3">
            <div class="rounded-xl border border-white/10 bg-white/5 p-3">
                <div class="text-xs text-slate-400 uppercase">Colors</div>
                <div class="flex flex-wrap gap-2 mt-2">
                    <?php foreach ($product['colors'] as $color): ?>
                        <span class="chip text-xs"><?= h($color); ?></span>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="rounded-xl border border-white/10 bg-white/5 p-3">
                <div class="text-xs text-slate-400 uppercase">Sizes</div>
                <div class="flex flex-wrap gap-2 mt-2">
                    <?php foreach ($product['sizes'] as $size): ?>
                        <span class="chip text-xs"><?= h($size); ?></span>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <form method="POST" action="<?= route_url('cart/add'); ?>" class="space-y-3">
            <input type="hidden" name="id" value="<?= (int) $product['id']; ?>">
            <label class="block text-sm text-slate-300">Quantity</label>
            <div class="flex items-center gap-3">
                <input type="number" name="quantity" value="1" min="1" class="form-control w-28 bg-slate-900 text-white border-white/10">
                <button class="gradient-cta glass-button px-5 py-3 rounded-xl text-slate-900 font-semibold border-0">Add to cart</button>
                <a href="<?= route_url('cart'); ?>" class="px-4 py-3 rounded-xl border border-white/10 bg-white/5 text-white hover:bg-white/10">View cart</a>
            </div>
        </form>
    </div>
</section>

<?php if (!empty($relatedItems)): ?>
    <section class="mt-12">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-xl font-semibold text-white">You may also like</h3>
            <a href="<?= route_url('catalog'); ?>" class="text-sm text-cyan-300">Browse all</a>
        </div>
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php foreach (array_slice($relatedItems, 0, 3) as $item): ?>
                <div class="frosted-card overflow-hidden">
                    <img src="<?= h($item['image']); ?>" alt="<?= h($item['name']); ?>" class="h-44 w-full object-cover">
                    <div class="p-4 space-y-2">
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-slate-400"><?= h($item['category']); ?></span>
                            <span class="text-white font-semibold">$<?= number_format($item['price'], 0); ?></span>
                        </div>
                        <div class="text-white font-semibold"><?= h($item['name']); ?></div>
                        <a class="text-sm text-cyan-300 hover:text-cyan-100" href="<?= route_url('product', ['id' => $item['id']]); ?>">View product</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
<?php endif; ?>
