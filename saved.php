<?php
session_start(); // Start the session 
include 'products_db.php'; // Include the database connection file

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "<p>Please log in to view your saved cars.</p>";
    exit();
}

$user_id = $_SESSION['user_id'];

// Prepare SQL query to fetch saved cars with product details
$sql = "
    SELECT p.vin, p.make, p.model, p.year, p.mileage, p.price, p.description, p.image_path
    FROM saved_cars sc
    JOIN products p ON sc.vin = p.vin
    WHERE sc.user_id = ?
";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($vin, $make, $model, $year, $mileage, $price, $description, $image_path);

$hasResults = false;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Saved Cars</title>
    <link rel="stylesheet" href="saved_style.css">
</head>
<body>
    <h1>Your Saved Cars</h1> <!-- Title of the page -->
    <div class="back-link"> 
        <a href="profile.php" class="back-link">← Back to Profile</a> <!-- Link to go back to the profile -->
    </div>

    <div class="product-container">
        <?php
        // Loop through the fetched products and display them
        while ($stmt->fetch()):
            $hasResults = true;
        ?>
            <!-- Display the saved product -->
            <div class="product">
                <img src="<?php echo htmlspecialchars($image_path); ?>" alt="<?php echo htmlspecialchars($make . ' ' . $model); ?>">

                <div class="product-info">
                    <h2><?php echo htmlspecialchars("$make $model ($year)"); ?></h2>
                    <p><strong>VIN:</strong> <?php echo htmlspecialchars($vin); ?></p>
                    <p><strong>Mileage:</strong> <?php echo number_format((int)$mileage); ?> miles</p>
                    <p><strong>Price:</strong> $<?php echo number_format((float)$price, 2); ?></p>
                    <p><?php echo htmlspecialchars($description); ?></p>
                </div>
            </div>
        <?php
        endwhile;

        // If no saved cars are found, display a message
        if (!$hasResults) {
            echo "<p>No saved cars found.</p>";
        }

        // Close the prepared statement and the database connection
        $stmt->close();
        $conn->close();
        ?>
    </div>
</body>
</html>