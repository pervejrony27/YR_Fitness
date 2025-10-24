<?php
session_start();
include 'sslconfig.php';  // Contains store ID and secret key (for validation purposes)

if (!isset($_GET['tran_id']) || empty($_GET['tran_id'])) {
    die("Transaction ID is missing. Please try again.");
}
echo "Alhamdulillah <br>";
$tran_id = $_GET['tran_id'];  // Fetching transaction ID
echo "Payment Successful! Transaction ID: " . htmlspecialchars($tran_id);


// 1. Check the transaction status by making an API call to SSLCOMMERZ
$payment_data = array();
$payment_data['store_id'] = STORE_ID;
$payment_data['store_passwd'] = STORE_PASSWORD;
$payment_data['tran_id'] = $tran_id;  // Transaction ID

$direct_api_url = 'https://sandbox.sslcommerz.com/gwprocess/v4/transactionquery.php';  // API URL for transaction status

$handle = curl_init();
curl_setopt($handle, CURLOPT_URL, $direct_api_url);
curl_setopt($handle, CURLOPT_POST, true);
curl_setopt($handle, CURLOPT_POSTFIELDS, $payment_data);
curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($handle);
curl_close($handle);
$response = json_decode($response, true);

// 2. Process the response from SSLCOMMERZ
if (isset($response['status']) && $response['status'] == 'SUCCESS') {
    // Payment was successful
    echo "<h1>Payment Successful</h1>";
    echo "<p>Thank you for your payment! Your transaction ID is: " . htmlspecialchars($tran_id) . "</p>";

    // Save transaction details in the database
    $conn = new mysqli('localhost', 'root', '', 'yr_fitness');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
     // Display total price
     echo "<p>Total Price of Products: " . number_format($total_price, 2) . " BDT</p>";

     // Clear the user's cart after successful payment
     $delete_cart = $conn->prepare("DELETE FROM cart WHERE user_id = ?");
     $delete_cart->bind_param("i", $user_id);
     $delete_cart->execute();
 
     $stmt->close();
     $cart_query->close();
     $delete_cart->close();
     $conn->close();

    // Example: Assume $_SESSION['user_id'] stores the logged-in user's ID
    $user_id = $_SESSION['user_id'];  
    $amount_paid = $response['amount'];
    $payment_date = date('Y-m-d H:i:s');

    // Insert payment details into the database
    $stmt = $conn->prepare("INSERT INTO payments (user_id, tran_id, amount, payment_status, payment_date) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param('isdss', $user_id, $tran_id, $amount_paid, $response['status'], $payment_date);
    $stmt->execute();

}
?>
