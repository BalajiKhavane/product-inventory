<?php
// ================================
// add.php — Add New Product (CREATE)
// ================================
include 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Get data from form
    $name     = trim($_POST['name']);
    $price    = trim($_POST['price']);
    $quantity = trim($_POST['quantity']);
    $category = trim($_POST['category']);

    // Save to database
    $stmt = $conn->prepare("INSERT INTO products (name, price, quantity, category) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sdis", $name, $price, $quantity, $category);

    if ($stmt->execute()) {
        header("Location: index.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
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

    <!-- Add Product Form -->
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-dark text-white">
                        Add New Product
                    </div>
                    <div class="card-body">
                        <form method="POST" action="add.php">

                            <div class="mb-3">
                                <label class="form-label">Product Name</label>
                                <input type="text" name="name" class="form-control" placeholder="e.g. Laptop" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Price (₹)</label>
                                <input type="number" name="price" class="form-control" placeholder="e.g. 999" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Quantity</label>
                                <input type="number" name="quantity" class="form-control" placeholder="e.g. 50" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Category</label>
                                <select name="category" class="form-select" required>
                                    <option value="">-- Select Category --</option>
                                    <option>Electronics</option>
                                    <option>Clothing</option>
                                    <option>Food</option>
                                    <option>Furniture</option>
                                    <option>Other</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-success w-100">Save Product</button>

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