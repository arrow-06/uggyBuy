<?php 
include 'includes/header.php'; 
require_once '../database/db_connect.php';

if (!isset($_GET['id'])) {
    header('Location: products.php');
    exit;
}

$product_id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();
$product = $result->fetch_assoc();
$stmt->close();
?>

<h1>Edit Product</h1>

<form action="includes/product_handler.php" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="action" value="edit">
    <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
    <input type="hidden" name="current_image" value="<?php echo htmlspecialchars($product['image']); ?>">
    <input type="hidden" name="current_file" value="<?php echo htmlspecialchars($product['file_path']); ?>">
    <div class="form-outline mb-4">
        <input type="text" id="name" name="name" class="form-control" value="<?php echo htmlspecialchars($product['name']); ?>" required />
        <label class="form-label" for="name">Product Name</label>
    </div>
    <div class="form-outline mb-4">
        <textarea class="form-control" id="description" name="description" rows="4" required><?php echo htmlspecialchars($product['description']); ?></textarea>
        <label class="form-label" for="description">Description</label>
    </div>
    <div class="form-outline mb-4">
        <input type="number" id="price" name="price" class="form-control" step="0.01" value="<?php echo htmlspecialchars($product['price']); ?>" required />
        <label class="form-label" for="price">Price</label>
    </div>
    <div class="mb-4">
        <label class="form-label" for="image">Product Image (leave blank to keep current)</label>
        <input type="file" class="form-control" id="image" name="image" accept="image/*" />
        <img src="../<?php echo htmlspecialchars($product['image']); ?>" width="100" class="mt-2">
    </div>
    <div class="mb-4">
        <label class="form-label" for="file">Digital File (leave blank to keep current)</label>
        <input type="file" class="form-control" id="file" name="file" />
    </div>
    <div class="form-outline mb-4">
        <select name="status" class="form-select">
            <option value="active" <?php echo $product['status'] === 'active' ? 'selected' : ''; ?>>Active</option>
            <option value="inactive" <?php echo $product['status'] === 'inactive' ? 'selected' : ''; ?>>Inactive</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Update Product</button>
</form>

<?php 
$conn->close();
include 'includes/footer.php'; 
?>
