<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = ""; // Use your XAMPP password if any; otherwise, leave blank
$database = "yr_fitness";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch reviews from the database
$sql = "SELECT * FROM reviews"; // Replace 'reviews' with your table name
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reviews</title>
  <style>
    .reviews {
      padding: 40px 20px;
      background-color: #f9f9f9; /* Light background color */
      text-align: center;
    }

    .reviews-title {
      font-size: 2em;
      margin-bottom: 20px;
      color: red; /* Red color for the title */
    }

    .reviews-description {
      margin-bottom: 40px;
      color: #666; /* Medium text color */
    }

    .reviews-grid {
      display: flex;
      justify-content: space-around; /* Space out the cards */
      flex-wrap: wrap; /* Allow wrapping on smaller screens */
    }

    .review-card {
      background-color: #000000; /* Black background for cards */
      border: 2px solid rgb(222, 16, 16); /* Red border */
      border-radius: 8px; /* Rounded corners */
      padding: 20px;
      margin: 10px;
      width: 30%; /* Set width for cards */
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Subtle shadow */
      transition: transform 0.2s; /* Animation for hover effect */
    }

    .review-card:hover {
      transform: scale(1.05); /* Slightly enlarge on hover */
    }

    .reviewer-name {
      font-weight: bold; /* Bold text for reviewer name */
      margin-bottom: 10px;
      color: rgb(231, 6, 6); /* Red color for reviewer name */
    }

    .review-text {
      color: #efe5e5; /* Light text for review */
    }
  </style>
</head>
<body>
  <section class="reviews">
    <div class="container">
      <h2 class="reviews-title">What Our Members Say</h2>
      <p class="reviews-description">Join our community and see why our members love YR Fitness!</p>
      <div class="reviews-grid">

        <?php
        // Check if there are any reviews in the table
        if ($result->num_rows > 0) {
            // Loop through each review and display it
            while ($row = $result->fetch_assoc()) {
                echo "<div class='review-card'>";
                echo "<h5 class='reviewer-name'>" . htmlspecialchars($row['name']) . "</h5>";
                echo "<p class='review-text'>" . htmlspecialchars($row['review_text']) . "</p>";
                echo "</div>";
            }
        } else {
            echo "<p>No reviews available.</p>";
        }
        $conn->close();
        ?>

      </div>
    </div>
  </section>
</body>
</html>
