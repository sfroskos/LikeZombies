namespace Facebook;
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
include_once('FacebookRequestException.php');
include_once('FacebookPermissionException.php');
include_once('FacebookSession.php');
include_once('FacebookRequest.php');
include_once('GraphUser.php');
include_once('FacebookSignedRequestFromInputHelper.php');
include_once('FacebookCanvasLoginHelper.php');
include_once('GraphObject.php');
include_once('FacebookAuthorizationException.php');
include_once('FacebookHttpable.php' );
include_once('FacebookCurl.php' );
include_once('FacebookCurlHttpClient.php' );
include_once('FacebookResponse.php' );
include_once('FacebookSDKException.php' );
include_once('FacebookOtherException.php' );
include_once('FacebookAuthorizationException.php' );
include_once('GraphObject.php' );
include_once('GraphSessionInfo.php' );
include_once('AccessToken.php');
include_once('FacebookRedirectLoginHelper.php');
use Facebook\FacebookSession;
use Facebook\FacebookRequest;
use Facebook\GraphUser;
use Facebook\FacebookRequestException;
use Facebook\FacebookCanvasLoginHelper;
use Facebook\GraphObject;

//Set application variables for accessing Facebook
\Facebook\FacebookSession::setDefaultApplication('1432542257021113','cc001cfeefbf0fa75256e0c93aaedd29');
//Get an application session
//$session = \Facebook\FacebookSession::newAppSession();

//Login user with FacebookRedirectLoginHelper
$scope = array('manage_pages, read_stream');
$helper = new FacebookRedirectLoginHelper('https://likezombiesgame.com/afterlogin.php');
$loginurl = $helper->getLoginUrl($scope);
echo '<a href="' . $loginurl . '">Login</a>';
    
//Get user name from FB Profile
try {
    $session = $helper->getSessionFromRedirect();
} catch(FacebookRequestException $ex) {
    // When Facebook returns an error
}
if ($session) {
    try {
        $user_profile = (new FacebookRequest(
            $session, 'GET', '/me'
        ))->execute()->getGraphObject(GraphUser::className());
 
        echo "Name: " . $user_profile->getName();
    } catch(FacebookRequestException $e) {
        echo "Exception occured, code: " . $e->getCode();
        echo " with message: " . $e->getMessage();
    }   
}

//Login user with FacebookCanvasLoginHelper
//$helper = new FacebookCanvasLoginHelper();
//try {
//  $session = $helper->getSession();
//} catch(FacebookRequestException $ex) {
  // When Facebook returns an error
//} catch(\Exception $ex) {
  // When validation fails or other local issues
//}
//if ($session) {
  // Logged in
//}

// Validate the session:
try {
  $session->validate();
} catch (FacebookRequestException $ex) {
  // Session not valid, Graph API returned an exception with the reason.
  echo $ex->getMessage();
} catch (\Exception $ex) {
  // Graph API returned info, but it may mismatch the current app or have expired.
  echo $ex->getMessage();
}

if($session) {

  try {

    $response = (new FacebookRequest(
      $session, 'POST', '/1432542257021113/feed', array(
        'link' => 'www.example.com',
        'message' => 'User provided message'
      )
    ))->execute()->getGraphObject();

    echo "Posted with id: " . $response->getProperty('id');

  } catch(FacebookRequestException $e) {

    echo "Exception occured, code: " . $e->getCode();
    echo " with message: " . $e->getMessage();

  }   

}
        ?>
    </body>
