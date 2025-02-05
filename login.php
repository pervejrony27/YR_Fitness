<?php
session_start();
include 'db_connection.php'; // Ensure this file correctly connects to your database

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error()); // Debugging step
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Ensure the SQL query is correct
    $sql = "SELECT id, username, password FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("SQL Error: " . $conn->error); // Debugging step
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $stmt->close();

    if ($user && password_verify($password, $user['password'])) {
        // Set session variables
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['email'] = $email;
        $_SESSION['username'] = $user['username'];

        // Redirect with username in the URL
        header("Location: index.php?username=" . urlencode($user['username']));
        exit();
    } else {
        $error = "Invalid email or password.";
        header("Location: index.php?error=" . urlencode($error));
        exit();
    }

    $conn->close();
}
?>
