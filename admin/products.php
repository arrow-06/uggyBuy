<?php 
include 'includes/header.php'; 
require_once '../database/db_connect.php';

$result = $conn->query("SELECT * FROM products ORDER BY created_at DESC");
?>

<div class="d-flex justify-content-between align-items-center">
    <h1>Products</h1>
    <a href="add_product.php" class="btn btn-primary">Add New Product</a>
</div>

<table class="table align-middle mb-0 bg-white">
    <thead class="bg-light">
        <tr>
            <th>Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($result->num_rows > 0): ?>
            <?php while($product = $result->fetch_assoc()): ?>
                <tr>
                    <td>
                        <div class="d-flex align-items-center">
                            <img src="../<?php echo htmlspecialchars($product['image']); ?>" alt="" style="width: 45px; height: 45px" class="rounded-circle" />
                            <div class="ms-3">
                                <p class="fw-bold mb-1"><?php echo htmlspecialchars($product['name']); ?></p>
                            </div>
                        </div>
                    </td>
                    <td><?php echo substr(htmlspecialchars($product['description']), 0, 50); ?>...</td>
                    <td>$<?php echo htmlspecialchars($product['price']); ?></td>
                    <td>
                        <span class="badge badge-<?php echo $product['status'] === 'active' ? 'success' : 'danger'; ?> d-inline">
                            <?php echo ucfirst($product['status']); ?>
                        </span>
                    </td>
                    <td>
                        <a href="edit_product.php?id=<?php echo $product['id']; ?>" class="btn btn-sm btn-info">Edit</a>
                        <a href="delete_product.php?id=<?php echo $product['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this product?');">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="5" class="text-center">No products found.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<?php 
$conn->close();
include 'includes/footer.php'; 
?>
