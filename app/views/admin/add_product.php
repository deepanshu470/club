<?php require_once BASE_PATH . '/app/views/admin/header.php'; ?>

<h1 style="margin-bottom: 2rem;"><i class="fas fa-plus"></i> Add Product</h1>

<div style="max-width: 800px;">
    <div class="card">
        <form method="POST" action="/admin/products/add" enctype="multipart/form-data">
            <div class="form-group">
                <label class="form-label">Product Name *</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="form-group">
                <label class="form-label">Category *</label>
                <select name="category_id" class="form-control" required>
                    <option value="">Select Category</option>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?= $category['id'] ?>"><?= htmlspecialchars($category['name']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-control" rows="4"></textarea>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                <div class="form-group">
                    <label class="form-label">Price *</label>
                    <input type="number" name="price" step="0.01" class="form-control" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Discount Price</label>
                    <input type="number" name="discount_price" step="0.01" class="form-control">
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Stock *</label>
                <input type="number" name="stock" class="form-control" required>
            </div>

            <div class="form-group">
                <label class="form-label">Product Image</label>
                <input type="file" name="image" class="form-control" accept="image/*">
            </div>

            <div class="form-group">
                <label style="display: flex; align-items: center; gap: 0.5rem; cursor: pointer;">
                    <input type="checkbox" name="featured" value="1">
                    <span class="form-label" style="margin: 0;">Featured Product</span>
                </label>
            </div>

            <div style="display: flex; gap: 1rem;">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Add Product
                </button>
                <a href="/admin/products" class="btn btn-outline">
                    <i class="fas fa-times"></i> Cancel
                </a>
            </div>
        </form>
    </div>
</div>

<?php require_once BASE_PATH . '/app/views/admin/footer.php'; ?>
