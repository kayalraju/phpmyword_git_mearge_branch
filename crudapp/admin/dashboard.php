<?php
require "middleware/authcheck.php";
 ?>

<div class="container mt-4 w-50">
   
<?php

echo "Welcome " ."<b>". $_SESSION['user_name'] ."</b>". " is logged in";

?>

<a href="logout.php">Logout</a>
   
</div>



