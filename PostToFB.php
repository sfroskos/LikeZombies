<?php
namespace Facebook;
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

/**
 * Class PostToFB
 * LikeZombies
 * @author Seth Roskos
 * This is the main class that interacts with Facebook APIs for the LikeZombies
 * Application
  */
class PostToFB
{
//This function posts a story or other item to FB on behalf of the LikeZombies game
    public function posttofb()
  //Get user name from FB Profile
    {try {
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

        if($session) {

          try {

            $response = (new FacebookRequest(
              $session, 'POST', '/1432542257021113/feed', array(
                'link' => 'www.likezombies.com',
                'message' => 'You have succesfully logged into LikeZombies!'
              )
            ))->execute()->getGraphObject();

            echo "Posted with id: " . $response->getProperty('id');

          } catch(FacebookRequestException $e) {

            echo "Exception occured, code: " . $e->getCode();
            echo " with message: " . $e->getMessage();

          }

        }//End if($session)
    }//End posttofb function
} //End PostToFB Class
?>