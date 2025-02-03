<?php
// Database connection settings
$host = 'localhost';
$db = 'library_catalog';
$user = 'root';
$pass = 'root';

// Create a new PDO instance
try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

// Check if the admin ID is passed
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch the admin data to populate the form
    try {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE id = :id AND role = 'admin'");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $admin = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error fetching admin data: " . $e->getMessage();
    }

    // Handle the form submission for editing
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $_POST['username'];
        $password = $_POST['password'];

        try {
            $stmt = $pdo->prepare("UPDATE users SET username = :username, password = :password WHERE id = :id");
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            header("Location: manageAdmins.php"); // Redirect back to the admin list
            exit();
        } catch (PDOException $e) {
            echo "Error updating admin: " . $e->getMessage();
        }
    }
} else {
    echo "Admin ID not provided.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include('adheader.php'); ?>

    <div class="container mt-5">
        <h2>Edit Admin</h2>
        <form method="POST">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" value="<?php echo htmlspecialchars($admin['username']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" value="<?php echo htmlspecialchars($admin['password']); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Save Changes</button>
        </form>
    </div>

    <?php include('adfooter.php'); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
