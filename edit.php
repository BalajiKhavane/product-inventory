<?php
// ================================
// edit.php — Edit Product (UPDATE)
// ================================
include 'includes/db.php';

// Get product ID from URL
$id = (int)$_GET['id'];

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Get data from form
    $name     = trim($_POST['name']);
    $price    = trim($_POST['price']);
    $quantity = trim($_POST['quantity']);
    $category = trim($_POST['category']);

    // Update in database
    $stmt = $conn->prepare("UPDATE products SET name=?, price=?, quantity=?, category=? WHERE id=?");
    $stmt->bind_param("sdisi", $name, $price, $quantity, $category, $id);

    if ($stmt->execute()) {
        header("Location: index.php");
        exit();
    }
}

// Fetch existing product data to pre-fill form
$stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$product = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-dark bg-dark">
        <div class="container">
            <span class="navbar-brand">📦 Product Inventory</span>
            <a href="index.php" class="btn btn-secondary btn-sm">← Back</a>
        </div>
    </nav>

    <!-- Edit Product Form -->
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-warning text-dark">
                        Edit Product
                    </div>
                    <div class="card-body">
                        <form method="POST" action="edit.php?id=<?= $id ?>">

                            <div class="mb-3">
                                <label class="form-label">Product Name</label>
                                <input type="text" name="name" class="form-control"
                                       value="<?= htmlspecialchars($product['name']) ?>" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Price (₹)</label>
                                <input type="number" name="price" class="form-control"
                                       value="<?= $product['price'] ?>" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Quantity</label>
                                <input type="number" name="quantity" class="form-control"
                                       value="<?= $product['quantity'] ?>" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Category</label>
                                <select name="category" class="form-select" required>
                                    <option value="">-- Select Category --</option>
                                    <?php
                                    $categories = ['Electronics', 'Clothing', 'Food', 'Furniture', 'Other'];
                                    foreach ($categories as $cat) {
                                        $selected = ($product['category'] === $cat) ? 'selected' : '';
                                        echo "<option $selected>$cat</option>";
                                    }
                                    ?>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-warning w-100">Update Product</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php $conn->close(); ?>