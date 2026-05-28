<?php
require "config/db.php";
include "includes/header.php";

$id = $_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM employees WHERE id=?");
$stmt->execute([$id]);
$user = $stmt->fetch();
?>

<h3>Single Employee</h3>

<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Name: <?= $user['name'] ?></h5>
                    <p class="card-text">Email: <?= $user['email'] ?></p>
                    <p class="card-text">Status: <?= $user['status'] ?></p>
                </div>
            </div>
        </div>
    </div>
</div>



<?php include "includes/footer.php"; ?>