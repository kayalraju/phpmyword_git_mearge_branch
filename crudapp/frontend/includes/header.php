<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>CRUD App</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>
<body>

<div class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">CRUD App</a>

        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ml-auto">

                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>

                <?php if(isset($_SESSION['user_id'])): ?>
                    <!-- Logged In -->
                    <li class="nav-item">
                        <span class="nav-link">
                            Welcome, <?= htmlspecialchars($_SESSION['user_name']) ?>
                        </span>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="dashboard.php">Dahboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>

                <?php else: ?>
                    <!-- Not Logged In -->
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Login</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="register.php">Register</a>
                    </li>
                <?php endif; ?>

            </ul>
        </div>
    </nav>
</div>