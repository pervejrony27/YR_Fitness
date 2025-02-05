<?php
session_start();
include 'db_connection.php';  // Include your database connection

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    die("You must be logged in to submit a review.");
}

// If the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_SESSION['username'];  // Get the username from session
    $review = trim($_POST['review']);   // Get the review text from the POST request

    // Check if the review is not empty
    if (!empty($review)) {
        // Prepare SQL query to insert the review into the database
        $stmt = $conn->prepare("INSERT INTO reviews_user (username, review, created_at) VALUES (?, ?, NOW())");
        $stmt->bind_param("ss", $username, $review);

        // Execute the query
        if ($stmt->execute()) {
            // Redirect to the dashboard.php page with a success message
            $_SESSION['success_message'] = "Review submitted successfully!";
            header("Location: dashboard.php");
            exit;  // Ensure no further code is executed after the redirection
        } else {
            echo "<p>Error: " . $stmt->error . "</p>";
        }

        // Close the prepared statement
        $stmt->close();
    } else {
        echo "<p>Review cannot be empty.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit a Review</title>
    <link rel="stylesheet" href="styles/dashboardstyle.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 80px;
            width: 100%;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #333;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        textarea {
            width: 100%;
            height: 100px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            resize: none;
            margin-bottom: 10px;
        }
        button {
            background: #28a745;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background: #218838;
        }
    </style>
</head>
<body>
    <?php include 'sidebar.php'; ?>
    
    <!-- Review Form -->
    <div class="container">
        <h2>Submit Your Review</h2>
        <form action="review.php" method="POST">
            <textarea name="review" required placeholder="Write your review here..."></textarea>
            <button type="submit">Submit Review</button>
        </form>
    </div>

</body>
</html>
