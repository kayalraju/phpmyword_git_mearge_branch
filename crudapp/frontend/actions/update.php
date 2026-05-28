<?php
require "../config/db.php";

$id = $_POST['id'] ?? '';
$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$status = $_POST['status'] ?? '';
$hobbies = $_POST['hobbies'] ?? '';
$gender = $_POST['gender'] ?? '';
$image = $_FILES['image'] ?? null;
$oldImage = $_POST['old_image'] ?? '';

if(empty($id) || empty($name) || empty($email)){
    die("Required fields missing");
}

$uploadPath = "../uploads/";

if($image && $image['name']){

    $filename = time() . "_" . basename($image['name']);
    $target = $uploadPath . $filename;

    if(!move_uploaded_file($image['tmp_name'], $target)){
        die("Image upload failed");
    }

    // delete old image
    if(!empty($oldImage)){
        $oldPath = $uploadPath . $oldImage;

        if(file_exists($oldPath)){
            unlink($oldPath);
        }
    }

} else {
    $filename = $oldImage;
}

$stmt = $pdo->prepare("
    UPDATE employees 
    SET name=?, email=?, status=?, image=?, hobbies=?, gender=? 
    WHERE id=?
");

$stmt->execute([$name,$email,$status,$filename,json_encode($hobbies),$gender,$id]);

header("Location: ../index.php");
exit;
?>