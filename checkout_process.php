<?php
session_start();
include 'sslconfig.php';

if (!isset($_SESSION['user_id'])) {
    die("Please login to proceed with the checkout.");
}

// Get the total price from the form
$total_price = isset($_POST['total_price']) ? $_POST['total_price'] : 0;

// SSLCOMMERZ Payment Gateway details
$post_data = array();
$post_data['store_id'] = STORE_ID;
$post_data['store_passwd'] = STORE_PASSWORD;
$post_data['total_amount'] = $total_price;
$post_data['currency'] = "BDT";
$post_data['tran_id'] = "YR_Fitness_" . uniqid(); // Unique transaction ID
$post_data['success_url'] = "http://localhost/v4/paymentsuccess.php";
$post_data['fail_url'] = "http://localhost/v4/paymentfail.php";
$post_data['cancel_url'] = "http://localhost/v4/paymentcancel.php";
$post_data['cus_name'] = "pervej rony";  // Dynamic user name
$post_data['cus_email'] = "pervejrony@gmail.com";
$post_data['cus_phone'] = "01642157979";
$post_data['product_name'] = "Gym Membership";
$post_data['success_url'] = "http://localhost/v4/paymentsuccess.php?tran_id=" . $post_data['tran_id'];

$_SESSION['tran_id'] = $post_data['tran_id'];

// SSLCOMMERZ API URL
$direct_api_url = SSLCZ_PAY_API;

$handle = curl_init();
curl_setopt($handle, CURLOPT_URL, $direct_api_url);
curl_setopt($handle, CURLOPT_POST, true);
curl_setopt($handle, CURLOPT_POSTFIELDS, $post_data);
curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($handle);
curl_close($handle);

// Handle the response
$response = json_decode($response, true);

if (isset($response['GatewayPageURL']) && $response['GatewayPageURL'] != "") {
    header("Location: " . $response['GatewayPageURL']); // Redirect to SSLCOMMERZ payment page
    exit();
} else {
    echo "Failed to connect with SSLCOMMERZ!";
}

?>
