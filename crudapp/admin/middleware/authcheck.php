<?php
session_start();

// If not logged in
if(!isset($_SESSION['user_id'])){
    $_SESSION['error'] = "You must be logged in to view this page";
    // Not authenticated → redirect
    header("Location: index.php");
    exit;
}