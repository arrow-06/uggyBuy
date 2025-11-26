<?php
session_start();
require_once '../database/db_connect.php';

if (!isset($_SESSION['loggedin']) || empty($_SESSION['cart'])) {
    header('Location: ../index.php');
    exit;
}

$user_id = $_SESSION['id'];
$total_price = 0;
$cart_items = [];

$product_ids = array_keys($_SESSION['cart']);
$placeholders = implode(',', array_fill(0, count($product_ids), '?'));
$types = str_repeat('i', count($product_ids));

$stmt = $conn->prepare("SELECT id, price FROM products WHERE id IN ($placeholders)");
$stmt->bind_param($types, ...$product_ids);
$stmt->execute();
$result = $stmt->get_result();

while ($product = $result->fetch_assoc()) {
    $quantity = $_SESSION['cart'][$product['id']];
    $cart_items[$product['id']] = ['price' => $product['price'], 'quantity' => $quantity];
    $total_price += $product['price'] * $quantity;
}
$stmt->close();

// Simulate a successful transaction
$transaction_id = 'txn_' . uniqid();

$conn->begin_transaction();

try {
    $stmt = $conn->prepare("INSERT INTO orders (user_id, transaction_id, total_amount, status) VALUES (?, ?, ?, 'completed')");
    $stmt->bind_param("isd", $user_id, $transaction_id, $total_price);
    $stmt->execute();
    $order_id = $stmt->insert_id;
    $stmt->close();

    $item_stmt = $conn->prepare("INSERT INTO order_items (order_id, product_id, price) VALUES (?, ?, ?)");
    foreach ($cart_items as $product_id => $item) {
        for ($i = 0; $i < $item['quantity']; $i++) {
            $item_stmt->bind_param("iid", $order_id, $product_id, $item['price']);
            $item_stmt->execute();
        }
    }
    $item_stmt->close();

    $conn->commit();

    // Clear the cart
    $_SESSION['cart'] = [];

    header("Location: ../order_confirmation.php?order_id=" . $order_id);
    exit;

} catch (mysqli_sql_exception $exception) {
    $conn->rollback();
    die("Order failed. Please try again.");
}

$conn->close();
?>
