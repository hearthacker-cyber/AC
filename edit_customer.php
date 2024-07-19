<?php
require 'layouts/includes/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $customerId = $_POST['customerId'];
    $customerName = $_POST['customerName'];
    $phoneNumber = $_POST['phoneNumber'];
    $serviceType = $_POST['serviceType'] == 'Others' ? $_POST['otherServiceType'] : $_POST['serviceType'];
    $address = $_POST['address'];
    $serviceDate = $_POST['serviceDate'];
    $serviceCost = $_POST['serviceCost'];
    $paymentMode = $_POST['paymentMode'];
    $paymentId = $_POST['paymentId'];

    // Calculate the next service date as 1 year from the service date
    $nextServiceDate = date('Y-m-d', strtotime('+1 year', strtotime($serviceDate)));

    $sql = "UPDATE customers SET customer_name='$customerName', phone_number='$phoneNumber', service_type='$serviceType', address='$address', service_date='$serviceDate', next_service_date='$nextServiceDate', service_cost='$serviceCost', payment_mode='$paymentMode', payment_id='$paymentId' WHERE id='$customerId'";

    if ($conn->query($sql) === TRUE) {
        header('Location: ./view_customers.php');
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>