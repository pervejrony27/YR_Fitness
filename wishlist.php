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

// Fetch wishlist items
$sql = "SELECT p.id, p.title, p.price, p.img FROM wishlist w 
        JOIN products p ON w.product_id = p.id 
        WHERE w.user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

// Fetch membership plans
$membership_sql = "SELECT id, plan, price FROM memberships WHERE user_id = ?";
$membership_stmt = $conn->prepare($membership_sql);
$membership_stmt->bind_param("i", $user_id);
$membership_stmt->execute();
$membership_result = $membership_stmt->get_result();

// Handle deletion
if (isset($_POST['delete_item_id'])) {
    $item_id = $_POST['delete_item_id'];
    $item_type = $_POST['item_type'];

    if ($item_type == 'wishlist') {
        // Delete from wishlist
        $delete_sql = "DELETE FROM wishlist WHERE product_id = ? AND user_id = ?";
        $delete_stmt = $conn->prepare($delete_sql);
        $delete_stmt->bind_param("ii", $item_id, $user_id);
        $delete_stmt->execute();
    } elseif ($item_type == 'membership') {
        // Delete from memberships
        $delete_sql = "DELETE FROM memberships WHERE id = ? AND user_id = ?";
        $delete_stmt = $conn->prepare($delete_sql);
        $delete_stmt->bind_param("ii", $item_id, $user_id);
        $delete_stmt->execute();
    }

    echo 'success';
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wishlist</title>
    <link rel="stylesheet" href="styles/dashboardstyle.css">
    <style>
        /* Your existing styles here */
    </style>
</head>
<body>
    <?php include 'sidebar.php'; ?>
    <main>
        <div class="checkout-container">
            <h2>Wishlist</h2>
            <form id="wishlist-form" action="checkout.php" method="POST">
                <div class="wishlist-container">
                    <?php if ($result->num_rows > 0): ?>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <div class="wishlist-item" id="wishlist-<?php echo $row['id']; ?>">
                                <input type="checkbox" class="wishlist-checkbox" name="selected_items[]" value="<?php echo $row['id']; ?>">
                                <img src="product_images/<?php echo htmlspecialchars($row['img']); ?>" alt="<?php echo htmlspecialchars($row['title']); ?>">
                                <h3><?php echo htmlspecialchars($row['title']); ?></h3>
                                <p>৳<?php echo number_format($row['price'], 2); ?></p>
                                <button class="delete-btn" data-id="<?php echo $row['id']; ?>" data-type="wishlist">Delete</button>
                            </div>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <p class="no-items-message">Your Wishlist is empty.</p>
                    <?php endif; ?>
                </div>

                <h2>Your Membership Plans</h2>
                <div class="wishlist-container">
                    <?php if ($membership_result->num_rows > 0): ?>
                        <?php while ($plan = $membership_result->fetch_assoc()): ?>
                            <div class="wishlist-item" id="membership-<?php echo $plan['id']; ?>">
                                <input type="checkbox" class="membership-checkbox" name="selected_memberships[]" value="<?php echo $plan['id']; ?>">
                                <h3><?php echo htmlspecialchars($plan['plan']); ?></h3>
                                <p>৳<?php echo number_format($plan['price'], 2); ?></p>
                                <button class="renew-btn" data-id="<?php echo $plan['id']; ?>">Renew</button>
                                <button class="delete-btn" data-id="<?php echo $plan['id']; ?>" data-type="membership">Delete</button>
                            </div>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <p class="no-items-message">No membership plans available for you.</p>
                    <?php endif; ?>
                </div>

                <button type="submit" class="proceed-payment-btn" id="proceed-payment-btn" style="display: none;">Proceed to Payment</button>
            </form>
        </div>
    </main>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Delete functionality using AJAX
            const deleteButtons = document.querySelectorAll('.delete-btn');

            deleteButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();

                    const itemId = this.getAttribute('data-id');
                    const itemType = this.getAttribute('data-type');

                    if (confirm('Are you sure you want to delete this item?')) {
                        // Send AJAX request
                        const xhr = new XMLHttpRequest();
                        xhr.open('POST', '', true);
                        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                        xhr.onload = function() {
                            if (xhr.status === 200) {
                                const response = xhr.responseText;
                                if (response === 'success') {
                                    // Remove the item from the DOM
                                    const itemElement = document.getElementById(itemType === 'wishlist' ? `wishlist-${itemId}` : `membership-${itemId}`);
                                    itemElement.remove();
                                } else {
                                    alert('Failed to delete item.');
                                }
                            }
                        };
                        xhr.send(`delete_item_id=${itemId}&item_type=${itemType}`);
                    }
                });
            });

            const paymentButton = document.getElementById("proceed-payment-btn");

            // Function to check if any item is selected
            function togglePaymentButton() {
                const selectedWishlistItems = document.querySelectorAll(".wishlist-checkbox:checked");
                const selectedMemberships = document.querySelectorAll(".membership-checkbox:checked");

                if (selectedWishlistItems.length > 0 || selectedMemberships.length > 0) {
                    paymentButton.style.display = "block";
                } else {
                    paymentButton.style.display = "none";
                }
            }

            // Add event listeners to wishlist and membership checkboxes
            document.querySelectorAll(".wishlist-checkbox").forEach(checkbox => {
                checkbox.addEventListener("change", togglePaymentButton);
            });

            document.querySelectorAll(".membership-checkbox").forEach(checkbox => {
                checkbox.addEventListener("change", togglePaymentButton);
            });

            // Initial check in case some items are already selected
            togglePaymentButton();
        });
    </script>
</body>
</html>
