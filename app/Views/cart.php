<section class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-semibold text-white">Your cart</h1>
            <p class="text-slate-400">Review items and update quantities before checkout.</p>
        </div>
        <a href="<?= route_url('catalog'); ?>" class="text-cyan-300 hover:text-cyan-100 text-sm">Continue shopping</a>
    </div>

    <?php if (empty($items)): ?>
        <div class="frosted-card p-6 text-center text-slate-300">
            Your cart is empty. <a class="text-cyan-300" href="<?= route_url('catalog'); ?>">Add products</a>.
        </div>
    <?php else: ?>
        <form method="POST" action="<?= route_url('cart/update'); ?>" class="grid lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2 space-y-4">
                <?php foreach ($items as $item): ?>
                    <?php $product = $item['product']; ?>
                    <div class="frosted-card p-4 flex gap-4 items-center">
                        <img src="<?= h($product['image']); ?>" alt="<?= h($product['name']); ?>" class="h-20 w-20 rounded-xl object-cover">
                        <div class="flex-1">
                            <div class="flex items-center justify-between gap-4">
                                <div>
                                    <div class="text-white font-semibold"><?= h($product['name']); ?></div>
                                    <div class="text-sm text-slate-400"><?= h($product['category']); ?></div>
                                </div>
                                <div class="text-white font-semibold">$<?= number_format($product['price'], 2); ?></div>
                            </div>
                            <div class="flex items-center gap-3 mt-3">
                                <input type="number" min="1" name="quantities[<?= (int) $product['id']; ?>]" value="<?= (int) $item['quantity']; ?>" class="form-control w-24 bg-slate-900 text-white border-white/10">
                                <button formaction="<?= route_url('cart/remove'); ?>" name="id" value="<?= (int) $product['id']; ?>" class="px-3 py-2 rounded-lg border border-white/10 bg-white/5 text-slate-300 hover:text-white text-sm">Remove</button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
                <button class="px-5 py-3 rounded-xl border border-white/10 bg-white/5 text-white hover:bg-white/10 text-sm">Update cart</button>
            </div>
            <div class="frosted-card p-5 space-y-4">
                <div class="flex items-center justify-between">
                    <span class="text-slate-300">Subtotal</span>
                    <span class="text-white font-semibold">$<?= number_format($total, 2); ?></span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-slate-300">Shipping</span>
                    <span class="text-white font-semibold">Free</span>
                </div>
                <div class="border-t border-white/10 pt-4 flex items-center justify-between">
                    <span class="text-white font-semibold">Total</span>
                    <span class="text-2xl font-bold text-white">$<?= number_format($total, 2); ?></span>
                </div>
                <a href="<?= route_url('checkout'); ?>" class="gradient-cta glass-button block text-center px-4 py-3 rounded-xl text-slate-900 font-semibold border-0">Proceed to checkout</a>
            </div>
        </form>
    <?php endif; ?>
</section>
