// functions.php

<?php
// Database connection
 $pdo = new PDO('mysql:host=localhost;dbname=library_catalog', 'root', 'root');

// Function to check if a username already exists in the database
function checkUserExists($username) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE username = ?");
    $stmt->execute([$username]);
    return $stmt->fetchColumn() > 0; // Returns true if username exists, false otherwise
}

// Function to register a new user in the database (storing password in plain text)
function registerUser($username, $password, $role) {
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
    $stmt->execute([$username, $password, $role]); // Insert the new user with the plain password
}

// Function to fetch a user by username (for login verification)
function getUserByUsername($username) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    return $stmt->fetch(PDO::FETCH_ASSOC); // Return the user data as an associative array
}

?>
