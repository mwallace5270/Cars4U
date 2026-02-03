<?php 
session_start();

$servername = "localhost"; 
$username = "root";
$password = "root"; // Default MAMP MySQL password
$dbname = "cars4u_registration";

// Create database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Prepare and execute SQL query
    $sql = "SELECT user_id, password FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    // Check if user exists
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $hashed_password);
        $stmt->fetch();

        // Verify password
        if (password_verify($password, $hashed_password)) {
            $_SESSION['user_id'] = $id;
            $_SESSION['user_email'] = $email;

            // Redirect on success
            header("Location: home.html");
            exit();
        } else {
            echo "Invalid credentials.";
        }
    } else {
        echo "No account found with that email.";
    }

    $stmt->close();
} else {
    echo "Please submit the form correctly.";
}

$conn->close();
?>
