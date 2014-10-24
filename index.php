<?php 
session_start();
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
FacebookSession::setDefaultApplication('1432542257021113','cc001cfeefbf0fa75256e0c93aaedd29');// login helper
//$RedirectUrl = 'https://' . $_SERVER['HTTP_HOST'] . '/LoginSuccess.php';
$RedirectUrl = 'https://likezombiesgame.com/LoginSuccess.php';
$helper = new FacebookRedirectLoginHelper( $RedirectUrl,
    $appId = '1432542257021113', 
    $appSecret = 'cc001cfeefbf0fa75256e0c93aaedd29');
$getLoginUrlparams = array(
    scope => 'public_profile, user_friends, user_relationships, read_stream, publish_actions',
    redirect_uri => $RedirectUrl);
$debug->debug("getLoginUrlparams = ", $getLoginUrlparams);
$FBloginUrl = $helper->getLoginUrl($getLoginUrlparams);
echo '<a href="' . $FBloginUrl . '">Login with Facebook</a>';
// Use the login url to redirect to Facebook for authentication
$debug->debug("Variable FBloginUrl =", $FBloginUrl);
//header($FBloginUrl);
$helper = new FacebookCanvasLoginHelper();
try {
    $session = $helper->getSession();
    $debug->debug("Variable session =", $session);
    if($session){
        try {
        $facebook_profile = (new FacebookRequest(
            $session, 'GET', '/me'
        ))->execute()->getGraphObject(GraphUser::className());
        echo $facebook_profile->getName;
    } catch(FacebookRequestException $e) {
    }
}
} catch(FacebookRequestException $ex) {
   echo $ex;   
} catch(\Exception $ex) {
   $facebookLoginHtml = "window.top.location = "
           . "'https://www.facebook.com/dialog/oauth?client_id="
           . "{'1432542257021113'}&redirect_uri={https://likezombiesgame.com/LoginSuccess.php}"
           . "&scope=publish_actionspublic_profile, user_friends,"
           .  "user_relationships, read_stream, publish_actions';"; 
    $debug->debug("Variable facebookLoginHtml = ", $facebookLoginHtml);
   if(isset($facebookLoginHtml)){ echo $facebookLoginHtml; };   
}
?>