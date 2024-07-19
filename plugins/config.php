<?php
$servername = "srv1124.hstgr.io";
$username = "u632480160_acproject";
$password = "Acproject@2024";
$dbname = "u632480160_acproject";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
