<?php
// Include the database connection
include('includes/db.php');

// Check if the book ID is passed via GET request
if (isset($_GET['id'])) {
    $book_id = (int) $_GET['id'];

    // Create PDO connection
    $pdo = getPDO();
    // Prepare and execute the delete statement
    $stmt = $pdo->prepare("DELETE FROM books WHERE id = ?");
    $stmt->execute([$book_id]);

    if ($stmt->rowCount() > 0) {
        header('Location: manageBooks.php'); // Redirect back to manageBooks page
        exit;
    } else {
        echo "Error deleting book!";
    }
} else {
    echo "Invalid request!";
}
?>
