<?php

// Database connection
function getPDO() {
    $host = 'localhost';
    $db = 'library_catalog';
    $user = 'root';
    $pass = 'root'; 
    $charset = 'utf8mb4';

    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    try {
        return new PDO($dsn, $user, $pass, $options);
    } catch (\PDOException $e) {
        throw new \PDOException($e->getMessage(), (int)$e->getCode());
    }
}

// Function to check if a user is logged in
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

// Function to get all books from the database
function getAllBooks() {
    $pdo = getPDO();
    $stmt = $pdo->query("SELECT * FROM books");
    return $stmt->fetchAll();
}

// Function to check if a username already exists
function checkUserExists($username) {
    $pdo = getPDO();
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    return $stmt->fetch() !== false;
}

// Function to register a new user
function registerUser($username, $password, $role) {
    $pdo = getPDO();
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $pdo->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
    $stmt->execute([$username, $hashedPassword, $role]);
}

?>
