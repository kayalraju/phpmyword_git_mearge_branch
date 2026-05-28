<?php
session_start();
require "../config/db.php";

$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';
$remember = isset($_POST['remember']);

if(empty($email) || empty($password)){
    $_SESSION['error'] = "Email and password required";
    header("Location: ../login.php");
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM users WHERE email=?");
$stmt->execute([$email]);
$user = $stmt->fetch();

if($user && $user['role']=='admin' && password_verify($password, $user['password'])){

    session_regenerate_id(true);

    $_SESSION['user_id'] = $user['id'];
    $_SESSION['user_name'] = $user['name'];

    header("Location: ../dashboard.php");
    exit;

}else{
    $_SESSION['error'] = "Invalid email or password";
    header("Location: ../index.php");
    exit;
}