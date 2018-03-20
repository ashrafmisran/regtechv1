<?php
$servername = "localhost";
$username = "root";
$password = "";
$db = "compliance_review";

// Create connection
$conn = new mysqli($servername, $username, $password, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

?>