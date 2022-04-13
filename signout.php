<?php   
session_start(); //to ensure you are using same session
unset($_SESSION["id"]);
unset($_SESSION["username"]);
unset($_COOKIE['PHPSESSID']);
session_destroy(); //destroy the session
session_regenerate_id();
header("location:/index.php"); //to redirect back to "index.php" after logging out
exit();
?>