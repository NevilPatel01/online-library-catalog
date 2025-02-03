<?php
// Database connection
$pdo = new PDO('mysql:host=localhost;dbname=library_catalog', 'root', 'root');

// Function to get all users from the database
function getUsers() {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM users");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch all users as an associative array
}

?>