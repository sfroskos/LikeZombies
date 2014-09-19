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

use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\FacebookResponse;
use Facebook\FacebookSDKException;
use Facebook\FacebookRequestException;
use Facebook\FacebookAuthorizationException;
use Facebook\GraphObject;
use Facebook\GraphUser;

if (!isset($_SESSION['facebookUserId']) || !isset($_SESSION['facebookSession']) || !isset($_SESSION['facebookUserProfile'])) {
    // init app with app id (APPID) and secret (SECRET)
//    $FacebookSession = new FacebookSession($_SESSION['facebookSession']);
    FacebookSession::setDefaultApplication('1432542257021113','cc001cfeefbf0fa75256e0c93aaedd29');
    // login helper with redirect_uri
    $helper = new FacebookRedirectLoginHelper( 'https://apps.facebook.com/likezombies.dev' );
    try {
         $FBSession = $helper->getSessionFromRedirect();
    } catch( FacebookRequestException $ex ) {
        // When Facebook returns an error
    } catch( Exception $ex ) {
         // When validation fails or other local issues
    }
    if (!isset($FBSession)) {
        // STEP ONE - REDIRECT THE USER TO FACEBOOK FOR AUTO LOGIN / APP APPROVAL
        header('Location: ' . $helper->getLoginUrl());
        exit();
    } else {
        $user_profile = (new FacebookRequest($FBSession, 'GET', '/me'))->execute()->getGraphObject(GraphUser::className());
        $_SESSION['facebookUserId'] = $user_profile->getID();
        $_SESSION['facebookSession'] = $FBSession; // I DON'T THINK THIS ACTAULLY WORKS RIGHT
        $_SESSION['facebookUserProfile'] = $user_profile;

    }
}