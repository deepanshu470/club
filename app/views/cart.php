<?php $pageTitle = 'Cart | Achar Club'; ?>
<div class="p-8 space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <p class="text-sm uppercase tracking-[0.3em] text-white/50">Your curation</p>
            <h1 class="text-3xl font-semibold text-white">Cart overview</h1>
        </div>
        <a href="?route=products" class="text-sm text-white/70 hover:text-white underline-offset-4 hover:underline">Continue shopping</a>
    </div>

    <?php if (empty($items)): ?>
        <div class="rounded-2xl border border-white/10 bg-white/5 p-6 text-white/70">
            Cart is empty. Discover flavors in the collection.
        </div>
    <?php else: ?>
        <div class="space-y-4">
            <?php foreach ($items as $entry): $item = $entry['product']; ?>
                <div class="rounded-2xl border border-white/10 bg-white/5 p-4 flex flex-col sm:flex-row gap-4 sm:items-center sm:justify-between">
                    <div class="flex items-center gap-4">
                        <div class="h-20 w-20 rounded-xl overflow-hidden">
                            <img src="<?= htmlspecialchars($item['image'], ENT_QUOTES) ?>" alt="<?= htmlspecialchars($item['name'], ENT_QUOTES) ?>" class="h-full w-full object-cover">
                        </div>
                        <div>
                            <p class="text-sm text-white/60 uppercase tracking-[0.2em]"><?= htmlspecialchars($item['category'], ENT_QUOTES) ?></p>
                            <p class="text-lg font-semibold text-white"><?= htmlspecialchars($item['name'], ENT_QUOTES) ?></p>
                            <p class="text-sm text-white/60">$<?= number_format((float) $item['price'], 2) ?> / jar</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <form method="post" class="flex items-center gap-2">
                            <input type="hidden" name="action" value="update_cart">
                            <input type="hidden" name="product_id" value="<?= $item['id'] ?>">
                            <input type="number" name="quantity" value="<?= $entry['quantity'] ?>" min="1" class="w-20 bg-white/10 border-white/20 text-white rounded-full px-3 py-2 text-sm">
                            <button type="submit" class="px-4 py-2 rounded-full bg-white/10 border border-white/20 text-white text-sm">Update</button>
                        </form>
                        <form method="post">
                            <input type="hidden" name="action" value="remove_from_cart">
                            <input type="hidden" name="product_id" value="<?= $item['id'] ?>">
                            <button type="submit" class="px-3 py-2 rounded-full bg-rose-500/20 border border-rose-400/40 text-rose-100 text-sm hover:bg-rose-500/30">Remove</button>
                        </form>
                        <div class="text-right">
                            <p class="text-sm text-white/60">Subtotal</p>
                            <p class="text-lg font-semibold text-white">$<?= number_format((float) $entry['total'], 2) ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="rounded-3xl border border-white/10 bg-white/5 p-6 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <p class="text-sm text-white/60">Total</p>
                <p class="text-2xl font-semibold text-accent">$<?= number_format((float) $total, 2) ?></p>
            </div>
            <form method="post" class="flex items-center gap-3">
                <input type="hidden" name="action" value="checkout">
                <button type="submit" class="px-6 py-3 rounded-full bg-accent text-noir font-semibold shadow-lg shadow-amber-500/30 hover:-translate-y-0.5 transition">
                    Checkout now
                </button>
            </form>
        </div>
    <?php endif; ?>
</div>
