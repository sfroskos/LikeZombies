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
//$RedirectUrl = 'https://likezombiesgame.com/LoginSuccess.php';
  /**
   * Returns the JSON encoded POST data, if any, as an object.
   * @return Object|null
   */
// get the raw POST data
$rawData = file_get_contents("php://input");
// this returns null if not valid json
//return json_decode($rawData);
$JSONSignedRequest = parse_signed_request($rawData);
$SignedRequestArray = json_decode($JSONSignedRequest);
if($SignedRequestArray["oauth_token"]) { 
    $debug->debug("oauth_token detected. The user is signed in.", null, INFO);
    echo 'You are already signed into LikeZombies!';
}
else {
    $debug->debug("No oauth_token detected. The user is not signed in.", null, INFO);
//    $RedirectUrl = 'https://apps.facebook.com/likezombiesdev/index.php';
    $facebookLoginHtml = "window.top.location = "
           . "'https://www.facebook.com/dialog/oauth?client_id="
           . "{'1432542257021113'}&redirect_uri= "
           . "{https://apps.facebook.com/likezombiesdev/index.php}"
           . "&scope=publish_actionspublic_profile, user_friends,"
           .  "user_relationships, read_stream, publish_actions';"; 
    $debug->debug("Variable facebookLoginHtml = ", $facebookLoginHtml);
    if(isset($facebookLoginHtml)){ 
        echo '<script language="javascript">'; 
        echo 'top.location.href =' . $facebookLoginHtml . ';'; 
        echo '</script>';        
    }
}

function parse_signed_request($signed_request) {
  list($encoded_sig, $payload) = explode('.', $signed_request, 2); 

  $secret = "cc001cfeefbf0fa75256e0c93aaedd29"; // Use your app secret here

  // decode the data
  $sig = base64_url_decode($encoded_sig);
  $data = json_decode(base64_url_decode($payload), true);

  // confirm the signature
  $expected_sig = hash_hmac('sha256', $payload, $secret, $raw = true);
  if ($sig !== $expected_sig) {
    error_log('Bad Signed JSON signature!');
//    $debug->debug("Bad Signed JSON signature!", null, INFO);
    return null;
  }

  return $data;
}

function base64_url_decode($input) {
  return base64_decode(strtr($input, '-_', '+/'));
}

//$helper = new FacebookRedirectLoginHelper( $RedirectUrl,
//    $appId = '1432542257021113', 
//    $appSecret = 'cc001cfeefbf0fa75256e0c93aaedd29');
//$getLoginUrlparams = array(
//    'scope' => 'public_profile,user_friends,user_relationships,read_stream,publish_actions',
//    'redirect_uri' => $RedirectUrl);
//$debug->debug("getLoginUrlparams = ", $getLoginUrlparams);
//$FBloginUrl = $helper->getLoginUrl($getLoginUrlparams);
//$debug->debug("Variable FBloginUrl =", $FBloginUrl);
//echo '<a href="' . $FBloginUrl . '">Login with Facebook</a>';
// Use the login url to redirect to Facebook for authentication
//header($FBloginUrl);
?>