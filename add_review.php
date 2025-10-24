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
    $rating = isset($_POST['rating']) ? (int)$_POST['rating'] : 0;  // Get the rating value

    // Check if the review is not empty and rating is valid
    if (!empty($review) && $rating > 0 && $rating <= 5) {
        // Prepare SQL query to insert the review into the database
        $stmt = $conn->prepare("INSERT INTO reviews (name, review_text, rating, created_at) VALUES (?, ?, ?, NOW())");

        // Check if prepare() was successful
        if ($stmt === false) {
            die("Error preparing the statement: " . $conn->error);
        }

        $stmt->bind_param("ssi", $username, $review, $rating);

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
        echo "<p>Please enter a valid review and select a rating.</p>";
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
            width: 80%;
            margin: 80px auto;
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
        textarea, select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        textarea {
            height: 200px;
            resize: none;
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
        <form action="" method="POST">
            <textarea name="review" required placeholder="Write your review here..."></textarea>
            
            <!-- Dropdown for rating -->
            <label for="rating">Rating:</label>
            <select name="rating" required>
                <option value="">Select Rating</option>
                <option value="1">⭐ 1 - Poor</option>
                <option value="2">⭐⭐ 2 - Fair</option>
                <option value="3">⭐⭐⭐ 3 - Good</option>
                <option value="4">⭐⭐⭐⭐ 4 - Very Good</option>
                <option value="5">⭐⭐⭐⭐⭐ 5 - Excellent</option>
            </select>

            <button type="submit">Submit Review</button>
        </form>
    </div>

</body>
</html>
