<?php
// Initialize error message variable
$error_message = '';

// Include database connection
include('includes/db.php');

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the form data
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];  // Role selected by the user

    // Prepare SQL query to check user in the database based on username and role
    $sql = "SELECT * FROM users WHERE username = :username AND role = :role";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':role', $role);
    $stmt->execute();

    // Check if a matching user was found
    if ($stmt->rowCount() > 0) {
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Directly compare the plain text password
        if ($password === $user['password']) {
            // Correct password, log the user in and store user details in session
            session_start();  // Start the session to store user info
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];

            // Redirect user to the home page or admin dashboard
            if ($_SESSION['role'] == 'admin') {
                header('Location: /LibraryCatalog/admin/manageAdmins.php');
                exit();  // Ensure that no further code is executed after header
            } else {
                header('Location: index.php');  // Redirect to home page for user
                exit();  // Ensure that no further code is executed after header
            }
        } else {
            // Incorrect password
            $error_message = 'Invalid password.';
        }
    } else {
        // No user found with the provided username and role
        $error_message = 'Invalid username or role.';
    }
    
    $stmt->closeCursor();  // Close the PDO cursor
    $pdo = null;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2 class="mt-5">Login</h2>

        <?php if (!empty($error_message)): ?>
            <div class="alert alert-danger"><?php echo $error_message; ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="mb-3">
                <label for="role" class="form-label">Role</label>
                <select class="form-control" id="role" name="role" required>
                    <option value="admin">Admin</option>
                    <option value="user">User</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>
</body>
</html>
