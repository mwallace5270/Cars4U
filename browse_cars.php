<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cars4U - Product Catalog</title>
    <link rel="stylesheet" href="product_style.css"> 
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <h1>Browse Cars</h1> 
    <div class="back-link"> 
        <a href="home.html" class="back-link">← Back to Homepage</a>
    </div>
    <div class="product-container">
        <?php include 'products.php'; ?>
    </div>    
</body>
</html>