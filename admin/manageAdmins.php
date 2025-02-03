<?php
// No need for session_start() here since it's already included in adheader.php

// Database connection settings
$host = 'localhost';
$db = 'library_catalog';
$user = 'root';
$pass = 'root';

// Create a new PDO instance
try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

// Function to fetch admins from the database
$admins = [];
try {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE role = 'admin'");
    $stmt->execute();
    $admins = $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch all admin users
} catch (PDOException $e) {
    echo "Error fetching admins: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Catalog - Admins</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <!-- Include Header -->
    <?php include('adheader.php'); ?>

    <!-- Main Content Area -->
    <div class="d-flex ">
        <div class="col-2 m-1 text-light bg-dark " style="height: 800px;">
            <div class="d-flex m-5 justify-content-center ">
                <img class="lg-20" src="" alt="">
                <h3>Admin Dashboard</h3>
            </div>
            <div class="p-3 d-flex m-2 bg-primary justify-content-center">
                <a class="nav-link" href="manageAdmins.php">Admin</a> <!-- Ensure this links to the correct file -->
            </div>
            <div class="p-3 d-flex m-2 bg-primary justify-content-center">
                <a class="nav-link" href="manageBooks.php">Add New Book</a>
            </div>
            <div class="p-3 d-flex m-2 bg-primary justify-content-center">
                <a class="nav-link" href="manageUsers.php">Users</a>
            </div>
        </div>
        <div class="col-9 p-4 m-5 shadow ">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Admin</th>
                        <th scope="col">Password</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($admins as $admin): ?>
                        <tr>
                            <th scope="row"><?php echo $admin['username']; ?></th>
                            <td><?php echo $admin['password']; ?></td> <!-- Display password as plain text (not recommended for production) -->
                            <!-- <td>
                                <a class="btn btn-sm btn-primary" href="#" role="button">Edit</a>
                                <a class="btn btn-sm btn-danger" href="#" role="button">Delete</a>
                            </td> -->
                            <td>
    <a class="btn btn-sm btn-primary" href="editAdmin.php?id=<?php echo $admin['id']; ?>" role="button">Edit</a>
    <a class="btn btn-sm btn-warning" href="logout.php" role="button">Logout</a>

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
