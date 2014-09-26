<?php

db_start();
$dbhost="localhost"; // Host name 
$dbusername="root"; // Mysql username 
$dbpassword="kir6l6fU"; // Mysql password 
$dbname="LikeZombies"; // Database name 
$tblname="users"; // Table name 

// Connect to database
$dbconnection = mysqli_connect("$dbhost","$dbusername","$dbpassword","$dbname);
// Check DB connection
if (mysqli_connect_errno()) {
  echo 'Failed to connect to MySQL: ' . mysqli_connect_error();
}

// Define $gameusername and $gamepassword 
$gameusername=$_POST['gameusername']; 
$gamepassword=$_POST['gamepassword']; 

// To protect MySQL injection (more detail about MySQL injection)
$gameusername = stripslashes($gameusername);
$gamepassword = stripslashes($gamepassword);
$gameusername = mysql_real_escape_string($gameusername);
$gamepassword = mysql_real_escape_string($gamepassword);
$sql="SELECT * FROM $tblname WHERE username='$gameusername' and password=UNHEX(SHA1('$gamepassword'))";
$sqlresult=mysql_query($sql);

// Mysql_num_row is counting table row
$count=mysql_num_rows($result);

// If result matched $gameusername and $gamepassword, table row must be 1 row
if($count==1){

// Register $myusername, $mypassword and redirect to file "login_success.php"
session_register("gameusername");
session_register("gamepassword"); 
header("location:login_success.php");
}
else {
echo "Wrong Username or Password";
}
ob_end_flush();
?>