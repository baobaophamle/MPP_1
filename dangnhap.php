<?php
ob_start();
session_start();
include_once __DIR__ . '/users.php';

if (isset($_POST['dangnhap'])) {
    $username = $_POST['user'];
    $password = $_POST['password'];

    $user = User::getUserByUsername($username);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['user'];
        header("Location: welcome.php");
        exit;
    } else {
        $error_message = "Tên đăng nhập hoặc mật khẩu không đúng.";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="signup.css">
</head>
<body>
    <header>
        <div class="logo-container">  <img href="index.php" src="logo.png" height="80px" width="80px" alt="logo">
        </div>
        <div align="right">         
        <a href="dangnhap.php"><button id="signin-btn">Bắt Đầu Học Ngay!</button></a>
        </div>
    </header>

     <div class="centering-container">  
        <div class="signup-box">
            <?php

            ?>
                <form method="post">
                    <h2>Đăng nhập và bắt đầu học ngay!</h2>
                    <?php if (isset($_SESSION['message'])) { ?>
                    <div class="alert alert-success"><?php echo $_SESSION['message']; ?></div>
                    <?php unset($_SESSION['message']);?>
                    <?php } ?>
                    <?php if (isset($error_message)) { ?>
                    <div class="alert alert-danger"><?php echo $error_message; ?></div>
                    <?php } ?>
                    <div class="input-box">
                        <span class="icon"></span>
                        <label>Tên đăng nhập</label><br>
                        <input type="text" name="user" required>
                    </div>
                    <div class="input-box">
                        <span class="icon"></span>
                        <label>Mật khẩu</label><br>
                        <input type="password" name="password" required>
                    </div>
                    <div class="button-box">  <button type="submit" name="dangnhap" id="signup">Đăng nhập</button>
                    <p>Chưa có tài khoản? <a href="dangky.php">Đăng ký</a></p> </form>
                    </div>
                </form>
        </div>
    </div>
</body>