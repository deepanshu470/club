<section class="grid lg:grid-cols-2 gap-10 items-center mb-14 hero-grid">
    <div class="space-y-6">
        <div class="inline-flex items-center gap-2 px-3 py-2 rounded-full border border-white/10 bg-white/5 text-xs uppercase tracking-[0.2em] text-slate-300">
            Premium UI - Tailwind + Bootstrap - Responsive
        </div>
        <h1 class="text-4xl sm:text-5xl lg:text-6xl font-semibold leading-tight text-white">
            Elevate your brand with a <span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-indigo-400">premium</span> commerce experience.
        </h1>
        <p class="text-lg text-slate-300 max-w-2xl">
            Curated products, cinematic visuals, and frictionless flows. Built with modern MVC PHP, ready for every device and your admin control center.
        </p>
        <div class="flex flex-wrap gap-3">
            <a href="<?= route_url('catalog'); ?>" class="gradient-cta text-slate-900 font-semibold px-5 py-3 rounded-xl shadow-lg hover:opacity-95 transition glass-button">Explore collection</a>
            <a href="<?= route_url('admin/login'); ?>" class="px-5 py-3 rounded-xl border border-white/10 bg-white/5 text-white hover:bg-white/10 transition">Admin panel</a>
        </div>
        <div class="flex flex-wrap gap-3 text-sm text-slate-300">
            <span class="chip"><i class="bi bi-lightning-charge-fill text-cyan-300"></i> Instant cart</span>
            <span class="chip"><i class="bi bi-shield-check text-cyan-300"></i> Admin protected</span>
            <span class="chip"><i class="bi bi-columns-gap text-cyan-300"></i> MVC layout</span>
        </div>
    </div>
    <div class="relative">
        <div class="frosted-card p-6">
            <div class="rounded-2xl overflow-hidden shadow-2xl border border-white/10">
                <img class="w-full h-80 object-cover" src="https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?auto=format&fit=crop&w=1200&q=80" alt="Showcase">
            </div>
            <div class="grid grid-cols-3 gap-3 mt-4">
                <?php foreach (array_slice($featured, 0, 3) as $product): ?>
                    <div class="p-3 rounded-xl border border-white/10 bg-white/5">
                        <img src="<?= h($product['image']); ?>" alt="<?= h($product['name']); ?>" class="h-20 w-full object-cover rounded-lg mb-2">
                        <div class="text-xs uppercase tracking-wide text-slate-400"><?= h($product['category']); ?></div>
                        <div class="text-white font-semibold text-sm truncate"><?= h($product['name']); ?></div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>

<section class="mb-12">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h2 class="text-2xl font-semibold text-white">Featured highlights</h2>
            <p class="text-slate-400">Handpicked best sellers from every category.</p>
        </div>
        <a href="<?= route_url('catalog'); ?>" class="text-cyan-300 text-sm hover:text-cyan-200">View full shop -></a>
    </div>
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php foreach ($featured as $product): ?>
            <div class="frosted-card overflow-hidden flex flex-col">
                <div class="relative">
                    <img src="<?= h($product['image']); ?>" alt="<?= h($product['name']); ?>" class="h-56 w-full object-cover">
                    <div class="absolute top-3 left-3 tag-badge"><?= h($product['badge']); ?></div>
                    <div class="absolute top-3 right-3 chip bg-white/15 text-white">* <?= number_format($product['rating'], 1); ?></div>
                </div>
                <div class="p-5 flex-1 flex flex-col gap-3">
                    <div class="flex items-center justify-between">
                        <div class="text-sm text-slate-400"><?= h($product['category']); ?></div>
                        <div class="text-white font-semibold">$<?= number_format($product['price'], 2); ?></div>
                    </div>
                    <h3 class="text-lg font-semibold text-white"><?= h($product['name']); ?></h3>
                    <p class="text-sm text-slate-400"><?= h($product['description']); ?></p>
                    <div class="flex flex-wrap gap-2">
                        <?php foreach (array_slice($product['tags'], 0, 3) as $tag): ?>
                            <span class="chip text-xs"><?= h($tag); ?></span>
                        <?php endforeach; ?>
                    </div>
                    <div class="flex items-center justify-between gap-3 mt-auto">
                        <a href="<?= route_url('product', ['id' => $product['id']]); ?>" class="text-cyan-300 text-sm hover:text-cyan-100">View details</a>
                        <form method="POST" action="<?= route_url('cart/add'); ?>">
                            <input type="hidden" name="id" value="<?= (int) $product['id']; ?>">
                            <button class="gradient-cta glass-button px-4 py-2 rounded-xl text-slate-900 font-semibold text-sm border-0">Add to cart</button>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<section class="mb-12 frosted-card p-6">
    <div class="flex items-center justify-between mb-4">
        <div>
            <h3 class="text-xl font-semibold text-white">Shop by category</h3>
            <p class="text-slate-400">Browse curated picks tailored to your vibe.</p>
        </div>
        <a href="<?= route_url('catalog'); ?>" class="text-cyan-300 text-sm">All products</a>
    </div>
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-3">
        <?php foreach ($categories as $category): ?>
            <a href="<?= route_url('catalog', ['category' => $category]); ?>" class="mobile-link text-center">
                <div class="text-white font-semibold"><?= h($category); ?></div>
            </a>
        <?php endforeach; ?>
    </div>
</section>

<section class="mb-8">
    <div class="flex items-center justify-between mb-4">
        <div>
            <h3 class="text-xl font-semibold text-white">New drops</h3>
            <p class="text-slate-400">Fresh arrivals for the season.</p>
        </div>
    </div>
    <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-5">
        <?php foreach (array_slice($all, 0, 4) as $product): ?>
            <div class="rounded-2xl border border-white/10 bg-white/5 overflow-hidden">
                <img src="<?= h($product['image']); ?>" alt="<?= h($product['name']); ?>" class="h-44 w-full object-cover">
                <div class="p-4 space-y-2">
                    <div class="text-sm text-slate-400"><?= h($product['category']); ?></div>
                    <div class="flex items-center justify-between">
                        <h4 class="text-white font-semibold"><?= h($product['name']); ?></h4>
                        <span class="text-cyan-300 font-semibold">$<?= number_format($product['price'], 0); ?></span>
                    </div>
                    <a href="<?= route_url('product', ['id' => $product['id']]); ?>" class="text-sm text-cyan-300 hover:text-cyan-100">Explore -></a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>
