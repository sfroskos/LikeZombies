<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
   <table width="300" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
    <tr>
    <form name="form1" method="post" action="checklogin.php">
    <td>
    <table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">
    <tr>
    <td colspan="3"><strong>Member Login </strong></td>
    </tr>
    <tr>
    <td width="78">Username</td>
    <td width="6">:</td>
    <td width="294"><input name="myusername" type="text" id="myusername"></td>
    </tr>
    <tr>
    <td>Password</td>
    <td>:</td>
    <td><input name="mypassword" type="text" id="mypassword"></td>
    </tr>
    <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><input type="submit" name="Submit" value="Login"></td>
    </tr>
    </table>
    </td>
    </form>
    </tr>
    </table>     
        <?php
        // put your code here
        ?>
    </body>
</html>
