<?php
    require_once("product.class.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Process form submission
        $productName = $_POST["productName"];
        $cateID = $_POST["cateID"];
        $price = $_POST["price"];
        $quantity = $_POST["quantity"];
        $description = $_POST["description"];

        // Image upload handling
        $targetDirectory = "images/";
        $targetFile = $targetDirectory . basename($_FILES["productImage"]["name"]);
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["productImage"]["tmp_name"]);
        if ($check !== false) {
            if (move_uploaded_file($_FILES["productImage"]["tmp_name"], $targetFile)) {
                // Create a new Product instance
                $newProduct = new Product($productName, $cateID, $price, $quantity, $description, $targetFile);

                // Save the product
                $result = $newProduct->save();

                if ($result) {
                    $message = "Product added successfully!";
                } else {
                    $error = "Failed to add product.";
                }
            } else {
                $error = "Sorry, there was an error uploading your file.";
            }
        } else {
            $error = "File is not an image.";
        }
    }
?>

<?php include_once("header.php"); ?>

<h2>Add New Product</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
    <label for="productName">Product Name:</label><br>
    <input type="text" id="productName" name="productName" required><br><br>

    <label for="cateID">Category ID:</label><br>
    <input type="text" id="cateID" name="cateID" required><br><br>

    <label for="price">Price:</label><br>
    <input type="number" id="price" name="price" min="0" step="0.01" required><br><br>

    <label for="quantity">Quantity:</label><br>
    <input type="number" id="quantity" name="quantity" min="0" required><br><br>

    <label for="description">Description:</label><br>
    <textarea id="description" name="description" required></textarea><br><br>

    <label for="productImage">Product Image:</label><br>
    <input type="file" id="productImage" name="productImage" accept="image/*" required><br><br>

    <input type="submit" value="Add Product">
</form>

<?php
    if (isset($message)) {
        echo "<p>$message</p>";
    }
    if (isset($error)) {
        echo "<p>$error</p>";
    }
?>

<?php include_once("footer.php"); ?>
