<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nested Select Query</title>
</head>
<body>

<h1>Nested Select Query</h1>

<?php
// A nested SELECT query (subquery) in PHP + MySQL means using one query inside another. 
// It’s very useful when you want to filter results based on another table or condition.

include_once "db.php";

$getData = $pdo->prepare(
    "SELECT * FROM students
     WHERE id IN (
        SELECT student_id
        FROM courses
        WHERE amount > 6000
     )"
);

$getData->execute();

$students = $getData->fetchAll(PDO::FETCH_ASSOC);

foreach($students as $student){
    echo "ID: " . $student['id'] . "<br>";
    echo "Student Name: ". $student['name'] . "<br>";
}

?>

</body>
</html>