<?php
include_once __DIR__ .'/users.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: ./usersinfo.php");
    exit;
}

$id = $_GET['id'];
$user = User::find( $id );

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Show</title>
  </head>
  <body>
    <div class="container">
      <div>
        <h1>User Details</h1>
        <?php if ($user) { ?>
          <div class="card mt-3">
            <div class="card-body">
              <h3>Name: <?= htmlspecialchars($user['user']) ?></h3>
              <h3>Email: <?= htmlspecialchars($user['email']) ?></h3>
            </div>
          </div>
        <?php } else { ?>
          <div class="alert alert-danger mt-3">User not found</div>
        <?php } ?>
        <a href="./usersinfo.php" class="btn btn-primary mt-3">Back to List</a>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>