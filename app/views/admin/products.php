<?php require_once BASE_PATH . '/app/views/admin/header.php'; ?>

<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
    <h1><i class="fas fa-box"></i> Products</h1>
    <a href="/admin/products/add" class="btn btn-primary">
        <i class="fas fa-plus"></i> Add Product
    </a>
</div>

<?php if (isset($_SESSION['success'])): ?>
    <div class="alert alert-success">
        <i class="fas fa-check-circle"></i> <?= htmlspecialchars($_SESSION['success']) ?>
    </div>
    <?php unset($_SESSION['success']); ?>
<?php endif; ?>

<div class="card">
    <?php if (empty($products)): ?>
        <p style="text-align: center; color: #6B7280; padding: 2rem;">No products found</p>
    <?php else: ?>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Featured</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product): ?>
                    <tr>
                        <td><?= $product['id'] ?></td>
                        <td>
                            <?php if ($product['image']): ?>
                                <img src="/public/<?= htmlspecialchars($product['image']) ?>" alt="" style="width: 50px; height: 50px; object-fit: cover; border-radius: 0.25rem;">
                            <?php else: ?>
                                <div style="width: 50px; height: 50px; background: var(--light-gray); border-radius: 0.25rem; display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-image" style="color: #9CA3AF;"></i>
                                </div>
                            <?php endif; ?>
                        </td>
                        <td><strong><?= htmlspecialchars($product['name']) ?></strong></td>
                        <td><?= htmlspecialchars($product['category_name'] ?? 'N/A') ?></td>
                        <td>
                            <?php if ($product['discount_price']): ?>
                                <strong>₹<?= number_format($product['discount_price'], 2) ?></strong>
                                <br>
                                <small style="text-decoration: line-through; color: #9CA3AF;">₹<?= number_format($product['price'], 2) ?></small>
                            <?php else: ?>
                                <strong>₹<?= number_format($product['price'], 2) ?></strong>
                            <?php endif; ?>
                        </td>
                        <td><?= $product['stock'] ?></td>
                        <td>
                            <?php if ($product['featured']): ?>
                                <i class="fas fa-star" style="color: #F59E0B;"></i>
                            <?php else: ?>
                                <i class="far fa-star" style="color: #D1D5DB;"></i>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="/admin/products/edit?id=<?= $product['id'] ?>" class="btn btn-secondary" style="padding: 0.5rem 0.75rem; margin-right: 0.5rem;">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="/admin/products/delete?id=<?= $product['id'] ?>" class="btn btn-danger" style="padding: 0.5rem 0.75rem;" onclick="return confirm('Are you sure you want to delete this product?')">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<?php require_once BASE_PATH . '/app/views/admin/footer.php'; ?>
