<?php $pageTitle = 'Achar Club | Small-batch pickles with a luxe finish'; ?>
<div class="grid md:grid-cols-2 gap-10 p-8">
    <div class="space-y-6">
        <div class="inline-flex items-center gap-2 px-3 py-2 rounded-full bg-emerald-400/10 border border-emerald-400/30 text-emerald-100 text-xs uppercase tracking-[0.2em]">
            <span class="h-2 w-2 rounded-full bg-emerald-400 animate-ping"></span> Freshly bottled this week
        </div>
        <h1 class="text-4xl md:text-5xl font-semibold leading-tight text-white">
            Boutique achar studio crafting bold, balanced ferments for design-forward kitchens.
        </h1>
        <p class="text-white/70 text-lg leading-relaxed">
            Layered flavors, unexpected pairings, and an experience-first storefront. Explore limited drops, signature blends, and tasting flight bundles shipped cold to your doorstep.
        </p>
        <div class="flex flex-wrap gap-3">
            <a href="?route=products" class="px-5 py-3 rounded-full bg-accent text-noir font-semibold shadow-lg shadow-amber-500/30 hover:-translate-y-0.5 transition">
                Shop the collection
            </a>
            <a href="?route=cart" class="px-5 py-3 rounded-full border border-white/20 text-white hover:bg-white/10 transition">
                View cart
            </a>
        </div>
        <div class="grid grid-cols-3 gap-4 text-sm text-white/70">
            <div class="p-3 rounded-2xl bg-white/5 border border-white/10">
                <p class="text-lg font-semibold text-white">48h</p>
                <p>Express cold shipping</p>
            </div>
            <div class="p-3 rounded-2xl bg-white/5 border border-white/10">
                <p class="text-lg font-semibold text-white">Handmade</p>
                <p>In micro-batches</p>
            </div>
            <div class="p-3 rounded-2xl bg-white/5 border border-white/10">
                <p class="text-lg font-semibold text-white">Certified</p>
                <p>Local seasonal produce</p>
            </div>
        </div>
    </div>
    <div class="relative">
        <div class="absolute inset-0 rounded-3xl bg-gradient-to-br from-emerald-500/30 via-amber-400/20 to-fuchsia-500/10 blur-3xl"></div>
        <div class="relative rounded-3xl border border-white/10 bg-white/10 p-6 shadow-2xl shadow-black/40">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-white/60">Curation</p>
                    <p class="text-2xl font-semibold text-white">Chef’s Flight</p>
                </div>
                <span class="px-4 py-2 rounded-full bg-white text-noir text-sm font-semibold">New Drop</span>
            </div>
            <div class="mt-6 grid grid-cols-3 gap-3">
                <?php foreach ($featured as $item): ?>
                    <div class="rounded-2xl bg-white/5 border border-white/10 p-3">
                        <div class="aspect-square rounded-xl overflow-hidden bg-white/5">
                            <img src="<?= htmlspecialchars($item['image'], ENT_QUOTES) ?>" alt="<?= htmlspecialchars($item['name'], ENT_QUOTES) ?>" class="h-full w-full object-cover">
                        </div>
                        <p class="mt-3 text-sm text-white/60"><?= htmlspecialchars($item['category'], ENT_QUOTES) ?></p>
                        <p class="text-base font-semibold text-white"><?= htmlspecialchars($item['name'], ENT_QUOTES) ?></p>
                        <p class="text-sm text-white/60">$<?= number_format((float) $item['price'], 2) ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
            <p class="mt-6 text-white/70 text-sm leading-relaxed">
                Crafted with Himalayan pink salt, cold-pressed mustard oil, and sun-fermented citrus to unlock layered aromatics.
            </p>
        </div>
    </div>
</div>

<div class="border-t border-white/5"></div>

<div class="p-8 space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <p class="text-sm uppercase tracking-[0.3em] text-white/50">Limited & Signature</p>
            <h2 class="text-2xl font-semibold text-white">Explore the atelier</h2>
        </div>
        <a href="?route=products" class="text-accent text-sm font-semibold hover:underline">View full collection</a>
    </div>
    <div class="grid md:grid-cols-3 gap-6">
        <?php foreach (array_slice($all, 0, 3) as $item): ?>
            <div class="rounded-3xl border border-white/10 bg-white/5 overflow-hidden hover:border-accent/50 transition shadow-lg shadow-black/30">
                <div class="aspect-[4/3] overflow-hidden">
                    <img src="<?= htmlspecialchars($item['image'], ENT_QUOTES) ?>" alt="<?= htmlspecialchars($item['name'], ENT_QUOTES) ?>" class="h-full w-full object-cover">
                </div>
                <div class="p-5 space-y-2">
                    <div class="flex items-center gap-2 text-xs text-white/60 uppercase tracking-[0.2em]">
                        <span class="h-1.5 w-1.5 rounded-full bg-accent animate-pulse"></span>
                        <?= htmlspecialchars($item['category'], ENT_QUOTES) ?>
                    </div>
                    <h3 class="text-lg font-semibold text-white"><?= htmlspecialchars($item['name'], ENT_QUOTES) ?></h3>
                    <p class="text-sm text-white/60 line-clamp-2"><?= htmlspecialchars($item['description'], ENT_QUOTES) ?></p>
                    <div class="flex items-center justify-between pt-2">
                        <p class="text-base font-semibold text-accent">$<?= number_format((float) $item['price'], 2) ?></p>
                        <a href="?route=product&id=<?= $item['id'] ?>" class="text-sm text-white hover:underline">Details</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
