<?php
// Include the config file to connect to the database
require_once 'layouts/includes/config.php';

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = intval($_POST['id']);
    $customer_name = $_POST['customer_name'];
    $service_type = $_POST['service_type'];
    $address = $_POST['address'];
    $service_date = $_POST['service_date'];
    $next_service_date = $_POST['next_service_date'];
    $service_cost = $_POST['service_cost'];

    $sql = "UPDATE customers SET customer_name = ?, service_type = ?, address = ?, service_date = ?, next_service_date = ?, service_cost = ? WHERE id = ?";
    if($stmt = $conn->prepare($sql)){
        $stmt->bind_param("ssssssd", $customer_name, $service_type, $address, $service_date, $next_service_date, $service_cost, $id);
        if($stmt->execute()){
            header("location: index.php");
            exit();
        } else {
            echo "Error: Could not execute the update.";
        }
        $stmt->close();
    } else {
        echo "Error: Could not prepare the statement.";
    }
}

$conn->close();
?>