<?php
session_start(); // Start the session to store login state

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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = password_hash(trim($_POST['password']), PASSWORD_DEFAULT);
    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $zip = trim($_POST['zip']);
    $mobile = trim($_POST['mobile']);

    // Basic email validation
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format.");
    }

    // Prepare and execute SQL statement
    $sql = "INSERT INTO users (email, password, first_name, last_name, zip, mobile) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $email, $password, $first_name, $last_name, $zip, $mobile);

    if ($stmt->execute()) {
        // Store user session data (you can retrieve the inserted ID if needed)
        $_SESSION['user_email'] = $email;
        $_SESSION['user_id'] = $stmt->insert_id;

        // Redirect to home
        header("Location: home.html");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>