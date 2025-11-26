<?php
session_start();
require_once '../database/db_connect.php';

if (!isset($_SESSION['loggedin'])) {
    header('Location: ../login.php');
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_new_password = $_POST['confirm_new_password'];

    if (empty($current_password) || empty($new_password) || empty($confirm_new_password)) {
        die("Please fill all fields.");
    }

    if ($new_password !== $confirm_new_password) {
        die("New passwords do not match.");
    }

    $stmt = $conn->prepare("SELECT password FROM users WHERE id = ?");
    $stmt->bind_param("i", $_SESSION['id']);
    $stmt->execute();
    $stmt->bind_result($hashed_password);
    $stmt->fetch();
    $stmt->close();

    if (password_verify($current_password, $hashed_password)) {
        $new_hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        $update_stmt = $conn->prepare("UPDATE users SET password = ? WHERE id = ?");
        $update_stmt->bind_param("si", $new_hashed_password, $_SESSION['id']);
        if ($update_stmt->execute()) {
            header("Location: ../profile.php?password_changed=success");
        } else {
            die("Error updating password.");
        }
        $update_stmt->close();
    } else {
        die("Incorrect current password.");
    }

    $conn->close();
}
?>
