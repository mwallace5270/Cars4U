<?php 
session_start(); // Start the session 
include 'products_db.php'; //Including the database connection file 

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "<p>You must be logged in to save cars.</p>";
    exit();
}

$user_id = $_SESSION['user_id']; // Get the logged-in user's ID

// Prepare the SQL query to select product details
$stmt = $conn->prepare("SELECT vin, make, model, year, mileage, price, description, image_path FROM products"); 
$stmt->execute(); // Execute the query

// Bind the results to PHP variables
$stmt->bind_result($vin, $make, $model, $year, $mileage, $price, $description, $image_path); 

$hasResults = false; // Flag to check if there are any results

// Loop through the fetched products and display them
while ($stmt->fetch()):
    $hasResults = true;  // Set the flag to true when a result is fetched
?>

    <!-- Display the product information -->
    <div class="product">
        <!-- Display the product image -->
        <img src="<?php echo htmlspecialchars($image_path); ?>" alt="<?php echo htmlspecialchars($make . ' ' . $model); ?>">

        <!-- Display the product details -->
        <div class="product-info">
            <h2><?php echo htmlspecialchars("$make $model ($year)"); ?></h2>
            <p><strong>VIN:</strong> <?php echo htmlspecialchars($vin); ?></p>
            <p><strong>Mileage:</strong> <?php echo number_format((int)$mileage); ?> miles</p>
            <p><strong>Price:</strong> $<?php echo number_format((float)$price, 2); ?></p>
            <p><?php echo htmlspecialchars($description); ?></p>

            <!-- Save Button-->
            <form method="POST" action="save_the_cars.php">
                <input type="hidden" name="vin" value="<?php echo htmlspecialchars($vin); ?>">
                <button type="submit" class="save-button">
                    <i class="fas fa-bookmark"></i> Save
                </button>
            </form>
        </div>
    </div>

<?php
endwhile;

// If no products were found, display a message
if (!$hasResults) {
    echo "<p>No cars for sale found.</p>";
}

// Close the prepared statement and the database connection
$stmt->close();
$conn->close();
?>
