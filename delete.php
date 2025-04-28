<?php
include_once __DIR__ .'/users.php';

session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
if (isset($_POST["id"])) 
{   
    $id = $_POST["id"];
    $success = User::delete($id);
    if ($success) {
        $_SESSION['message'] = "User deleted successfully";
    } else {
        $_SESSION['message'] = "Error deleting user";
    }
    header("Location: ./usersinfo.php");
    exit;
}
} else 
{
    $_SESSION['message'] = "User not found";
    header("Location: ./usersinfo.php");
    exit;
}