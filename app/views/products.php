<?php $pageTitle = 'Shop | Achar Club'; ?>
<div class="p-8 space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
        <div>
            <p class="text-sm uppercase tracking-[0.3em] text-white/50">Collection</p>
            <h1 class="text-3xl font-semibold text-white">Signature jars & tasting flights</h1>
            <p class="text-white/60 text-sm mt-1">Fully responsive grid with add-to-cart.</p>
        </div>
        <a href="?route=cart" class="px-4 py-2 rounded-full bg-white text-noir font-semibold shadow-lg shadow-amber-500/30">View cart</a>
    </div>

    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php foreach ($products as $product): ?>
            <div class="rounded-3xl border border-white/10 bg-white/5 overflow-hidden flex flex-col shadow-xl shadow-black/40 hover:border-accent/40 transition">
                <div class="aspect-[4/3] overflow-hidden">
                    <img src="<?= htmlspecialchars($product['image'], ENT_QUOTES) ?>" alt="<?= htmlspecialchars($product['name'], ENT_QUOTES) ?>" class="h-full w-full object-cover">
                </div>
                <div class="p-5 flex-1 flex flex-col gap-3">
                    <div class="flex items-center justify-between text-xs text-white/60 uppercase tracking-[0.2em]">
                        <span class="flex items-center gap-2">
                            <span class="h-1.5 w-1.5 rounded-full bg-emerald-400"></span>
                            <?= htmlspecialchars($product['category'], ENT_QUOTES) ?>
                        </span>
                        <span>#<?= str_pad((string) $product['id'], 3, '0', STR_PAD_LEFT) ?></span>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-white"><?= htmlspecialchars($product['name'], ENT_QUOTES) ?></h3>
                        <p class="text-sm text-white/60 line-clamp-2"><?= htmlspecialchars($product['description'], ENT_QUOTES) ?></p>
                    </div>
                    <div class="flex items-center justify-between">
                        <p class="text-xl font-semibold text-accent">$<?= number_format((float) $product['price'], 2) ?></p>
                        <a href="?route=product&id=<?= $product['id'] ?>" class="text-sm text-white/70 hover:text-white underline-offset-4 hover:underline">Details</a>
                    </div>
                    <form method="post" class="flex items-center gap-2 pt-2">
                        <input type="hidden" name="action" value="add_to_cart">
                        <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                        <input type="number" name="quantity" value="1" min="1" class="w-16 bg-white/10 border-white/20 text-white rounded-full px-3 py-2 text-sm">
                        <button type="submit" class="flex-1 px-4 py-2 rounded-full bg-accent text-noir font-semibold shadow-lg shadow-amber-500/30 hover:-translate-y-0.5 transition">
                            Add to cart
                        </button>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
