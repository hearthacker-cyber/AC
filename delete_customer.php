<?php
require 'layouts/includes/config.php';

// Check if the customer ID is set in the request
if (isset($_GET['id'])) {
    $customerId = $_GET['id'];

    // Prepare and execute the delete query
    $sql = "DELETE FROM customers WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("d", $customerId);

    if ($stmt->execute()) {
        echo "<script>alert('Record deleted successfully'); window.location.href = './view_customers.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "No customer ID provided.";
}
?>