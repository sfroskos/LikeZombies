<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php session_start(); ?>
<html>
<body>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
UserName: <input type="text" name="gameusername"><br>
Password: <input type="text" name="gamepassword"><br>
<input type="submit">
</form>
<?php
ob_start();
// Initialize variables
$dbhost='localhost'; // Host name 
$dbusername="root"; // Mysql username 
$dbpassword=""; // Mysql password 
$dbname="likezombies"; // Database name 
$tblname="users"; // Table name 
$gameusername = $gamepassword = "";

// Check if input has been received before processing
if ($_SERVER["REQUEST_METHOD"] == "POST") {
// Check input for malicious code
    $gameusername = testinput($_POST["gameusername"]);
    $gamepassword = testinput($_POST["gamepassword"]);
    // Connect to database
    $dbconnection = mysqli_connect($dbhost,$dbusername,$dbpassword,$dbname);
    // Check DB connection
    if (mysqli_connect_errno()) {
        echo 'Failed to connect to MySQL: ' . mysqli_connect_error();
    }
    //$sql='SELECT * FROM ' + $tblname + ' WHERE username= ' + $gameusername + ' and password = UNHEX(SHA1('+ $gamepassword + '))';
    $sql="SELECT * FROM users WHERE username = 'john' AND password = UNHEX(SHA1('1234'))";
    $sqlresult=mysqli_query($dbconnection,"SELECT * FROM users WHERE username = 'john' AND password = UNHEX(SHA1('1234'))");

    // Mysql_num_row is counting table row
    $rowcount=mysqli_num_rows($sqlresult);

    // If result matched $gameusername and $gamepassword, table row must be 1 row
    if($rowcount==1){
        // Register $myusername, $mypassword and redirect to file "login_success.php"
        $_SESSION['gameusername']=1;    
        $_SESSION['gameusername']=1;    
        header("location:login_success.php");
    //Close connection to DB as it is no longer needed
    mysqli_close($dbconnection);
    }
    else {
        echo "Wrong Username or Password";
    }
}

function testinput($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

ob_end_flush();
?>
</body>
</html>  
