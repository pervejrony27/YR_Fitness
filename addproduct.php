<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    die("Access Denied. Please log in first.");
}

// Allow only a specific email
$allowed_email = "admin@gmail.com";
if ($_SESSION['email'] !== $allowed_email) {
    die("Access Denied. You are not authorized to add products.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link rel="stylesheet" href="styles/dashboardstyle.css">
</head>
<body>
    <?php include 'sidebar.php'; ?>
    <main>
        <h2>Add Product</h2>
        <form action="upload.php" method="post" enctype="multipart/form-data">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" required>
            
            <label for="price">Price:</label>
            <input type="number" id="price" name="price" step="0.01" required>
            
            <label for="image">Upload Image:</label>
            <input type="file" id="image" name="image" accept="image/*" required>
            
            <button type="submit">Submit</button>
        </form>
    </main>
</body>
</html>
