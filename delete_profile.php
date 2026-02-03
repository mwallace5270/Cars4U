<?php
session_start(); 

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    die("Unauthorized access.");
}

$user_id = $_SESSION['user_id'];

// Database connection
$servername = "localhost";
$username = "root";
$password = "root"; // Default MAMP MySQL password
$dbname = "cars4u_registration";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

// Prepare delete statement
$stmt = $conn->prepare("DELETE FROM users WHERE user_id = ?");
$stmt->bind_param("i", $user_id);

// Attempt to execute
if ($stmt->execute()) {
    // Delete session since user is deleted
    session_destroy();
    echo "<h1>Profile successfully deleted.</h1>";
    echo "<p>Thanks for using Cars4U!</p>";
    echo '<a href="index.html">Return to Home</a>';
} else {
    echo "Error deleting profile: Please try again later :( " . htmlspecialchars($stmt->error);
}

$stmt->close();
$conn->close();
?>
