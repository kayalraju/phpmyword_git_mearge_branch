<?php
require "config/db.php";

include "includes/header.php";

if(isset($_SESSION['user_id'])){
    header("Location: index.php");
    exit;
}

// Auto login
if(isset($_COOKIE['remember_token'])){

    $token = $_COOKIE['remember_token'];

    $stmt = $pdo->query("SELECT * FROM users WHERE remember_token IS NOT NULL");
    $users = $stmt->fetchAll();

    foreach($users as $user){
        if(password_verify($token, $user['remember_token'])){
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];

            header("Location: index.php");
            exit;
        }
    }
}

$email = $_COOKIE['remember_email'] ?? '';
?>

<div class="container mt-4 w-50">
    <h3>Login</h3>

    <?php if(isset($_SESSION['error'])): ?>
        <div class="alert alert-danger">
            <?= $_SESSION['error']; unset($_SESSION['error']); ?>
        </div>
    <?php endif; ?>

    <?php if(isset($_SESSION['success'])): ?>
        <div class="alert alert-success">
            <?= $_SESSION['success']; unset($_SESSION['success']); ?>
        </div>
    <?php endif; ?>

    <form action="actions/login.php" method="POST">
        <input type="email" name="email" placeholder="Email" class="form-control mb-2"  value="<?= htmlspecialchars($email) ?>" required>

        <input type="password" name="password" placeholder="Password" value="" class="form-control mb-2" required>

        <!-- Remember Me -->
        <div class="form-check mb-2">
          <input type="checkbox" name="remember" class="form-check-input"
            <?= isset($_COOKIE['remember_email']) ? 'checked' : '' ?>>
            <label class="form-check-label">Remember Me</label>
        </div>

        <button type="submit" class="btn btn-primary">Login</button>
    </form>

    <p class="mt-2">
        Don't have an account? <a href="register.php">Create one</a>
    </p>
</div>

<?php include "includes/footer.php"; ?>