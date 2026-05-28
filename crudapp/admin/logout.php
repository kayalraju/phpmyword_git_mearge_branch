
<?php
session_start();
require "config/db.php";

// Destroy session
session_destroy();


header("Location: index.php");
exit;