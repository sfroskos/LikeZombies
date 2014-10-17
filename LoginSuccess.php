<html> 
<link rel="stylesheet" type="text/css" href="style.css">
    <head> 
        <title>Login</title> 
    </head> 
    <body id="body-color"> 
        <div id="LikeZombiesGame"> 
            <fieldset style="width:30%">
                <h1>Success! You are now logged into the LikeZombies Game!</h1>
                <a href="Register.php">Register</a> <a href="Logout.php">Logout</a>
            </fieldset> 
        </div> 
    </body> 
</html>
<?php
require_once( 'Facebook/FacebookSession.php' );
require_once( 'Facebook/FacebookRedirectLoginHelper.php' );
require_once( 'Facebook/FacebookRequest.php' );
require_once( 'Facebook/FacebookResponse.php' );
require_once( 'Facebook/FacebookSDKException.php' );
require_once( 'Facebook/FacebookRequestException.php' );
require_once( 'Facebook/FacebookAuthorizationException.php' );
require_once( 'Facebook/GraphObject.php' );
require_once( 'Facebook/GraphUser.php' );
require_once( 'SignedRequest.php' );
require_once( 'AccessToken.php' );
require_once( 'Facebook/FacebookSignedRequestFromInputHelper.php' );
require_once( 'Facebook/FacebookCanvasLoginHelper.php' );
require_once( 'PostToFB.php');
include_once( 'Facebook/FacebookSession.php');
include_once( 'PHPDebug.php');

use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\FacebookResponse;
use Facebook\FacebookSDKException;
use Facebook\FacebookRequestException;
use Facebook\FacebookAuthorizationException;
use Facebook\GraphObject;
use Facebook\GraphUser;
use Facebook\FacebookSignedRequestFromInputHelper;
use Facebook\FacebookCanvasLoginHelper;
use Facebook\PostToFB;
use Facebook\PHPDebug;

FacebookSession::setDefaultApplication('1432542257021113','cc001cfeefbf0fa75256e0c93aaedd29');
$helper = new FacebookCanvasLoginHelper();
$debug = new PHPDebug();
$debug->debug("About to try helper->getSession", null, INFO);
try {
    $FBSession = $helper->getSession();
    $debug->debug("Variable FBSession =", $FBSession);
} catch( FacebookRequestException $ex ) {
    $debug->debug("ex = ", $ex);
    // When Facebook returns an error
} catch( Exception $ex ) {
    $debug->debug("ex = ", $ex);
     // When validation fails or other local issues
}
//$debug->debug("Variable FBSession =", $FBSession);
//Instantiate PostToFB class;
$PostToFB = new PostToFB();
//Get Facebook Session using JavaScriptLoginHelper
//$debug->debug("Variable FBSession =", $FBSession);
//$FBSession = $PostToFB->GetFBSession();
//$debug->debug("Variable FBSession =", $FBSession);
//Get user name from FB Profile
$fbusername = $PostToFB->GetFBUserName($FBSession);
$PostToFB->PostToFB($FBSession);  //call function to post to fb feed
echo 'Post Successful!';
?>
