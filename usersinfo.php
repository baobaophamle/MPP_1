<?php
    include_once __DIR__ .'/users.php';
    $users = User::all();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
</head>
<body>
    <div class="container"> <h1>User List</h1>
        <?php if (count($users) > 0) { ?> 
        <table class="table table-striped table-hover">
        <thead>
            <tr>
            <th scope="col">ID</th>
            <th scope="col">Username</th>
            <th scope="col">Email</th>
            <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user) { ?>  
            <tr>
            <th scope="row"><?= $user['id']?></th>
            <td><?= $user['user']?></td>
            <td><?= $user['email']?></td>
            <td>
                <a href="./show.php?id=<?= $user['id'] ?>" button type="button" class="btn btn-primary">Show</a>
                <a href="./edit.php?id=<?= $user['id'] ?>" button type="button" class="btn btn-info">Edit</a>
                <form action="./delete.php" method="post" id="formDelete-<?=$user["id"]?>">
                    <input type="hidden" name="id" value="<?=$user['id']?>">
                    <button type="button" class="btn btn-danger btn-delete">Delete</button>
                </form>
            </td>
            </tr>
            <?php } ?>
        </tbody>
        </table>
        <?php } else { ?>
            <h2>No Data.</h2>
        <?php } ?>
    </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
        <script>
       let deleteButtons = document.querySelectorAll('.btn-delete');
       deleteButtons.forEach(function (button) {
            button.addEventListener('click', function(event) {
                event.preventDefault();

                if (confirm("Delete user?")) {
                    let form = this.closest('form'); 
                    if (form) {
                        form.submit();
                    } else {
                        console.error("Error: Could not find the delete form!");
                    }
                }
            });
       });
    </script>       
</body>