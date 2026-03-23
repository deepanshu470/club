<div class="flex items-center justify-between mb-6">
    <div>
        <h1 class="text-3xl font-semibold text-white">Dashboard</h1>
        <p class="text-slate-400 text-sm">Manage products, inventory, and featured status.</p>
    </div>
    <div class="flex gap-3">
        <a href="<?= route_url('admin/edit'); ?>" class="gradient-cta glass-button px-4 py-3 rounded-xl text-slate-900 font-semibold border-0">Add product</a>
        <a href="<?= route_url('admin/logout'); ?>" class="px-4 py-3 rounded-xl border border-white/10 bg-white/5 text-white hover:bg-white/10">Logout</a>
    </div>
</div>

<div class="frosted-card p-5">
    <div class="overflow-x-auto">
        <table class="min-w-full admin-table text-sm text-slate-200">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Featured</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product): ?>
                    <tr>
                        <td><?= (int) $product['id']; ?></td>
                        <td class="font-semibold text-white"><?= h($product['name']); ?></td>
                        <td><?= h($product['category']); ?></td>
                        <td>$<?= number_format($product['price'], 2); ?></td>
                        <td><?= (int) $product['stock']; ?></td>
                        <td><?= !empty($product['featured']) ? 'Yes' : 'No'; ?></td>
                        <td>
                            <a href="<?= route_url('admin/edit', ['id' => $product['id']]); ?>" class="text-cyan-300 hover:text-cyan-100">Edit</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
