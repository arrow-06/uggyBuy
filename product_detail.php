<?php 
include 'includes/header.php'; 
require_once 'database/db_connect.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('Location: products.php');
    exit;
}

$product_id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM products WHERE id = ? AND status = 'active'");
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "<p class='text-center'>Product not found.</p>";
    include 'includes/footer.php';
    exit;
}

$product = $result->fetch_assoc();
?>

<main class="container mt-5">
    <div class="row">
        <div class="col-md-6">
            <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" class="img-fluid">
        </div>
        <div class="col-md-6">
            <h2><?php echo htmlspecialchars($product['name']); ?></h2>
            <p class="lead"><?php echo htmlspecialchars($product['description']); ?></p>
            <p class="fw-bold fs-4">$<?php echo htmlspecialchars($product['price']); ?></p>
            <form action="includes/cart_handler.php" method="POST">
                <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                <input type="hidden" name="action" value="add">
                <div class="d-flex">
                    <input type="number" name="quantity" class="form-control me-2" value="1" min="1" style="width: 100px;">
                    <button type="submit" class="btn btn-primary">Add to Cart</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Related Products Section -->
    <section id="related-products" class="my-5">
        <h3 class="text-center">Related Products</h3>
        <!-- Related products will go here -->
    </section>
</main>

<?php 
$stmt->close();
$conn->close();
include 'includes/footer.php'; 
?>
