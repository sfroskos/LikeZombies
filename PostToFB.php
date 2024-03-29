<?php
namespace Facebook;
include_once('FacebookPermissionException.php');
include_once('FacebookHttpable.php' );
include_once('FacebookCurl.php' );
include_once('FacebookCurlHttpClient.php' );
include_once('FacebookOtherException.php' );
include_once('GraphSessionInfo.php' );
include_once('AccessToken.php');
include_once('FacebookJavaScriptLoginHelper.php');
include_once('SignedRequest.php');
include_once('PHPDebug.php');
use Facebook\FacebookSession;
use Facebook\FacebookRequest;
use Facebook\GraphUser;
use Facebook\FacebookRequestException;
use Facebook\FacebookCanvasLoginHelper;
use Facebook\GraphObject;
use Facebook\FacebookJavaScriptLoginHelper;

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

    public function GetFBSession()
    {   
        {
        //$helper = new FacebookJavaScriptLoginHelper();
        $helper = new FacebookCanvasLoginHelper();
        try {
          echo "Try";
          $session = $helper->getSession();
          echo "Session: " . $session;
        } catch(FacebookRequestException $ex) {
          // When Facebook returns an error
        } catch(\Exception $ex) {
          // When validation fails or other local issues
        }
            //Initialize Debug for Javascript console
        $debug = new PHPDebug();
        $debug->debug("Variable session =", $session);
        if ($session) {
          // Logged in
            echo "Session: " . $session;
            return $session;
        }
        }     
    }
    
    public function GetFBUserName($session)
    {
        if ($session) {
            try {
                $user_profile = (new FacebookRequest(
                    $session, 'GET', '/me'
                ))->execute()->getGraphObject(GraphUser::className());
                $name = $user_profile->getName();
                echo "Name: " . $name;
            } catch(FacebookRequestException $e) {
                echo "Exception occured, code: " . $e->getCode();
                echo " with message: " . $e->getMessage();
            }   
        }
        return $name;
    }
    public function PostToFB($currentsession)
    {
        if($currentsession) {
          try {
            $response = (new FacebookRequest(
              $currentsession, 'POST', '/1432542257021113/feed', array(
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