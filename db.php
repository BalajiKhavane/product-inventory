<?php
// ================================
// includes/db.php — DB Connection
// ================================

$host     = "localhost";   // MySQL is running on your computer
$username = "root";        // Default MySQL username
$password = "#mysql.123"; // Replace with your MySQL password
$database = "inventory_db";  // Database we created earlier

// Connect to MySQL
$conn = new mysqli($host, $username, $password, $database);

// Check if connection worked
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>