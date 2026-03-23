<?php $isEdit = !empty($product); ?>
<div class="flex items-center justify-between mb-6">
    <div>
        <h1 class="text-3xl font-semibold text-white"><?= $isEdit ? 'Edit product' : 'Create product'; ?></h1>
        <p class="text-slate-400 text-sm"><?= $isEdit ? 'Update details and inventory.' : 'Add a new product to the catalog.'; ?></p>
    </div>
    <a href="<?= route_url('admin'); ?>" class="px-4 py-3 rounded-xl border border-white/10 bg-white/5 text-white hover:bg-white/10">Back</a>
</div>

<form method="POST" action="<?= route_url('admin/save'); ?>" class="grid lg:grid-cols-2 gap-5">
    <?php if ($isEdit): ?>
        <input type="hidden" name="id" value="<?= (int) $product['id']; ?>">
    <?php endif; ?>
    <div class="space-y-3">
        <label class="text-sm text-slate-300">Name</label>
        <input required name="name" class="form-control bg-slate-900 text-white border-white/10" value="<?= h($product['name'] ?? ''); ?>">
    </div>
    <div class="space-y-3">
        <label class="text-sm text-slate-300">Category</label>
        <input required name="category" list="categories" class="form-control bg-slate-900 text-white border-white/10" value="<?= h($product['category'] ?? ''); ?>">
        <datalist id="categories">
            <?php foreach ($categories as $category): ?>
                <option value="<?= h($category); ?>"></option>
            <?php endforeach; ?>
        </datalist>
    </div>
    <div class="space-y-3">
        <label class="text-sm text-slate-300">Price</label>
        <input required type="number" step="0.01" name="price" class="form-control bg-slate-900 text-white border-white/10" value="<?= h($product['price'] ?? '0'); ?>">
    </div>
    <div class="space-y-3">
        <label class="text-sm text-slate-300">Stock</label>
        <input required type="number" name="stock" class="form-control bg-slate-900 text-white border-white/10" value="<?= h($product['stock'] ?? '0'); ?>">
    </div>
    <div class="space-y-3">
        <label class="text-sm text-slate-300">Badge</label>
        <input name="badge" class="form-control bg-slate-900 text-white border-white/10" value="<?= h($product['badge'] ?? 'New'); ?>">
    </div>
    <div class="space-y-3">
        <label class="text-sm text-slate-300">Rating</label>
        <input type="number" step="0.1" name="rating" class="form-control bg-slate-900 text-white border-white/10" value="<?= h($product['rating'] ?? '4.5'); ?>">
    </div>
    <div class="space-y-3 lg:col-span-2">
        <label class="text-sm text-slate-300">Description</label>
        <textarea name="description" rows="3" class="form-control bg-slate-900 text-white border-white/10"><?= h($product['description'] ?? ''); ?></textarea>
    </div>
    <div class="space-y-3">
        <label class="text-sm text-slate-300">Tags (comma separated)</label>
        <input name="tags" class="form-control bg-slate-900 text-white border-white/10" value="<?= h(isset($product['tags']) ? implode(', ', $product['tags']) : ''); ?>">
    </div>
    <div class="space-y-3">
        <label class="text-sm text-slate-300">Colors (comma separated)</label>
        <input name="colors" class="form-control bg-slate-900 text-white border-white/10" value="<?= h(isset($product['colors']) ? implode(', ', $product['colors']) : ''); ?>">
    </div>
    <div class="space-y-3">
        <label class="text-sm text-slate-300">Sizes (comma separated)</label>
        <input name="sizes" class="form-control bg-slate-900 text-white border-white/10" value="<?= h(isset($product['sizes']) ? implode(', ', $product['sizes']) : ''); ?>">
    </div>
    <div class="space-y-3">
        <label class="text-sm text-slate-300">Image URL</label>
        <input name="image" class="form-control bg-slate-900 text-white border-white/10" value="<?= h($product['image'] ?? ''); ?>">
    </div>
    <div class="flex items-center gap-2">
        <input type="checkbox" name="featured" <?= !empty($product['featured']) ? 'checked' : ''; ?> class="form-check-input bg-slate-900 border-white/30">
        <label class="text-sm text-slate-300">Featured</label>
    </div>
    <div class="lg:col-span-2 flex gap-3">
        <button class="gradient-cta glass-button px-5 py-3 rounded-xl text-slate-900 font-semibold border-0"><?= $isEdit ? 'Save changes' : 'Create product'; ?></button>
        <a href="<?= route_url('admin'); ?>" class="px-4 py-3 rounded-xl border border-white/10 bg-white/5 text-white hover:bg-white/10">Cancel</a>
    </div>
</form>
