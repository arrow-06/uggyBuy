<?php 
include 'includes/header.php'; 
require_once 'database/db_connect.php';

if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit;
}

if (empty($_SESSION['cart'])) {
    header('Location: products.php');
    exit;
}

$cart_items = [];
$total_price = 0;

$product_ids = array_keys($_SESSION['cart']);
$placeholders = implode(',', array_fill(0, count($product_ids), '?'));
$types = str_repeat('i', count($product_ids));

$stmt = $conn->prepare("SELECT * FROM products WHERE id IN ($placeholders)");
$stmt->bind_param($types, ...$product_ids);
$stmt->execute();
$result = $stmt->get_result();

while ($product = $result->fetch_assoc()) {
    $quantity = $_SESSION['cart'][$product['id']];
    $cart_items[] = [
        'name' => $product['name'],
        'price' => $product['price'],
        'quantity' => $quantity
    ];
    $total_price += $product['price'] * $quantity;
}
$stmt->close();
?>

<main class="container mt-5">
    <h1 class="text-center mb-4">Checkout</h1>
    <div class="row">
        <div class="col-md-7">
            <h4>Billing Details</h4>
            <form action="includes/order_handler.php" method="POST">
                <!-- Payment Gateway Placeholder -->
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Payment Method</h5>
                        <p>Payment gateway integration (e.g., Stripe, Razorpay) will go here.</p>
                        <div id="payment-element"></div>
                        <button type="submit" class="btn btn-primary mt-3">Pay $<?php echo number_format($total_price, 2); ?></button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-5">
            <h4>Order Summary</h4>
            <ul class="list-group mb-3">
                <?php foreach ($cart_items as $item): ?>
                    <li class="list-group-item d-flex justify-content-between lh-sm">
                        <div>
                            <h6 class="my-0"><?php echo htmlspecialchars($item['name']); ?></h6>
                            <small class="text-muted">Quantity: <?php echo $item['quantity']; ?></small>
                        </div>
                        <span class="text-muted">$<?php echo number_format($item['price'] * $item['quantity'], 2); ?></span>
                    </li>
                <?php endforeach; ?>
                <li class="list-group-item d-flex justify-content-between">
                    <span>Total (USD)</span>
                    <strong>$<?php echo number_format($total_price, 2); ?></strong>
                </li>
            </ul>
        </div>
    </div>
</main>

<?php 
$conn->close();
include 'includes/footer.php'; 
?>
