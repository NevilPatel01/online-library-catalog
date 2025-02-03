<?php
include 'header.php';
// // Ensure this file includes the functions for DB interaction

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password']; // Directly store the password without hashing
    $confirmPassword = $_POST['confirm_password'];
    $role = $_POST['role']; // User or Admin role

    // Check if the passwords match
    if ($password !== $confirmPassword) {
        $error = "Passwords do not match.";
    } else {
        // Check if the username already exists
        if (checkUserExists($username)) {
            $error = "Username is already taken.";
        } else {
            // Register the user with the original password (without hashing)
            registerUser($username, $password, $role);
            echo "Registration successful!";
            header('Location: login.php'); // Redirect to login page after successful registration
            exit();
        }
    }
}
?>

<div class="container">
    <h2 class="mt-5">Register</h2>
    <?php if (isset($error)) { echo "<p class='text-danger'>$error</p>"; } ?>
    <form method="POST">
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" id="username" name="username" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" id="password" name="password" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="confirm_password" class="form-label">Confirm Password</label>
            <input type="password" id="confirm_password" name="confirm_password" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="role" class="form-label">Role</label>
            <select id="role" name="role" class="form-control">
                <option value="user">User</option>
                <option value="admin">Admin</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Register</button>
    </form>
</div>

<?php //include 'footer.php'; ?>
