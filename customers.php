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

    // Calculate next service date (6 months from the current service date)
    $nextServiceDate = date('Y-m-d', strtotime("+6 months", strtotime($serviceDate)));

    // Insert data into the database
    $sql = "INSERT INTO customers (customer_name, phone_number, service_type, address, service_date, next_service_date, service_cost) VALUES (?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($conn->error));
    }

    $stmt->bind_param("ssssssd", $customerName, $phoneNumber, $serviceType, $address, $serviceDate, $nextServiceDate, $serviceCost);

    if ($stmt->execute()) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . htmlspecialchars($conn->error);
    }

    $stmt->close();
    $conn->close();

    // Redirect back to the main page (index.php)
    header("Location: index.php");
    exit();
}



?>