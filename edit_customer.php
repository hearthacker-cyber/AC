<?php
require 'layouts/includes/config.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customerId = $_POST['customerId'];
    $customerName = $_POST['customerName'];
    $phoneNumber = $_POST['phoneNumber'];
    $serviceType = $_POST['serviceType'];
    $otherServiceType = $_POST['otherServiceType'] ?? '';
    $address = $_POST['address'];
    $serviceDate = $_POST['serviceDate'];
    $serviceCost = $_POST['serviceCost'];

    if ($serviceType === 'Others') {
        $serviceType = $otherServiceType;
    }

    // Update data in the database
    $sql = "UPDATE customers SET customer_name=?, phone_number=?, service_type=?, address=?, service_date=?, service_cost=? WHERE id=?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssd", $customerName, $phoneNumber, $serviceType, $address, $serviceDate, $serviceCost, $customerId);

    if ($stmt->execute()) {
        echo "<script>alert('Record updated successfully'); window.location.href = './view_customers.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>