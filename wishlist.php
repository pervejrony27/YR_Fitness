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

if (!isset($_SESSION['user_id'])) {
    die("Please login to view your wishlist.");
}

$user_id = $_SESSION['user_id'];
$sql = "SELECT p.id, p.title, p.price, p.img FROM wishlist w 
        JOIN products p ON w.product_id = p.id 
        WHERE w.user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wishlist</title>
    <link rel="stylesheet" href="styles/dashboardstyle.css">
    <script defer src="wishlist.js"></script> <!-- Include JavaScript file -->
    <style>
        /* Styling for Remove Button */
        .remove-wishlist-btn {
            background-color: #ff4c4c; /* Red background */
            color: white; /* White text */
            border: none;
            padding: 10px 20px;
            font-size: 14px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s, transform 0.2s ease;
        }

        .remove-wishlist-btn:hover {
            background-color: #e60000; /* Darker red on hover */
            transform: scale(1.1); /* Slight scale effect */
        }

        .remove-wishlist-btn:active {
            background-color: #cc0000; /* Even darker red when clicked */
        }

        /* Wishlist Item Card */
        .wishlist-item {
            border: 1px solid #ddd;
            padding: 15px;
            margin: 10px;
            width: calc(25% - 20px); /* Adjust width to ensure 4 cards in a row */
            text-align: center;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            box-sizing: border-box; /* Include padding and border in width calculation */
        }

        .wishlist-item img {
            width: 100%;
            height: auto;
            border-radius: 8px;
        }

        /* Flexbox container for wishlist items */
        .wishlist-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px; /* Space between cards */
            justify-content: space-around; /* Distribute items evenly */
        }

        .wishlist-container p {
            text-align: center;
            width: 100%;
        }

        /* Responsive adjustments for smaller screens */
        @media (max-width: 1200px) {
            .wishlist-item {
                width: calc(33.33% - 20px); /* 3 cards per row on medium screens */
            }
        }

        @media (max-width: 768px) {
            .wishlist-item {
                width: calc(50% - 20px); /* 2 cards per row on smaller screens */
            }
        }

        @media (max-width: 480px) {
            .wishlist-item {
                width: 100%; /* 1 card per row on extra small screens */
            }
        }
    </style>
</head>
<body>
    <?php include 'sidebar.php'; ?>
    <main>
        <h2>Wishlist</h2>
        <div class="wishlist-container">
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="wishlist-item" id="wishlist-item-<?php echo $row['id']; ?>">
                        <img src="product_images/<?php echo htmlspecialchars($row['img']); ?>" alt="<?php echo htmlspecialchars($row['title']); ?>">
                        <h3><?php echo htmlspecialchars($row['title']); ?></h3>
                        <p>৳<?php echo number_format($row['price'], 2); ?></p>
                        <button class="remove-wishlist-btn" data-product-id="<?php echo $row['id']; ?>">Remove</button>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>Your wishlist is empty.</p>
            <?php endif; ?>
        </div>
    </main>
</body>
</html>
