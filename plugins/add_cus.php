<?php
// Include database configuration
include 'config.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customerName = $_POST['customerName'];
    $phoneNumber = $_POST['phoneNumber'];
    $serviceType = $_POST['serviceType'];
    $otherServiceType = isset($_POST['otherServiceType']) ? $_POST['otherServiceType'] : null;
    $address = $_POST['address'];
    $serviceDate = $_POST['serviceDate'];
    $serviceCost = $_POST['serviceCost'];
    $paymentMode = $_POST['paymentMode'];
    $paymentId = isset($_POST['paymentId']) ? $_POST['paymentId'] : null;

    // Default `next_service_date` to a placeholder if it's not provided
    $nextServiceDate = 'N/A'; // You can modify this according to your needs

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO customers (customer_name, phone_number, service_type, address, service_date, next_service_date, service_cost, payment_id, payment_mode) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssss", $customerName, $phoneNumber, $serviceType, $address, $serviceDate, $nextServiceDate, $serviceCost, $paymentId, $paymentMode);

    // Execute the statement
    if ($stmt->execute()) {
        header("Location: index.php");
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>
