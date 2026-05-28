<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Where and Order By</h1>

    <?php

    require 'db.php';

    $stmt = $pdo->prepare("SELECT * FROM student WHERE marks > 80 ORDER BY marks DESC");
    $stmt->execute();

    foreach($stmt as $row){
        echo "<p>{$row['name']} - {$row['email']} - {$row['marks']}</p>";
    }

?>

<hr>
<!-- filter search by name -->

<?php

$name= $_GET['name'] ?? '';
$query = "SELECT * FROM student WHERE name LIKE ?";
$params = ["%$name%"];
$stmt = $pdo->prepare($query);
$stmt->execute($params);
$users = $stmt->fetchAll();

// foreach($users as $user){
//     echo "<p>Result : {$user['name']} - {$user['email']} - {$user['marks']}</p>";
// }




?>

<form action="" method="get">
    <input type="text" name="name" value="<?= $name ?>">
    <button type="submit">Search</button>
</form>

<table>
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Marks</th>
    </tr>

    <?php
     foreach($users as $user){ ?>
        <tr>
            <td><?= $user['name'] ?></td>
            <td><?= $user['email'] ?></td>
            <td><?= $user['marks'] ?></td>
        </tr>
    <?php } ?>
</table>

</body>
</html>