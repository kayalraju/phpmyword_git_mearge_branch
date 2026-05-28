<?php
require "config/db.php";
include "includes/header.php";

$id = $_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM employees WHERE id=?");
$stmt->execute([$id]);
$user = $stmt->fetch();

$hobbiesArray = json_decode($user['hobbies'], true) ?? [];

?>
<div class="container mt-4 w-80">
    <h3>Edit User</h3>

    <form action="actions/update.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $user['id'] ?>">
        <input type="hidden" name="old_image" value="<?= $user['image'] ?>">

        <input type="text" name="name" value="<?= $user['name'] ?>" class="form-control mb-2">

        <input type="email" name="email" value="<?= $user['email'] ?>" class="form-control mb-2">

        <select name="status" class="form-control mb-2">
            <option value="active" <?= $user['status'] == 'active' ? 'selected' : '' ?>>Active</option>
            <option value="inactive" <?= $user['status'] == 'inactive' ? 'selected' : '' ?>>Inactive</option>
        </select>
        <h6>Hobbies</h6>

        <div class="form-check">
            <input type="checkbox" name="hobbies[]" class="form-check-input" value="Reading"
                <?= in_array('Reading', $hobbiesArray) ? 'checked' : '' ?>>
            <label class="form-check-label">Reading</label>
        </div>

        <div class="form-check">
            <input type="checkbox" name="hobbies[]" class="form-check-input" value="Writing"
                <?= in_array('Writing', $hobbiesArray) ? 'checked' : '' ?>>
            <label class="form-check-label">Writing</label>
        </div>

        <div class="form-check">
            <input type="checkbox" name="hobbies[]" class="form-check-input" value="Coding"
                <?= in_array('Coding', $hobbiesArray) ? 'checked' : '' ?>>
            <label class="form-check-label">Coding</label>
        </div>
        <h6>Gender</h6>
        <div class="form-check">
            <input type="radio" name="gender" class="form-check-input" value="Male"
                <?= $user['gender'] == 'Male' ? 'checked' : '' ?>>
            <label class="form-check-label">Male</label>
        </div>
        <div class="form-check">
            <input type="radio" name="gender" class="form-check-input" value="Female"
                <?= $user['gender'] == 'Female' ? 'checked' : '' ?>>
            <label class="form-check-label">Female</label>
        </div>
        <input type="file" name="image" class="form-control mb-2" required>
        <button class="btn btn-success">Update</button>
    </form>
</div>
<?php include "includes/footer.php"; ?>