<?php
session_start();
include 'db_connection.php'; // Database connection

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$plan = $_GET['plan'];
$price = $_GET['price'];

$sql = "INSERT INTO memberships (user_id, plan, price) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("isi", $user_id, $plan, $price);

if ($stmt->execute()) {
    echo "<script>alert('Membership purchased successfully!'); window.location.href='membership.php';</script>";
} else {
    echo "<script>alert('Error processing membership.'); window.location.href='membership.php';</script>";
}

$stmt->close();
$conn->close();
?>
