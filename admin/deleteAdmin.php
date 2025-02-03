<?php
// Database connection settings
$host = 'localhost';
$db = 'library_catalog';
$user = 'root';
$pass = 'root';

// Create a new PDO instance
try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

// Check if the admin ID is passed
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Delete the admin record
    try {
        $stmt = $pdo->prepare("DELETE FROM users WHERE id = :id AND role = 'admin'");
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        header("Location: manageAdmins.php"); // Redirect back to the admin list
        exit();
    } catch (PDOException $e) {
        echo "Error deleting admin: " . $e->getMessage();
    }
} else {
    echo "Admin ID not provided.";
    exit();
}
