<?php 
include 'includes/header.php'; 
require_once 'database/db_connect.php';

if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['id'];
$orders = [];

$stmt = $conn->prepare("SELECT * FROM orders WHERE user_id = ? ORDER BY created_at DESC");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

while ($order = $result->fetch_assoc()) {
    $order_items = [];
    $item_stmt = $conn->prepare("SELECT p.name, p.file_path FROM order_items oi JOIN products p ON oi.product_id = p.id WHERE oi.order_id = ?");
    $item_stmt->bind_param("i", $order['id']);
    $item_stmt->execute();
    $item_result = $item_stmt->get_result();
    while ($item = $item_result->fetch_assoc()) {
        $order_items[] = $item;
    }
    $order['items'] = $order_items;
    $orders[] = $order;
    $item_stmt->close();
}
$stmt->close();
?>

<main class="container mt-5">
    <h1 class="text-center mb-4">My Orders</h1>

    <?php if (!empty($orders)): ?>
        <div class="accordion" id="ordersAccordion">
            <?php foreach ($orders as $order): ?>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading<?php echo $order['id']; ?>">
                        <button class="accordion-button collapsed" type="button" data-mdb-toggle="collapse" data-mdb-target="#collapse<?php echo $order['id']; ?>" aria-expanded="false" aria-controls="collapse<?php echo $order['id']; ?>">
                            Order #<?php echo $order['id']; ?> - <?php echo date('F j, Y', strtotime($order['created_at'])); ?> - $<?php echo number_format($order['total_amount'], 2); ?>
                        </button>
                    </h2>
                    <div id="collapse<?php echo $order['id']; ?>" class="accordion-collapse collapse" aria-labelledby="heading<?php echo $order['id']; ?>" data-mdb-parent="#ordersAccordion">
                        <div class="accordion-body">
                            <ul class="list-group">
                                <?php foreach ($order['items'] as $item): ?>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <?php echo htmlspecialchars($item['name']); ?>
                                        <a href="download.php?file=<?php echo urlencode(basename($item['file_path'])); ?>" class="btn btn-primary btn-sm">Download</a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p class="text-center">You have no orders.</p>
    <?php endif; ?>
</main>

<?php 
$conn->close();
include 'includes/footer.php'; 
?>
