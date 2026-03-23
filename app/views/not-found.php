<?php $pageTitle = 'Not found | Achar Club'; ?>
<div class="p-10 text-center space-y-4">
    <div class="inline-flex items-center justify-center h-16 w-16 rounded-3xl bg-rose-500/20 text-rose-200 text-2xl border border-rose-400/40">
        <i class="bi bi-compass"></i>
    </div>
    <h1 class="text-3xl font-semibold text-white">Missing flavor</h1>
    <p class="text-white/60"><?= htmlspecialchars($message ?? 'Page not found', ENT_QUOTES) ?></p>
    <div class="flex items-center justify-center gap-3">
        <a href="?route=home" class="px-5 py-3 rounded-full bg-white text-noir font-semibold">Back home</a>
        <a href="?route=products" class="px-5 py-3 rounded-full border border-white/20 text-white hover:bg-white/10">Shop collection</a>
    </div>
</div>
