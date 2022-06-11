<?php 

session_start();

echo $_SESSION['blogData']['title'];
echo $_SESSION['blogData']['content'];

?>
