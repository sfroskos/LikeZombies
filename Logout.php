<?php 
session_start();
session_destroy();
echo '<td>You have been logged out.</td> <a href="MainLogin.php">Login</a>';
?>
