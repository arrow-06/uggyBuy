<?php
require_once '../../database/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $action = $_POST['action'];

    if ($action === 'add') {
        $name = $_POST['name'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $status = $_POST['status'];

        // Handle file uploads
        $image_path = 'assets/img/' . basename($_FILES['image']['name']);
        $file_path = 'uploads/' . basename($_FILES['file']['name']);

        move_uploaded_file($_FILES['image']['tmp_name'], '../../' . $image_path);
        move_uploaded_file($_FILES['file']['tmp_name'], '../../' . $file_path);

        $stmt = $conn->prepare("INSERT INTO products (name, description, price, image, file_path, status) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssdsss", $name, $description, $price, $image_path, $file_path, $status);
        
        if ($stmt->execute()) {
            header('Location: ../products.php');
        } else {
            die('Error adding product.');
        }
        $stmt->close();
    }

    } elseif ($action === 'edit') {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $status = $_POST['status'];

        $image_path = $_POST['current_image'];
        if (!empty($_FILES['image']['name'])) {
            $image_path = 'assets/img/' . basename($_FILES['image']['name']);
            move_uploaded_file($_FILES['image']['tmp_name'], '../../' . $image_path);
        }

        $file_path = $_POST['current_file'];
        if (!empty($_FILES['file']['name'])) {
            $file_path = 'uploads/' . basename($_FILES['file']['name']);
            move_uploaded_file($_FILES['file']['tmp_name'], '../../' . $file_path);
        }

        $stmt = $conn->prepare("UPDATE products SET name = ?, description = ?, price = ?, image = ?, file_path = ?, status = ? WHERE id = ?");
        $stmt->bind_param("ssdsssi", $name, $description, $price, $image_path, $file_path, $status, $id);

        if ($stmt->execute()) {
            header('Location: ../products.php');
        } else {
            die('Error updating product.');
        }
        $stmt->close();
}

$conn->close();
?>
