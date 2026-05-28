<?php 
include "includes/header.php";
?>

<div class="container mt-4 w-50">
    <h3>Register</h3>

    <?php if(isset($_SESSION['error'])): ?>
        <div class="alert alert-danger"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
    <?php endif; ?>

    <form action="actions/register.php" method="POST">
        <input type="text" name="name" placeholder="Name" class="form-control mb-2" required>

        <input type="email" name="email" placeholder="Email" class="form-control mb-2" required>

        <input type="text" name="phone" placeholder="Phone" class="form-control mb-2" required>

        <input type="password" name="password" placeholder="Password" class="form-control mb-2" required>

        <button type="submit" class="btn btn-primary">Register</button>
    </form>

    <p class="mt-2">
        Already have an account? <a href="login.php">Login</a>
    </p>
</div>

<?php include "includes/footer.php"; ?>