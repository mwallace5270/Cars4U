<?php
session_start();
include 'products_db.php'; // or your DB connection file

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_first = trim($_POST['first_name']);
    $new_last = trim($_POST['last_name']);
    $user_id = $_SESSION['user_id'];

    // Optional: Basic validation
    if (empty($new_first) || empty($new_last)) {
        die("Please fill in both fields.");
    }

    // Prepare and execute the update statement
    $stmt = $conn->prepare("UPDATE users SET first_name = ?, last_name = ? WHERE user_id = ?");
    $stmt->bind_param("ssi", $new_first, $new_last, $user_id);

    if ($stmt->execute()) {
        // Optional: Flash message or feedback
        header("Location: profile.php"); // redirect back to the profile page
        exit();
    } else {
        echo "Error updating name.";
    }

    $stmt->close();
    $conn->close();
}
?>
