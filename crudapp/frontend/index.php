<?php 
require "config/db.php";
include "includes/header.php";

// Search + Filter
$search = $_GET['search'] ?? '';
$status = $_GET['status'] ?? '';

$query = "SELECT * FROM employees WHERE deleted_at IS NULL";

$params = [];

if ($search) {
    $query .= " AND (name LIKE ? OR email LIKE ?)";
    $params[] = "%$search%";
    $params[] = "%$search%";
}

if ($status) {
    $query .= " AND status = ?";
    $params[] = $status;
}

$stmt = $pdo->prepare($query);
$stmt->execute($params);
$users = $stmt->fetchAll();
$index = 1;
?>
<div class="container mt-4 w-80">
<h3>All Employees</h3>

<a href="create.php" class="btn btn-primary mb-2">Add Employee</a>
<a href="recycle.php" class="btn btn-primary mb-2 mr-2">Recycle Bin</a>

<form method="GET" class="form-inline mb-3">
    <input type="text" name="search" placeholder="Search..." class="form-control mr-2">
    
    <select name="status" class="form-control mr-2">
        <option value="">All</option>
        <option value="active">Active</option>
        <option value="inactive">Inactive</option>
    </select>

    <button class="btn btn-info">Filter</button>
</form>

<table class="table table-bordered">
<tr>
    <th>ID</th><th>Name</th><th>Email</th><th>Status</th><th>Image</th><th>Hobbies</th><th>Gender</th><th>Action</th>
</tr>

<?php foreach($users as $u): ?>
<?php
$hobbiesArray = json_decode($u['hobbies'], true) ?? [];
?>
<tr>
    <td><?= $index++ ?></td>
    <td><?= htmlspecialchars($u['name']) ?></td>
    <td><?= htmlspecialchars($u['email']) ?></td>
    <td><?= htmlspecialchars($u['status']) ?></td>

    <td>
        <?php if(!empty($u['image'])): ?>
            <img src="uploads/<?= htmlspecialchars($u['image']) ?>" height="100" width="100">
        <?php else: ?>
            No Image
        <?php endif; ?>
    </td>

    <td><?= htmlspecialchars(implode(", ", $hobbiesArray)) ?></td>
    <td><?= htmlspecialchars($u['gender']) ?></td>

    <td>
        <a href="edit.php?id=<?= $u['id'] ?>" class="btn btn-warning btn-sm">Edit</a>

        <a href="actions/delete.php?id=<?= $u['id'] ?>" 
           onclick="return confirm('Are you sure?')" 
           class="btn btn-danger btn-sm">Delete</a>

        <a href="view.php?id=<?= $u['id'] ?>" class="btn btn-info btn-sm">View</a>
    </td>
</tr>
<?php endforeach; ?>

</table>
</div>
<?php include "includes/footer.php"; ?>