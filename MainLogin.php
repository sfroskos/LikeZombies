<html> 
<link rel="stylesheet" type="text/css" href="style.css">
    <head> 
        <title>Login</title> 
    </head> 
    <body id="body-color"> 
        <div id="Sign-Up"> 
            <fieldset style="width:30%">
                <legend>LikeZombies Login</legend> 
                <table border="0"> 
                    <tr> 
                    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
                        <td>User ID</td>
                        <td> 
                            <input type="text" name="gameusername">
                        </td> 
                    </tr> 
                    <tr> 
                        <td>Password</td>
                        <td> 
                            <input type="text" name="gamepassword">
                        </td> 
                    </tr> 
                    <tr> 
                            <input id="button" type="submit" name="submit" value="Login">
                        </td> 
                    </tr> 
                    </form> 
                </table> 
                <a href="Register.php">Register</a> <a href="Logout.php">Logout</a>
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
    $gamepassword = testinput($_POST["gamepassword"]);
    // Connect to database
    $mysqli = mysqli_connect($dbhost,$dbusername,$dbpassword,$dbname);
    //Output any connection error
    if ($mysqli->connect_error) {
        die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
    }
    $sql="SELECT * FROM $tblname WHERE username = '$gameusername' AND password = SHA2('$gamepassword',256)";
    $sqlresult=$mysqli->query($sql);
    // If result matched $gameusername and $gamepassword, table row must be 1 row
    if($sqlresult->num_rows == 1){
        // Register $myusername, $mypassword and print login success message
        $_SESSION['gameusername']=$gameusername;    
        session_start();
        echo 'Login Successful!';
    //Close connection to DB as it is no longer needed
    $mysqli->close();
    }
    else {
        echo "Wrong Username or Password";
    }
}
ob_end_flush();
?>