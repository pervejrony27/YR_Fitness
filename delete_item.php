<?php
session_start();
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'yr_fitness';

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (!isset($_SESSION['user_id']) || !isset($_POST['id']) || !isset($_POST['type'])) {
    echo "error";
    exit;
}

$user_id = $_SESSION['user_id'];
$id = intval($_POST['id']);
$type = $_POST['type'];

if ($type === 'wishlist') {
    $sql = "DELETE FROM wishlist WHERE product_id = ? AND user_id = ?";
} elseif ($type === 'membership') {
    $sql = "DELETE FROM memberships WHERE id = ? AND user_id = ?";
} else {
    echo "error";
    exit;
}

$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $id, $user_id);

if ($stmt->execute()) {
    echo "success";
} else {
    echo "error";
}

$stmt->close();
$conn->close();
?>
