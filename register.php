<html> 
<link rel="stylesheet" type="text/css" href="style.css">
    <head> 
        <title>Sign-Up</title> 
    </head> 
    <body id="body-color"> 
        <div id="Sign-Up"> 
            <fieldset style="width:30%">
                <legend>Registration Form</legend> 
                <table border="0"> 
                    <tr> 
                    <form method="POST" action="connectivity-sign-up.php"> 
                        <td>Name</td>
                        <td> 
                            <input type="text" name="gameusername"></td> 
                    </tr> 
                    <tr> 
                        <td>Email</td>
                        <td> 
                            <input type="text" name="gamepassword">
                        </td> 
                    </tr> 
                    <tr> 
                        <td>
                            <input id="button" type="submit" name="submit" value="Sign-Up">
                        </td> 
                    </tr> 
                    </form> 
                </table> 
            </fieldset> 
        </div> 
    </body> 
</html>
<?php
ob_start();
include_once('MainLogin.php');
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
    $sql="SELECT * FROM $tblname WHERE username = '$gameusername'";
    $sqlresult=mysqli_query($dbconnection,$sql);

    // Mysql_num_row is counting table row
    $rowcount=mysqli_num_rows($sqlresult);

    // If result matched $gameusername and $gamepassword, table row must be 1 row
    if($rowcount==1){
        // Username is already taken
        echo "This username is already registered. Please select a different username.";
        header("location:signup.php");
    }
    else {
        $sql="INSERT INTO $tblname (username,password) VALUES('$gameusername',SHA1('$gamepassword')";
        $sqlresult=mysqli_query($dbconnection,$sql);
        if($sqlresult=200){
            echo 'User successfully registered! <a href="MainLogin.php">Login</a>';
        }
    }
    mysqli_close($dbconnection);
    }

function testinput($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
ob_end_flush();
?>