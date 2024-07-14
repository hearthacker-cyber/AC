<?php
// Include the config file to connect to the database
require_once 'layouts/includes/config.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "DELETE FROM customers WHERE id = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            echo json_encode(["status" => "success"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Could not execute the delete statement."]);
        }
        $stmt->close();
    } else {
        echo json_encode(["status" => "error", "message" => "Could not prepare the delete statement."]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request."]);
}

$conn->close();
?>
