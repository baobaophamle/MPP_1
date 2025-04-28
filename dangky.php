<?php
ob_start();
session_start();
include_once __DIR__ . '/users.php';

if (isset($_POST['dangky'])) {
    $errors = validate($_POST, ["user", "email", "password"]);
    if (count($errors) <= 0) {
        $dataCreate = [
            "user" => $_POST['user'],
            "email" => $_POST['email'],
            'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
        ];

        $user = User::dangky($dataCreate);
        if($user){
             $_SESSION['message'] = "Đăng ký tài khoản thành công!  Hãy đăng nhập.";
             header("Location: ./dangnhap.php");
             exit;
        }
       
    }
} else {
    $errors = [];
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
        <div class="logo-container">  <img src="logo.png" height="80px" width="80px" alt="logo">
        </div>
        <div align="right">         
        <a href="dangnhap.php"><button id="signin-btn">Bắt Đầu Học Ngay!</button></a>
        </div>
    </header>

    <div class="centering-container">
        <div class="signup-box">
            <form method="post">
                <h2>Đăng ký và bắt đầu học ngay!</h2>
                <?php if (isset($errors) && count($errors) > 0) { ?>
                    <div class="alert alert-danger">
                        <?php foreach ($errors as $error) {
                            echo "<p>$error</p>";
                        } ?>
                    </div>
                <?php } ?>
                <div class="input-box">
                    <span class="icon"></span>
                    <label>Tên đăng nhập</label><br>
                    <input type="text" name="user" required>
                </div>
                <div class="input-box">
                    <span class="icon"></span>
                    <label>Email</label><br>
                    <input type="email" name="email" required>
                </div>
                <div class="input-box">
                    <span class="icon"></span>
                    <label>Mật khẩu</label><br>
                    <input type="password" name="password" required>
                </div>
                <div class="button-box"> <button type="submit" name="dangky" id="signup">Đăng ký</button>
                </div>
                <p>Đã có tài khoản? <a href="dangnhap.php">Đăng nhập</a></p>
        </div>
        </form>
    </div>
</body>