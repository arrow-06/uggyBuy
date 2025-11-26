<?php
session_start();
require_once 'database/db_connect.php';

if (!isset($_SESSION['loggedin'])) {
    die('Authentication required.');
}

if (!isset($_GET['file'])) {
    die('No file specified.');
}

$file_name = basename($_GET['file']);
$file_path_in_db = '/uploads/' . $file_name;
$full_file_path = __DIR__ . $file_path_in_db;

$user_id = $_SESSION['id'];

// Verify that the user has purchased the product associated with this file
$stmt = $conn->prepare(
    "SELECT p.id FROM products p " .
    "JOIN order_items oi ON p.id = oi.product_id " .
    "JOIN orders o ON oi.order_id = o.id " .
    "WHERE p.file_path = ? AND o.user_id = ? AND o.status = 'completed'"
);
$stmt->bind_param("si", $file_path_in_db, $user_id);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    if (file_exists($full_file_path)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . $file_name . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($full_file_path));
        readfile($full_file_path);
        exit;
    } else {
        http_response_code(404);
        die('File not found.');
    }
} else {
    http_response_code(403);
    die('Access denied. You have not purchased this item.');
}

$stmt->close();
$conn->close();
?>
