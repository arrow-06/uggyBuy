<?php include 'includes/header.php'; ?>

    <main class="container mt-5">
        <!-- Hero Section -->
        <section id="hero" class="text-center my-5">
            <h1>Welcome to YBT Digital</h1>
            <p>Your one-stop shop for premium digital products.</p>
            <a href="products.php" class="btn btn-primary btn-lg">Explore Products</a>
        </section>

        <!-- Featured Products Section -->
        <section id="featured-products" class="my-5">
            <h2 class="text-center">Featured Products</h2>
            <div class="row">
                <?php
                require_once 'database/db_connect.php';
                $result = $conn->query("SELECT * FROM products WHERE status = 'active' ORDER BY created_at DESC LIMIT 3");
                if ($result->num_rows > 0) {
                    while($product = $result->fetch_assoc()) {
                ?>
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
                                <a href="product_detail.php?id=<?php echo $product['id']; ?>" class="btn btn-primary">Buy Now</a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                    }
                } else {
                    echo "<p class='text-center'>No featured products available.</p>";
                }
                $conn->close();
                ?>
            </div>
        </section>

        <!-- Testimonials Section -->
        <section id="testimonials" class="my-5">
            <h2 class="text-center">What Our Customers Say</h2>
            <!-- Testimonials will go here -->
        </section>

        <!-- FAQ Section -->
        <section id="faq" class="my-5">
            <h2 class="text-center">Frequently Asked Questions</h2>
            <!-- FAQ accordion will go here -->
        </section>
    </main>

<?php include 'includes/footer.php'; ?>