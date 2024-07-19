<?php

require 'layouts/includes/config.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customerName = $_POST['customerName'];
    $phoneNumber = $_POST['phoneNumber'];
    $serviceType = $_POST['serviceType'];
    if ($serviceType == 'Others') {
        $serviceType = $_POST['otherServiceType'];
    }
    $address = $_POST['address'];
    $serviceDate = $_POST['serviceDate'];
    $serviceCost = $_POST['serviceCost'];
    $paymentMode = $_POST['paymentMode'];

    // Generate a 12-digit payment ID starting with #
    $paymentId = '#' . strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 12));

    // Calculate next service date (6 months from the current service date)
    $nextServiceDate = date('Y-m-d', strtotime("+6 months", strtotime($serviceDate)));

    // Sanitize input data to prevent SQL injection
    $customerName = $conn->real_escape_string($customerName);
    $phoneNumber = $conn->real_escape_string($phoneNumber);
    $serviceType = $conn->real_escape_string($serviceType);
    $address = $conn->real_escape_string($address);
    $serviceDate = $conn->real_escape_string($serviceDate);
    $nextServiceDate = $conn->real_escape_string($nextServiceDate);
    $serviceCost = $conn->real_escape_string($serviceCost);
    $paymentId = $conn->real_escape_string($paymentId);
    $paymentMode = $conn->real_escape_string($paymentMode);

    // Construct the SQL query
    $sql = "INSERT INTO customers (customer_name, phone_number, service_type, address, service_date, next_service_date, service_cost, payment_id, payment_mode) 
            VALUES ('$customerName', '$phoneNumber', '$serviceType', '$address', '$serviceDate', '$nextServiceDate', '$serviceCost', '$paymentId', '$paymentMode')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . htmlspecialchars($conn->error);
    }

    $conn->close();

    // Redirect back to the main page (index.php)
    header("Location: index.php");
    exit();
}

?>