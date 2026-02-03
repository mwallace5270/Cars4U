<?php
$servername = "localhost";
$username = "root";
$password = "root"; // Default MAMP MySQL password
$dbname = "cars4u_registration";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
?>