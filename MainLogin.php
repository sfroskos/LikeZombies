<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
<body>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
UserName: <input type="text" name="gameusername"><br>
Password: <input type="text" name="gamepassword"><br>
<input type="submit">
<a href="register.php">Register</a>
</form>
</body>
</html>  
<?php
ob_start();
include_once('LoginSuccess.php');
include_once('TestInput.php');
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
    $sql="SELECT * FROM $tblname WHERE username = '$gameusername' AND password = SHA1('$gamepassword')";
    $sqlresult=mysqli_query($dbconnection,$sql);

    // Mysql_num_row is counting table row
    $rowcount=mysqli_num_rows($sqlresult);

    // If result matched $gameusername and $gamepassword, table row must be 1 row
    if($rowcount==1){
        // Register $myusername, $mypassword and redirect to file "login_success.php"
        $_SESSION['gameusername']=$gameusername;    
        header("location:login_success.php");
    //Close connection to DB as it is no longer needed
    mysqli_close($dbconnection);
    }
    else {
        echo "Wrong Username or Password";
    }
}


ob_end_flush();
?>

