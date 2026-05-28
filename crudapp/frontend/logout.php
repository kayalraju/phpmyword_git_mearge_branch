<?php
session_start();
require "config/db.php";

// Remove token from DB
if(isset($_SESSION['user_id'])){
    $stmt = $pdo->prepare("UPDATE users SET remember_token=NULL WHERE id=?");
    $stmt->execute([$_SESSION['user_id']]);
}

// Destroy session
session_destroy();

// Delete cookie
setcookie("remember_token", "", time() - 3600, "/");

header("Location: login.php");
exit;