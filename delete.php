<?php
// ================================
// delete.php — Delete Product (DELETE)
// ================================
include 'includes/db.php';

// Get product ID from URL
$id = (int)$_GET['id'];

// Delete from database
$stmt = $conn->prepare("DELETE FROM products WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

$conn->close();

// Redirect back to index
header("Location: index.php");
exit();
?>