<section class="grid lg:grid-cols-3 gap-8">
    <?php if (!empty($orderComplete)): ?>
        <div class="lg:col-span-2 frosted-card p-6 space-y-4">
            <div class="flex items-center justify-between">
                <h1 class="text-2xl font-semibold text-white">Order confirmed</h1>
                <span class="tag-badge">#<?= h($orderId); ?></span>
            </div>
            <p class="text-slate-300">Thank you, <?= h($name); ?>! We sent a confirmation to <?= h($email); ?>.</p>
            <div class="space-y-2 text-sm text-slate-300">
                <div><span class="text-slate-400">Ship to:</span> <?= h($address); ?>, <?= h($city); ?></div>
                <?php if (!empty($notes)): ?><div><span class="text-slate-400">Notes:</span> <?= h($notes); ?></div><?php endif; ?>
            </div>
            <div class="grid md:grid-cols-2 gap-3">
                <?php foreach ($items as $item): ?>
                    <div class="rounded-xl border border-white/10 bg-white/5 p-3 flex justify-between text-sm text-white">
                        <span><?= h($item['product']['name']); ?> x <?= (int) $item['quantity']; ?></span>
                        <span>$<?= number_format($item['subtotal'], 2); ?></span>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="flex items-center justify-between text-lg font-semibold text-white border-t border-white/10 pt-3">
                <span>Total</span>
                <span>$<?= number_format($total, 2); ?></span>
            </div>
            <a href="index.php" class="px-4 py-3 rounded-xl border border-white/10 bg-white/5 text-white hover:bg-white/10 inline-flex items-center gap-2">
                <i class="bi bi-arrow-left"></i> Continue shopping
            </a>
        </div>
    <?php else: ?>
        <div class="lg:col-span-2 frosted-card p-6 space-y-4">
            <div>
                <h1 class="text-2xl font-semibold text-white">Checkout</h1>
                <p class="text-slate-400">Provide shipping and contact details to complete your order.</p>
            </div>
            <?php if (empty($items)): ?>
                <div class="text-slate-300">Your cart is empty.</div>
            <?php else: ?>
                <form method="POST" action="<?= route_url('checkout/submit'); ?>" class="grid md:grid-cols-2 gap-4">
                    <div class="space-y-3">
                        <label class="text-sm text-slate-300">Full name</label>
                        <input required name="name" class="form-control bg-slate-900 text-white border-white/10" placeholder="Aman Kumar">
                    </div>
                    <div class="space-y-3">
                        <label class="text-sm text-slate-300">Email</label>
                        <input required type="email" name="email" class="form-control bg-slate-900 text-white border-white/10" placeholder="you@example.com">
                    </div>
                    <div class="space-y-3">
                        <label class="text-sm text-slate-300">Address</label>
                        <input required name="address" class="form-control bg-slate-900 text-white border-white/10" placeholder="123 Market Street">
                    </div>
                    <div class="space-y-3">
                        <label class="text-sm text-slate-300">City</label>
                        <input required name="city" class="form-control bg-slate-900 text-white border-white/10" placeholder="New Delhi">
                    </div>
                    <div class="md:col-span-2 space-y-3">
                        <label class="text-sm text-slate-300">Order notes</label>
                        <textarea name="notes" rows="3" class="form-control bg-slate-900 text-white border-white/10" placeholder="Delivery notes, preferences, etc."></textarea>
                    </div>
                    <div class="md:col-span-2 flex items-center gap-3">
                        <button class="gradient-cta glass-button px-5 py-3 rounded-xl text-slate-900 font-semibold border-0">Place order</button>
                        <a href="<?= route_url('cart'); ?>" class="px-4 py-3 rounded-xl border border-white/10 bg-white/5 text-white hover:bg-white/10">Back to cart</a>
                    </div>
                </form>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <div class="frosted-card p-5 space-y-3">
        <h3 class="text-white font-semibold text-lg">Order summary</h3>
        <?php if (empty($items)): ?>
            <p class="text-slate-400 text-sm">No items to show.</p>
        <?php else: ?>
            <div class="space-y-3">
                <?php foreach ($items as $item): ?>
                    <div class="flex items-center justify-between text-sm text-slate-200">
                        <span><?= h($item['product']['name']); ?> x <?= (int) $item['quantity']; ?></span>
                        <span>$<?= number_format($item['subtotal'], 2); ?></span>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="border-t border-white/10 pt-3 flex items-center justify-between text-white font-semibold">
                <span>Total</span>
                <span>$<?= number_format($total, 2); ?></span>
            </div>
        <?php endif; ?>
    </div>
</section>
