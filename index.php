<?php
namespace Facebook;
include_once('FacebookPermissionException.php');
include_once('FacebookSession.php');
include_once('FacebookRequest.php');
include_once('GraphUser.php');
include_once('FacebookRequestException.php');
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
use Facebook\FacebookSession;
use Facebook\FacebookRequest;
use Facebook\GraphUser;
use Facebook\FacebookRequestException;
use Facebook\FacebookCanvasLoginHelper;
use Facebook\GraphObject;

//Set application variables for accessing Facebook
\Facebook\FacebookSession::setDefaultApplication('1432542257021113','cc001cfeefbf0fa75256e0c93aaedd29');
//Get an application session
$session = \Facebook\FacebookSession::newAppSession();

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
