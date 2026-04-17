<?php
// Database configuration
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "digital_sehat_ghar";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>