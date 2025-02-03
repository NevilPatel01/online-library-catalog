<?php
// Include database connection
include('includes/db.php');

// Query to fetch regular users (excluding admins)
$sql = "SELECT id, username, password FROM users WHERE role != 'admin'"; // Added 'id' for deletion and editing
$result = $conn->query($sql);

// Fetch the user data
$users = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $users[] = $row; // Store user data
    }
}

// Handle user deletion
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $delete_sql = "DELETE FROM users WHERE id = ?";
    $stmt = $conn->prepare($delete_sql);
    $stmt->bind_param("i", $delete_id);
    $stmt->execute();
    $stmt->close();
    header("Location: manageUsers.php"); // Redirect to refresh the page
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Catalog - Users</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <!-- Include Header -->
    <?php include('adheader.php'); ?>

    <!-- Main Content Area -->
    <div class="d-flex">
        <div class="col-2 m-1 text-light bg-dark" style="height: 800px;">
            <div class="d-flex m-5 justify-content-center">
                <h3>Users Dashboard</h3>
            </div>
            <div class="p-3 d-flex m-2 bg-primary justify-content-center">
                <a class="nav-link" href="manageAdmins.php">Admin</a>
            </div>
            <div class="p-3 d-flex m-2 bg-primary justify-content-center">
                <a class="nav-link" href="manageBooks.php">Add New Book</a>
            </div>
            <div class="p-3 d-flex m-2 bg-primary justify-content-center">
                <a class="nav-link" href="manageUsers.php">Users</a>
            </div>
        </div>

        <div class="col-9 p-4 m-5 shadow">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Username</th>
                        <th scope="col">Password</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <th scope="row"><?php echo $user['username']; ?></th>
                            <td><?php echo $user['password']; ?></td>
                            <td>
                                <a class="btn btn-sm btn-primary" href="editUser.php?id=<?php echo $user['id']; ?>" role="button">Edit</a>
                                <a class="btn btn-sm btn-danger" href="manageUsers.php?delete_id=<?php echo $user['id']; ?>" role="button" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Include Footer -->
    <?php include('adfooter.php'); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
