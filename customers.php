<?php
require 'layouts/includes/config.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customerName = $_POST['customerName'];
    $serviceType = $_POST['serviceType'];
    $address = $_POST['address'];
    $serviceDate = $_POST['serviceDate'];
    $nextServiceDate = $_POST['nextServiceDate'];
    $serviceCost = $_POST['serviceCost'];

    // Insert data into the database
    $sql = "INSERT INTO customers (customer_name, service_type, address, service_date, next_service_date, service_cost) VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssd", $customerName, $serviceType, $address, $serviceDate, $nextServiceDate, $serviceCost);

    if ($stmt->execute()) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $stmt->close();
    $conn->close();

    // Redirect back to the main page (index.php)
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Customer</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container">
    <h2 class="mt-4">Add New Customer</h2>
    <form method="POST" action="customers.php">
        <div class="form-group">
            <label for="customerName">Customer Name</label>
            <input type="text" class="form-control" id="customerName" name="customerName" required>
        </div>
        <div class="form-group">
            <label for="serviceType">Service Type</label>
            <input type="text" class="form-control" id="serviceType" name="serviceType" required>
        </div>
        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" class="form-control" id="address" name="address" required>
        </div>
        <div class="form-group">
            <label for="serviceDate">Service Date</label>
            <input type="date" class="form-control" id="serviceDate" name="serviceDate" required>
        </div>
        <div class="form-group">
            <label for="nextServiceDate">Next Service Date</label>
            <input type="date" class="form-control" id="nextServiceDate" name="nextServiceDate" required>
        </div>
        <div class="form-group">
            <label for="serviceCost">Service Cost</label>
            <input type="number" class="form-control" id="serviceCost" name="serviceCost" required>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Submit</button>
    </form>
</div>

<!-- Include Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

</body>
</html>
