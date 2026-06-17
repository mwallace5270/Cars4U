<?php 
session_start();

$servername = "localhost";
$username = "root";
$password = "root"; // Default MAMP MySQL password
$dbname = "cars4u_registration";

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user_id = $_SESSION['user_id']; 
$sql = "SELECT first_name, last_name, email, mobile, zip FROM users WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id); // Bind the user ID to the query
$stmt->execute();
$stmt->bind_result($first_name, $last_name, $email, $mobile, $zip); // Bind the results to variables
$stmt->fetch(); // Fetch the data
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>My Profile - Cars4U</title>
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
      background-color: #f6fafd;
      color: #1d2d3e;
    }

    .container {
      display: flex;
      height: 100vh;
    }

    .sidebar {
      width: 250px;
      background-color: #0a2d4d;
      color: white;
      display: flex;
      flex-direction: column;
      align-items: center;
      padding: 40px 20px;
    }

    .sidebar h2 {
      margin-top: 40px;
      margin-bottom: 40px;
    }

    .sidebar a {
      color: #8fbfe0;
      text-decoration: none;
      margin: 15px 0;
      display: flex;
      align-items: center;
      font-weight: 500;
    }

    .sidebar a.active {
      color: #00b4ff;
    } 
    .back-link {
        position: absolute;
        top: 20px;
        left: 20px;
        text-decoration: none;
        color: #007BFF;
        font-size: 16px;
        font-weight: bold;
    }

    .back-link:hover {
      text-decoration: underline;
    }

    .main-content {
      flex: 1;
      padding: 40px 60px;
      background: white;
    }

    .main-content h1 {
      font-size: 26px;
      margin-bottom: 30px;
      border-bottom: 1px solid #ccc;
      padding-bottom: 10px;
    }

    .section {
      margin-bottom: 30px;
    }

    .section-title {
      font-weight: bold;
      font-size: 16px;
      margin-bottom: 10px;
    }

    .info-row {
      display: flex;
      justify-content: space-between;
      margin-bottom: 10px;
    }

    .info-label {
      color: #444;
      font-weight: 500;
    }

    .info-value {
      color: #666;
    }

    .edit-link {
      color: #00b4ff;
      text-decoration: none;
      font-size: 14px;
    }

    .delete-button {
      margin-top: 40px;
      background-color: #dc3545;
      color: white;
      border: none;
      padding: 12px 20px;
      border-radius: 5px;
      cursor: pointer;
    }

    .delete-button:hover {
      background-color: #c82333;
    }

  </style>
</head>

<body>
  <div class="container">
      <div class="sidebar"> 
          <a href="home.html" class="back-link">← Back to Homepage</a>
          <h2>Hello <?= htmlspecialchars($first_name) ?>!</h2>
          <a href="#" class="active">PERSONAL DETAILS</a>
          <a href="#">NOTIFICATIONS & SETTINGS</a> 
          <a href="saved.php">SAVED</a>
      </div>
      <div class="main-content">
        <h1>PERSONAL DETAILS</h1>
    
        <div class="section">
            <div class="section-title">PERSONAL INFORMATION</div>
            <div class="info-row">
                <div><span class="info-label">Name:</span> <?= htmlspecialchars($first_name . ' ' . $last_name) ?></div>
                <button class="edit-link" onclick="document.getElementById('nameForm').style.display='block'; return false;">Go by a different name?</button>
            </div>

            <!-- Hidden form to update name -->
            <form id="nameForm" action="update_name.php" method="POST" style="display: none; margin-top: 10px;">
                <input type="text" name="first_name" placeholder="New First Name" required>
                <input type="text" name="last_name" placeholder="New Last Name" required>
                <button type="submit">Save</button>
            </form>

            <div class="info-row">
                <div><span class="info-label">Email:</span> <?= htmlspecialchars($email) ?></div>
            </div>
            <div class="info-row">
                <div>
                    <span class="info-label">Phone:</span> 
                    <?php 
                    if ($mobile) {
                        echo htmlspecialchars($mobile);
                    } else {
                        echo '<a href="#" class="edit-link">Add Phone Number</a>';
                    }
                    ?>
                </div>
            </div>
        </div>
    
        <div class="section">
            <div class="section-title">DELIVERY ADDRESS</div>
            <div class="info-row">
                <div><span class="info-label">Zip:</span> <?= htmlspecialchars($zip) ?></div>
            </div>
        </div>
    
        <button class="delete-button" onclick="confirmDelete()">Delete Profile</button>
      </div>
    </div>
    
  <script>
    function confirmDelete() {
        if (confirm("Are you sure you want to delete your profile? This action cannot be undone.")) {
            window.location.href = "delete_profile.php";
        }
    }
  </script> 
</body>
</html>