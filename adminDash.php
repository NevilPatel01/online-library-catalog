<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Catalog - Home</title>
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
                <h3>AdminDash</h3>
            </div>
            <div class="p-3 d-flex m-2 bg-primary justify-content-center">
                <a class="nav-link" href="manageAdmins.php">Admin</a>
            </div>
            <div class="p-3 d-flex m-2 bg-primary justify-content-center">
                <a class="nav-link" href="manageBooks.php">Add NewBook</a>
            </div>
            <div class="p-3 d-flex m-2 bg-primary justify-content-center">
                <a class="nav-link " href="manageUsers.php">Users</a>
            </div>
        </div>
        <div class="col-9 p-4 m-5 shadow ">
        <table class="table">
  <thead>
    <tr>
      <th scope="col">Book-Id</th>
      <th scope="col">Book-Name</th>
      
      <th scope="col">Action</th>
    </tr>
  </thead>
        <tbody>
        <!-- <?php foreach ($books as $book): ?> -->
          <tr>
            <th scope="row"></th>
            <td></td>
            
            <td>
                <a class="btn btn-sm btn-primary" href="#" role="button">Link</a>
                <a class="btn btn-sm btn-primary" href="#" role="button">Link</a>
                <a class="btn btn-sm btn-primary" href="#" role="button">Link</a>
            </td>
          </tr>
        <!-- <?php endforeach; ?> -->
        </tbody>
</table>
        </div>
    </div>

    <!-- Include Footer -->
    <?php include('adfooter.php'); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>