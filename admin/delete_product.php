<?php
require_once '../database/db_connect.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // You might want to add additional checks here to ensure the user has permission to delete

    // First, delete related order items
    $stmt = $conn->prepare("DELETE FROM order_items WHERE product_id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();

    // Then, delete the product
    $stmt = $conn->prepare("DELETE FROM products WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header('Location: products.php');
    } else {
        die('Error deleting product.');
    }
    $stmt->close();
}

$conn->close();
?>
