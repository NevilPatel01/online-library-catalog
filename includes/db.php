<?php
$host = 'localhost';
$db = 'library_catalog';
$user = 'root';
$pass = 'root';

// Create connection
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
