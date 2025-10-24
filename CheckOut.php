<?php
session_start();
include 'sslconfig.php';

$host = 'localhost';
$username = 'root';
$password = '';
$database = 'yr_fitness';

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (!isset($_SESSION['user_id'])) {
    die("Please login to proceed with the checkout.");
}

$selected_items = isset($_POST['selected_items']) ? $_POST['selected_items'] : [];
$selected_memberships = isset($_POST['selected_memberships']) ? $_POST['selected_memberships'] : [];

$total_price = 0;
$product_details = [];
$membership_details = [];

// Fetch selected products
if (!empty($selected_items)) {
    $placeholders = implode(',', array_fill(0, count($selected_items), '?'));
    $sql = "SELECT id, title, price, img FROM products WHERE id IN ($placeholders)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param(str_repeat('i', count($selected_items)), ...$selected_items);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $product_details[] = $row;
        $total_price += $row['price'];
    }
}

// Fetch selected memberships
if (!empty($selected_memberships)) {
    $placeholders = implode(',', array_fill(0, count($selected_memberships), '?'));
    $membership_sql = "SELECT id, plan, price FROM memberships WHERE id IN ($placeholders)";
    $membership_stmt = $conn->prepare($membership_sql);
    $membership_stmt->bind_param(str_repeat('i', count($selected_memberships)), ...$selected_memberships);
    $membership_stmt->execute();
    $membership_result = $membership_stmt->get_result();

    while ($membership = $membership_result->fetch_assoc()) {
        $membership_details[] = $membership;
        $total_price += $membership['price'];
    }
}
// Generate Unique Transaction ID
$tran_id = "YR_Fitness_" . uniqid();
$_SESSION['tran_id'] = $tran_id;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="styles/dashboardstyle.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: white;
            margin: 0;
            padding: 0;
        }

        .checkout-container {
            max-width: 800px;
            background: white;
            margin: 50px auto;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
        }

        .checkout-item {
            display: flex;
            align-items: center;
            background: #ffffff;
            padding: 12px;
            margin-bottom: 10px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .checkout-item img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 8px;
            margin-right: 15px;
        }

        .checkout-details {
            flex-grow: 1;
        }

        .checkout-details h4 {
            margin: 0;
            font-size: 18px;
            font-weight: bold;
        }

        .checkout-details p {
            margin: 5px 0 0;
            font-size: 16px;
            color: #27ae60;
            font-weight: bold;
        }

        .total-price {
            text-align: center;
            font-size: 22px;
            font-weight: bold;
            margin-top: 15px;
            padding: 10px;
            background: #ecf0f1;
            border-radius: 8px;
        }

        .confirm-payment-btn {
            display: block;
            width: 100%;
            background: #27ae60;
            color: white;
            border: none;
            padding: 12px;
            font-size: 18px;
            font-weight: bold;
            border-radius: 8px;
            margin-top: 20px;
            cursor: pointer;
            transition: 0.3s;
        }

        .confirm-payment-btn:hover {
            background: #218c53;
        }
    </style>
</head>
<body>
    <?php include 'sidebar.php'; ?>
    <main>
        <div class="checkout-container">
            <h2>Checkout</h2>

            <?php if (empty($product_details) && empty($membership_details)): ?>
                <p class="no-items-message">No items selected for payment.</p>
            <?php else: ?>
                
                <?php foreach ($product_details as $product): ?>
                    <div class="checkout-item">
                        <img src="product_images/<?php echo htmlspecialchars($product['img']); ?>" alt="<?php echo htmlspecialchars($product['title']); ?>">
                        <div class="checkout-details">
                            <h4><?php echo htmlspecialchars($product['title']); ?></h4>
                            <p>৳<?php echo number_format($product['price'], 2); ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>

                <?php foreach ($membership_details as $membership): ?>
                    <div class="checkout-item">
                        <div class="checkout-details">
                            <h4><?php echo htmlspecialchars($membership['plan']); ?></h4>
                            <p>৳<?php echo number_format($membership['price'], 2); ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>

                <div class="total-price">Total: ৳<?php echo number_format($total_price, 2); ?></div>
                
                <form action="checkout_process.php" method="POST">
    <input type="hidden" name="total_price" value="<?php echo $total_price; ?>">
    <input type="hidden" name="tran_id" value="<?php echo $tran_id; ?>">  <!-- Pass tran_id -->
    <button type="submit" class="confirm-payment-btn">Pay with SSLCOMMERZ</button>
</form>


            <?php endif; ?>
        </div>
    </main>
</body>
</html>
