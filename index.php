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

//Initialize Debug for Javascript console
$debug = new PHPDebug();
// if (!isset($_SESSION['facebookUserId']) || !isset($_SESSION['facebookSession']) || !isset($_SESSION['facebookUserProfile'])) {
    // init app with app id (APPID) and secret (SECRET)
//    $FacebookSession = new FacebookSession($_SESSION['facebookSession']);
    FacebookSession::setDefaultApplication('1432542257021113','cc001cfeefbf0fa75256e0c93aaedd29');
    // login helper
    //$helper = new FacebookRedirectLoginHelper( 'https://apps.facebook.com/likezombies.dev' );
    $helper = new FacebookCanvasLoginHelper();
   try {
         $FBSession = $helper->getSession();
    } catch( FacebookRequestException $ex ) {
        // When Facebook returns an error
    } catch( Exception $ex ) {
         // When validation fails or other local issues
    }
    if ($FBSession) {
    // Logged in    
        echo "Facebook Login to LikeZombies Successful!";
    }
    else {
    // Login failed
        echo "Facebook Login to LikeZombies Failed!";
        }
// }    
    //Instantiate PostToFB class;
    $PostToFB = new PostToFB();
    //Get Facebook Session using JavaScriptLoginHelper
    $debug->debug("Variable FBSession =", $FBSession);
    $FBSession = $PostToFB->GetFBSession();
    $debug->debug("Variable FBSession =", $FBSession);
    //Get user name from FB Profile
    $fbusername = $PostToFB->GetFBUserName($FBSession);
    //Post message to user feed
    echo 'Login Successful!';
    $PostToFB->PostToFB($FBSession);  //call function to post to fb feed
    echo 'Post Successful!';
?>