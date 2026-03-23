<?php require_once BASE_PATH . '/app/views/admin/header.php'; ?>

<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
    <h1><i class="fas fa-tags"></i> Categories</h1>
    <button onclick="showAddCategory()" class="btn btn-primary">
        <i class="fas fa-plus"></i> Add Category
    </button>
</div>

<?php if (isset($_SESSION['success'])): ?>
    <div class="alert alert-success">
        <i class="fas fa-check-circle"></i> <?= htmlspecialchars($_SESSION['success']) ?>
    </div>
    <?php unset($_SESSION['success']); ?>
<?php endif; ?>

<!-- Add/Edit Category Form -->
<div id="categoryForm" class="card" style="display: none; margin-bottom: 2rem;">
    <h3 id="formTitle"><i class="fas fa-plus"></i> Add Category</h3>
    <form method="POST" action="/admin/categories">
        <input type="hidden" id="categoryId" name="id">

        <div class="form-group">
            <label class="form-label">Category Name *</label>
            <input type="text" id="categoryName" name="name" class="form-control" required>
        </div>

        <div class="form-group">
            <label class="form-label">Description</label>
            <textarea id="categoryDescription" name="description" class="form-control" rows="3"></textarea>
        </div>

        <div style="display: flex; gap: 1rem;">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Save Category
            </button>
            <button type="button" onclick="hideForm()" class="btn btn-outline">
                <i class="fas fa-times"></i> Cancel
            </button>
        </div>
    </form>
</div>

<!-- Categories List -->
<div class="card">
    <?php if (empty($categories)): ?>
        <p style="text-align: center; color: #6B7280; padding: 2rem;">No categories found</p>
    <?php else: ?>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($categories as $category): ?>
                    <tr>
                        <td><?= $category['id'] ?></td>
                        <td><strong><?= htmlspecialchars($category['name']) ?></strong></td>
                        <td><?= htmlspecialchars($category['slug']) ?></td>
                        <td><?= htmlspecialchars($category['description']) ?></td>
                        <td>
                            <button onclick='editCategory(<?= json_encode($category) ?>)' class="btn btn-secondary" style="padding: 0.5rem 0.75rem;">
                                <i class="fas fa-edit"></i>
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<script>
function showAddCategory() {
    document.getElementById('categoryForm').style.display = 'block';
    document.getElementById('formTitle').innerHTML = '<i class="fas fa-plus"></i> Add Category';
    document.getElementById('categoryId').value = '';
    document.getElementById('categoryName').value = '';
    document.getElementById('categoryDescription').value = '';
}

function editCategory(category) {
    document.getElementById('categoryForm').style.display = 'block';
    document.getElementById('formTitle').innerHTML = '<i class="fas fa-edit"></i> Edit Category';
    document.getElementById('categoryId').value = category.id;
    document.getElementById('categoryName').value = category.name;
    document.getElementById('categoryDescription').value = category.description;
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

function hideForm() {
    document.getElementById('categoryForm').style.display = 'none';
}
</script>

<?php require_once BASE_PATH . '/app/views/admin/footer.php'; ?>
