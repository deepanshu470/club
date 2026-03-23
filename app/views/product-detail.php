<?php $pageTitle = htmlspecialchars($product['name'], ENT_QUOTES) . ' | Achar Club'; ?>
<div class="grid md:grid-cols-2 gap-10 p-8">
    <div class="rounded-3xl overflow-hidden border border-white/10 bg-white/5 shadow-2xl shadow-black/40">
        <div class="aspect-[4/5]">
            <img src="<?= htmlspecialchars($product['image'], ENT_QUOTES) ?>" alt="<?= htmlspecialchars($product['name'], ENT_QUOTES) ?>" class="h-full w-full object-cover">
        </div>
    </div>
    <div class="space-y-4">
        <div class="inline-flex items-center gap-2 px-3 py-2 rounded-full bg-white/10 border border-white/20 text-xs uppercase tracking-[0.2em] text-white/70">
            <span class="h-2 w-2 rounded-full bg-accent animate-ping"></span>
            <?= htmlspecialchars($product['category'], ENT_QUOTES) ?>
        </div>
        <h1 class="text-3xl font-semibold text-white"><?= htmlspecialchars($product['name'], ENT_QUOTES) ?></h1>
        <p class="text-white/70 leading-relaxed"><?= htmlspecialchars($product['description'], ENT_QUOTES) ?></p>
        <div class="flex flex-wrap gap-2">
            <?php foreach (($product['tags'] ?? []) as $tag): ?>
                <span class="px-3 py-1 rounded-full bg-white/10 border border-white/10 text-xs text-white/70">#<?= htmlspecialchars($tag, ENT_QUOTES) ?></span>
            <?php endforeach; ?>
        </div>
        <div class="flex items-center justify-between pt-2">
            <p class="text-2xl font-semibold text-accent">$<?= number_format((float) $product['price'], 2) ?></p>
            <a href="?route=products" class="text-sm text-white/70 hover:text-white underline-offset-4 hover:underline">Back to collection</a>
        </div>
        <form method="post" class="flex items-center gap-3 pt-4">
            <input type="hidden" name="action" value="add_to_cart">
            <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
            <label class="text-sm text-white/70">
                Qty
                <input type="number" name="quantity" value="1" min="1" class="ml-2 w-20 bg-white/10 border-white/20 text-white rounded-full px-3 py-2 text-sm">
            </label>
            <button type="submit" class="px-5 py-3 rounded-full bg-accent text-noir font-semibold shadow-lg shadow-amber-500/30 hover:-translate-y-0.5 transition flex items-center gap-2">
                <i class="bi bi-bag-heart"></i> Add to cart
            </button>
        </form>
        <div class="pt-6 border-t border-white/5 space-y-2">
            <p class="text-sm uppercase tracking-[0.3em] text-white/50">Pairs with</p>
            <div class="grid sm:grid-cols-2 gap-3">
                <?php foreach ($recommendations as $item): ?>
                    <a href="?route=product&id=<?= $item['id'] ?>" class="rounded-2xl border border-white/10 bg-white/5 px-4 py-3 hover:border-accent/50 transition flex items-center gap-3">
                        <div class="h-12 w-12 rounded-xl overflow-hidden">
                            <img src="<?= htmlspecialchars($item['image'], ENT_QUOTES) ?>" alt="<?= htmlspecialchars($item['name'], ENT_QUOTES) ?>" class="h-full w-full object-cover">
                        </div>
                        <div>
                            <p class="text-sm text-white/60"><?= htmlspecialchars($item['category'], ENT_QUOTES) ?></p>
                            <p class="text-white font-semibold"><?= htmlspecialchars($item['name'], ENT_QUOTES) ?></p>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
