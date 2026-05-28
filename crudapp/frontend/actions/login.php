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

if($user && password_verify($password, $user['password'])){

    session_regenerate_id(true);

    $_SESSION['user_id'] = $user['id'];
    $_SESSION['user_name'] = $user['name'];

    if($remember){

        setcookie("remember_email", $email, time()+604800, "/");

        $token = bin2hex(random_bytes(32));
        $hashedToken = password_hash($token, PASSWORD_DEFAULT);

        $stmt = $pdo->prepare("UPDATE users SET remember_token=? WHERE id=?");
        $stmt->execute([$hashedToken, $user['id']]);

        setcookie(
            "remember_token",
            $token,
            time()+604800, //7 days
            "/",            //site-wide
            "",           //domain
            isset($_SERVER['HTTPS']), //secure connection
            true                //http only not accessible from JS
        );

    } else {
        setcookie("remember_email", "", time()-3600, "/");
        setcookie("remember_token", "", time()-3600, "/");
    }

    header("Location: ../dashboard.php");
    exit;

}else{
    $_SESSION['error'] = "Invalid email or password";
    header("Location: ../login.php");
    exit;
}