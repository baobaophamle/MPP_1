<?php
    include_once __DIR__ .'/users.php';
    $limit = 5; // Số lượng người dùng trên mỗi trang
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $offset = ($page - 1) * $limit;

    $search = isset($_GET['search']) ? $_GET['search'] : "";

    $users = User::all($search, $limit, $offset);
    $totalUsers = User::countAll($search);
    $totalPages = ceil($totalUsers / $limit);
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
    <div class="container"> <h1 style="display: flex; justify-content: center;">User List</h1>
        <form method="get" class="mb-3" style="display: flex; align-items: center;">
            <input type="text" name="search" class="form-control" placeholder="Search by name" value="<?php echo htmlspecialchars($search); ?>" style="flex-grow: 1; flex-basis: 300px; margin-right: 10px;">
            <button type="submit" class="btn btn-primary mt-2" style="margin-left: 20px; margin-top: 0;">Search</button>
        </form>
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
            <?php } ?> <?php if (count($users) > 0): ?>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($user['id']); ?></td>
                            <td><?php echo htmlspecialchars($user['user']); ?></td>
                            <td><?php echo htmlspecialchars($user['email']); ?></td>
                            <td>
                                <div style="display: flex; gap: 5px;">
                                    <a href="showuser.php?id=<?php echo htmlspecialchars($user['id']); ?>" class="btn btn-info btn-sm">Show</a>
                                    <a href="edituser.php?id=<?php echo htmlspecialchars($user['id']); ?>" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="./delete.php" method="post" style="margin-bottom: 0;">
                                        <input type="hidden" name="id" value="<?=$user['id']?>">
                                        <button type="submit" class="btn btn-danger btn-sm btn-delete">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="5">No users found.</td></tr>
                <?php endif; ?>
        </tbody>
        </table>
        <nav aria-label="Page navigation" style="display: flex; justify-content: center;">
            <ul class="pagination">
                <li class="page-item <?php if ($page <= 1) { echo 'disabled'; } ?>">
                    <a class="page-link" href="?page=1&search=<?php echo htmlspecialchars($search); ?>">First</a>
                </li>
                <li class="page-item <?php if ($page <= 1) { echo 'disabled'; } ?>">
                    <a class="page-link" href="?page=<?php echo $page - 1; ?>&search=<?php echo htmlspecialchars($search); ?>">Previous</a>
                </li>
                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <li class="page-item <?php if ($page == $i) { echo 'active'; } ?>">
                        <a class="page-link" href="?page=<?php echo $i; ?>&search=<?php echo htmlspecialchars($search); ?>"><?php echo $i; ?></a>
                    </li>
                <?php endfor; ?>
                <li class="page-item <?php if ($page >= $totalPages) { echo 'disabled'; } ?>">
                    <a class="page-link" href="?page=<?php echo $page + 1; ?>&search=<?php echo htmlspecialchars($search); ?>">Next</a>
                </li>
                <li class="page-item <?php if ($page >= $totalPages) { echo 'disabled'; } ?>">
                    <a class="page-link" href="?page=<?php echo $totalPages; ?>&search=<?php echo htmlspecialchars($search); ?>">Last</a>
                </li>
            </ul>
        </nav>
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