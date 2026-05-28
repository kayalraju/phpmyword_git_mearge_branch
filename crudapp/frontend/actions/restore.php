<?php

require "../config/db.php";

$id = $_GET['id'];

$stmt = $pdo->prepare("UPDATE employees SET deleted_at = NULL WHERE id=?");
$stmt->execute([$id]);

header("Location: ../recycle.php");




?>