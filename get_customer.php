<?php
// Include the config file to connect to the database
require_once 'layouts/includes/config.php';

if(isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "SELECT * FROM customers WHERE id = ?";
    if($stmt = $conn->prepare($sql)){
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows == 1) {
            echo json_encode($result->fetch_assoc());
        } else {
            echo json_encode(["error" => "Customer not found."]);
        }
        $stmt->close();
    }
}

$conn->close();
?>
