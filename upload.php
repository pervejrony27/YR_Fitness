<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "yr_fitness";

// Create database connection
$conn = new mysqli($servername, $username, $password, $database);

// Check if connection is successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ensure request is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $price = $_POST['price'];

    // Ensure images directory exists
    $target_dir = "product_images/";
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    // Generate a unique file name to avoid overwriting
    $image_name = time() . "_" . basename($_FILES["image"]["name"]); // Only filename
    $target_file = $target_dir . $image_name;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Allowed file formats
    $allowed_extensions = array("jpg", "jpeg", "png", "gif");
    if (!in_array($imageFileType, $allowed_extensions)) {
        die("Only JPG, JPEG, PNG, and GIF files are allowed.");
    }

    // Move file to the images folder
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        // Store only the file name in the database
        $sql = "INSERT INTO products (title, price, img) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sds", $title, $price, $image_name);

        if ($stmt->execute()) {
            echo "Product uploaded successfully!";
            header("Location: addproduct.php"); // Redirect to prevent form resubmission
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }
        
        $stmt->close();
    } else {
        echo "Error uploading file.";
    }
}

$conn->close();
?>
