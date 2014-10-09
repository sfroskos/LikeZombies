<html> 
<link rel="stylesheet" type="text/css" href="style.css">
    <head> 
        <title>Register</title> 
    </head> 
    <body id="body-color"> 
        <div id="LikeZombiesGame"> 
            <fieldset style="width:30%">
                <legend>Registration for LikeZombies</legend> 
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
$gameusername = $gamepassword1 = $gamepassword2 = "";

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
    else {
        $mysqli = new mysqli($dbhost,$dbusername,$dbpassword,$dbname);
        //Output any connection error
        if ($mysqli->connect_error) {
            die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
        }
        $sql="SELECT * FROM $tblname WHERE username = '$gameusername'";
        $sqlresult=$mysqli->query($sql);

        // If result matched $gameusername and $gamepassword, table row must be 1 row
        if($sqlresult->num_rows == 1){
            // Username is already taken
            echo "This username is already registered. Please select a different username.";
            header("location:Register.php");
        }
        else {
            $gameusername = '"'.$mysqli->real_escape_string($gameusername).'"';
            $gamepassword1 = '"'.$mysqli->real_escape_string($gamepassword1).'"';
            $sql="INSERT INTO $tblname(username,password) VALUES($gameusername,SHA2($gamepassword1,256))";
            // $insertrow = $mysqli->query($sql);
            $insertrow = $mysqli->query($sql) or trigger_error($mysqli->error." [$sql]");

            if($insertrow){
                echo 'You have been registered successfully!'; 
            }
            else{
                die('Error : ('. $mysqli->errno .') '. $mysqli->error);
            }
        }
    $mysqli->close();
    }
}
    // Store_array inserts data into a table from an array
   function store_array (&$data, $table, $mysqli)
  {
    $cols = implode(',', array_keys($data));
    foreach (array_values($data) as $value)
    {
      isset($vals) ? $vals .= ',' : $vals = '';
      $vals .= '\''.$this->mysql->real_escape_string($value).'\'';
    }
    $mysqli->real_query('INSERT INTO '.$table.' ('.$cols.') VALUES ('.$vals.')');
  }
ob_end_flush();
?>