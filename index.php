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
    $debug->debug("Trying helper->getSession", null, INFO);
   try {
         $FBSession = $helper->getSession();
         $debug->debug("Trying helper->getSession", null, INFO);
    } catch( FacebookRequestException $ex ) {
        $debug->debug("ex = ", $ex);
        // When Facebook returns an error
    } catch( Exception $ex ) {
        $debug->debug("ex = ", $ex);
         // When validation fails or other local issues
    }
    $debug->debug("Variable FBSession =", $FBSession);
    if ($FBSession) {
    // Already logged into LikeZombies
        echo "You are already logged into LikeZombies!";
    }
    else {
    // Login failed. Redirect user to log in to LikeZombies
        $helper = new FacebookRedirectLoginHelper('https://likezombiesgame/LoginSuccess.php');
        $FBloginUrl = $helper->getLoginUrl();
    // Use the login url to redirect to Facebook for authentication
        header(FBloginUrl);
    //         echo "Facebook Login to LikeZombies Failed!";
        }
// }    
?>