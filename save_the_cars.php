<?php
session_start(); // Start the session

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "<p>You must be logged in to save cars.</p>";
    exit(); // User is not logged in, so stop further execution
}

$user_id = $_SESSION['user_id']; // Get the logged-in user's ID
$vin = $_POST['vin']; // Get the VIN of the car from the POST request

// Include the database connection
include 'products_db.php';

// Prepare an SQL query to insert the saved car into the saved_cars table
$stmt = $conn->prepare("INSERT INTO saved_cars (user_id, vin) VALUES (?, ?)");

// Bind the user_id and vin parameters to the SQL query
$stmt->bind_param("is", $user_id, $vin); // 'i' for integer (user_id), 's' for string (vin)

// Execute the query
if ($stmt->execute()) {
    // Redirect the user to a confirmation page or back to the product page
    header("Location: browse_cars.php?success=true");
} else {
    // If the insert failed, show an error
    echo "<p>Error saving the car. Please try again.</p>";
}

// Close the prepared statement and the database connection
$stmt->close();
$conn->close();
?>
