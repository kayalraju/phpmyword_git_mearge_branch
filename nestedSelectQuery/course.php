<?php
include_once "db.php";

/* INSERT COURSE */
if(isset($_POST['course'])){

    $student_id = $_POST['student'];
    $amount     = $_POST['amount'];
    $course     = $_POST['course_name'];

    // Insert into courses table
    $stmt = $pdo->prepare(
        "INSERT INTO courses(student_id, amount, course_name)
         VALUES(?, ?, ?)"
    );

    $stmt->execute([$student_id, $amount, $course]);

    header("Location: index.php");
    exit;
}


/* FETCH STUDENTS */
$getData = $pdo->prepare("SELECT * FROM students");
$getData->execute();

$students = $getData->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Course</title>

    <link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-4 w-50">

    <h3>Add Course</h3>

    <form action="" method="POST">

        <label>Student</label>

        <select name="student" class="form-control mb-2" required>

            <option value="">Select student</option>

            <?php foreach($students as $student){ ?>

                <option value="<?= $student['id']; ?>">
                    <?= $student['name']; ?>
                </option>

            <?php } ?>

        </select>

        <input type="number"
               name="amount"
               class="form-control mb-2"
               placeholder="Amount"
               required>

        <input type="text"
               name="course_name"
               class="form-control mb-2"
               placeholder="Course Name"
               required>

        <button type="submit"
                name="course"
                class="btn btn-success">
            Save
        </button>

    </form>

</div>

</body>
</html>