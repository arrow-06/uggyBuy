<?php include 'includes/header.php'; ?>

<h1>Add New Product</h1>

<form action="includes/product_handler.php" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="action" value="add">
    <div class="form-outline mb-4">
        <input type="text" id="name" name="name" class="form-control" required />
        <label class="form-label" for="name">Product Name</label>
    </div>
    <div class="form-outline mb-4">
        <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
        <label class="form-label" for="description">Description</label>
    </div>
    <div class="form-outline mb-4">
        <input type="number" id="price" name="price" class="form-control" step="0.01" required />
        <label class="form-label" for="price">Price</label>
    </div>
    <div class="mb-4">
        <label class="form-label" for="image">Product Image</label>
        <input type="file" class="form-control" id="image" name="image" accept="image/*" required />
    </div>
    <div class="mb-4">
        <label class="form-label" for="file">Digital File</label>
        <input type="file" class="form-control" id="file" name="file" required />
    </div>
    <div class="form-outline mb-4">
        <select name="status" class="form-select">
            <option value="active">Active</option>
            <option value="inactive">Inactive</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Add Product</button>
</form>

<?php include 'includes/footer.php'; ?>
