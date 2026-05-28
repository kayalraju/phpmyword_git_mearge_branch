<?php
// session_start();

// If not logged in
if(!isset($_SESSION['user_id'])){

    // Optional: check remember_token (auto login)
    if(isset($_COOKIE['remember_token'])){
        require __DIR__ . "/../config/db.php";

        $token = $_COOKIE['remember_token'];

        $stmt = $pdo->query("SELECT * FROM users WHERE remember_token IS NOT NULL");
        $users = $stmt->fetchAll();

        foreach($users as $user){
            if(password_verify($token, $user['remember_token'])){
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['name'];
                return; // allow access
            }
        }
    }

    $_SESSION['error'] = "You must be logged in to view this page";
    // Not authenticated → redirect
    header("Location: login.php");
    exit;
}