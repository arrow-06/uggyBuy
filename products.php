<?php 
include 'includes/header.php'; 
require_once 'database/db_connect.php';

$result = $conn->query("SELECT * FROM products WHERE status = 'active'");
?>

<main class="container mt-5">
    <h1 class="text-center mb-4">Our Products</h1>

    <!-- Filters and Search -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="form-outline">
                <input type="search" id="search" class="form-control" />
                <label class="form-label" for="search">Search</label>
            </div>
        </div>
        <div class="col-md-8 d-flex justify-content-end">
            <select class="form-select me-2" style="width: auto;">
                <option selected>All Categories</option>
            </select>
            <select class="form-select me-2" style="width: auto;">
                <option selected>Sort by Price</option>
                <option value="1">Low to High</option>
                <option value="2">High to Low</option>
            </select>
            <select class="form-select" style="width: auto;">
                <option selected>Sort by Popularity</option>
            </select>
        </div>
    </div>

    <!-- Product Grid -->
    <div class="row">
        <?php if ($result->num_rows > 0): ?>
            <?php while($product = $result->fetch_assoc()): ?>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                            <img src="<?php echo htmlspecialchars($product['image']); ?>" class="img-fluid" />
                            <a href="product_detail.php?id=<?php echo $product['id']; ?>">
                                <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                            </a>
                        </div>
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title"><?php echo htmlspecialchars($product['name']); ?></h5>
                            <p class="card-text"><?php echo substr(htmlspecialchars($product['description']), 0, 100); ?>...</p>
                            <div class="mt-auto">
                                <p class="fw-bold fs-5 mb-2">$<?php echo htmlspecialchars($product['price']); ?></p>
                                <a href="product_detail.php?id=<?php echo $product['id']; ?>" class="btn btn-primary">View Details</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p class="text-center">No products found.</p>
        <?php endif; ?>
    </div>
</main>

<?php 
$conn->close();
include 'includes/footer.php'; 
?>
