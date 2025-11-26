<?php 
include 'includes/header.php'; 

if (!isset($_GET['order_id'])) {
    header('Location: index.php');
    exit;
}
?>

<main class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8 text-center">
            <div class="card">
                <div class="card-body">
                    <h1 class="card-title text-success">Order Successful!</h1>
                    <p>Thank you for your purchase. Your order ID is <strong>#<?php echo htmlspecialchars($_GET['order_id']); ?></strong>.</p>
                    <p>You can view your order details and download your products from your profile.</p>
                    <a href="orders.php" class="btn btn-primary mt-3">View My Orders</a>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include 'includes/footer.php'; ?>
