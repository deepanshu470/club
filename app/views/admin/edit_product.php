<?php require_once BASE_PATH . '/app/views/admin/header.php'; ?>

<h1 style="margin-bottom: 2rem;"><i class="fas fa-edit"></i> Edit Product</h1>

<div style="max-width: 800px;">
    <div class="card">
        <form method="POST" action="/admin/products/edit?id=<?= $product['id'] ?>" enctype="multipart/form-data">
            <div class="form-group">
                <label class="form-label">Product Name *</label>
                <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($product['name']) ?>" required>
            </div>

            <div class="form-group">
                <label class="form-label">Category *</label>
                <select name="category_id" class="form-control" required>
                    <option value="">Select Category</option>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?= $category['id'] ?>" <?= $category['id'] == $product['category_id'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($category['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-control" rows="4"><?= htmlspecialchars($product['description']) ?></textarea>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                <div class="form-group">
                    <label class="form-label">Price *</label>
                    <input type="number" name="price" step="0.01" class="form-control" value="<?= $product['price'] ?>" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Discount Price</label>
                    <input type="number" name="discount_price" step="0.01" class="form-control" value="<?= $product['discount_price'] ?>">
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Stock *</label>
                <input type="number" name="stock" class="form-control" value="<?= $product['stock'] ?>" required>
            </div>

            <div class="form-group">
                <label class="form-label">Product Image</label>
                <?php if ($product['image']): ?>
                    <div style="margin-bottom: 0.5rem;">
                        <img src="/public/<?= htmlspecialchars($product['image']) ?>" alt="" style="max-width: 200px; border-radius: 0.5rem;">
                    </div>
                <?php endif; ?>
                <input type="file" name="image" class="form-control" accept="image/*">
                <small style="color: #6B7280;">Leave empty to keep current image</small>
            </div>

            <div class="form-group">
                <label style="display: flex; align-items: center; gap: 0.5rem; cursor: pointer;">
                    <input type="checkbox" name="featured" value="1" <?= $product['featured'] ? 'checked' : '' ?>>
                    <span class="form-label" style="margin: 0;">Featured Product</span>
                </label>
            </div>

            <div style="display: flex; gap: 1rem;">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Update Product
                </button>
                <a href="/admin/products" class="btn btn-outline">
                    <i class="fas fa-times"></i> Cancel
                </a>
            </div>
        </form>
    </div>
</div>

<?php require_once BASE_PATH . '/app/views/admin/footer.php'; ?>
