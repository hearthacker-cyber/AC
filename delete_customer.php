<?php
require 'layouts/includes/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    $customerId = $_GET['id']; // Assuming you're passing id as a query parameter

    $sql = "DELETE FROM customers WHERE id = '$customerId'";

    if ($conn->query($sql) === TRUE) {
        echo "success";
    } else {
        echo "error";
    }

    $conn->close();
}
?>
