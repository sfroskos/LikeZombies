<html> 
<link rel="stylesheet" type="text/css" href="style.css">
    <head> 
        <title>Sign-Up</title> 
    </head> 
    <body id="body-color"> 
        <div id="Sign-Up"> 
            <fieldset style="width:30%">
                <legend>Registration for LikeZombies!</legend> 
                <table border="0"> 
                    <tr> 
                    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
                        <td>User ID</td>
                        <td> 
                            <input type="text" name="gameusername"></td> 
                    </tr> 
                    <tr> 
                        <td>Password</td>
                        <td> 
                            <input type="text" name="gamepassword1">
                        </td> 
                    </tr> 
                    <tr> 
                        <td>Confirm Password</td>
                        <td> 
                            <input type="text" name="gamepassword2">
                        </td> 
                    </tr> 
                    <tr> 
                            <input id="button" type="submit" name="submit" value="Register">
                        </td> 
                    </tr> 
                    </form> 
                </table> 
                <a href="MainLogin.php">Login</a>
            </fieldset> 
        </div> 
    </body> 
</html>
<?php
ob_start();
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
    $gamepassword1 = testinput($_POST["gamepassword1"]);
    $gamepassword2 = testinput($_POST["gamepassword2"]);
    // Connect to database
    if ($gamepassword1 != $gamepassword2) {
        echo 'Passwords do not match. Please try again.' . mysqli_connect_error();
    }
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
        if($sqlresult==200){
            echo 'User successfully registered! <a href="MainLogin.php">Login</a>';
        }
    }
    mysqli_close($dbconnection);
    }
ob_end_flush();
?>