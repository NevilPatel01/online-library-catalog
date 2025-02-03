<?php
session_start();  // Start the session to access session variables

// Check if the user is logged in
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Catalog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.2/dist/tailwind.min.css" rel="stylesheet">
    <link href="assets/css/custom.css" rel="stylesheet">
    
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid bg-dark">
    <a class="navbar-brand m-4 text-light" href="http://localhost/LibraryCatalog/index.php"><h3>Library Catalog</h3></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse flex  text-light navbar-collapse" id="navbarNav">
      <a class="nav-link m-4 p-2  bg-primary" href="http://localhost/LibraryCatalog/index.php">View</a>
    </div>
  </div>
</nav>
