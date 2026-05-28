<?php 
require "config/db.php";
include "includes/header.php";

// Search + Filter
$search = $_GET['search'] ?? '';
$status = $_GET['status'] ?? '';

$query = "SELECT * FROM employees WHERE deleted_at IS NOT NULL";

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
?>

<div class="container mt-4 w-80">
<h3>All Deleted Employees</h3>

<a href="index.php" class="btn btn-info btn-sm">Home Page</a>

<form method="GET" class="form-inline mb-3 mt-3">
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
    <th>ID</th><th>Name</th><th>Email</th><th>Status</th><th>Image</th><th>Action</th>
</tr>

<?php foreach($users as $u): ?>
<tr>
    <td><?= $u['id'] ?></td>
    <td><?= $u['name'] ?></td>
    <td><?= $u['email'] ?></td>
    <td><?= $u['status'] ?></td>
    <td><img src="uploads/<?= htmlspecialchars($u['image']) ?>" alt="image" height="100px" width="100px"></td>
    <td>
        <a href="actions/restore.php?id=<?= $u['id'] ?>" class="btn btn-warning btn-sm">Restore</a>
        <a href="actions/permanentdelete.php?id=<?= $u['id'] ?>" class="btn btn-danger btn-sm">Permanent Delete</a>
   
    </td>
</tr>
<?php endforeach; ?>

</table>
</div>
<?php include "includes/footer.php"; ?>