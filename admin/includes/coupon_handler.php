<?php
require_once '../../database/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $action = $_POST['action'];

    if ($action === 'add') {
        $code = $_POST['code'];
        $type = $_POST['type'];
        $value = $_POST['value'];
        $expiry_date = !empty($_POST['expiry_date']) ? $_POST['expiry_date'] : null;
        $usage_limit = !empty($_POST['usage_limit']) ? (int)$_POST['usage_limit'] : null;

        $stmt = $conn->prepare("INSERT INTO coupons (code, type, value, expiry_date, usage_limit) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssdsi", $code, $type, $value, $expiry_date, $usage_limit);
        
        if ($stmt->execute()) {
            header('Location: ../coupons.php');
        } else {
            die('Error adding coupon.');
        }
        $stmt->close();
    }

    // More actions (edit, delete) will be added here
}

$conn->close();
?>
