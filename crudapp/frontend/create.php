<?php include "includes/header.php"; ?>


<div class="container mt-4 w-80">
    <h3>Add User</h3>
    <form action="actions/insert.php" method="POST" enctype="multipart/form-data">
        <input type="text" name="name" class="form-control mb-2" placeholder="Name" required>
        <input type="email" name="email" class="form-control mb-2" placeholder="Email" required>

        <select name="status" class="form-control mb-2">
            <option value="active">Active</option>
            <option value="inactive">Inactive</option>
        </select>
        <h6>Hobbies</h6>
        <div class="form-check">
            <input type="checkbox" name="hobbies[]" class="form-check-input" value="Reading">
            <label class="form-check-label">Reading</label>
        </div>
        <div class="form-check">
            <input type="checkbox" name="hobbies[]" class="form-check-input" value="Writing">
            <label class="form-check-label">Writing</label>
        </div>
        <div class="form-check">
            <input type="checkbox" name="hobbies[]" class="form-check-input" value="Coding">
            <label class="form-check-label">Coding</label>
        </div>
        <h6>Gender</h6>
        <div class="form-check">
            <input type="radio" name="gender" class="form-check-input" value="Male">
            <label class="form-check-label">Male</label>
        </div>
        <div class="form-check">
            <input type="radio" name="gender" class="form-check-input" value="Female">
            <label class="form-check-label">Female</label>
        </div>

        <input type="file" name="image" class="form-control mb-2" required>

        <button class="btn btn-success">Save</button>
    </form>
</div>
<?php include "includes/footer.php"; ?>