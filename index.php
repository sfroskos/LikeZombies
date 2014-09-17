<?php
    include_once('PostToFB.php');
    include_once('FacebookSession.php');
    include_once('PHPDebug.php');
    use Facebook\FacebookSession;
    use Facebook\PostToFB;
    use Facebook\PHPDebug;
    //Initialize Debug for Javascript console
    $debug = new PHPDebug();
    //Set application variables for accessing Facebook
    $FacebookSession = new FacebookSession();
    $FacebookSession::setDefaultApplication('1432542257021113','cc001cfeefbf0fa75256e0c93aaedd29');
    //Instantiate PostToFB class;
    $PostToFB = new PostToFB();
    //Get Facebook Session using JavaScriptLoginHelper
    $debug->debug("Variable session =", $session);
    $session = $PostToFB->GetFBSession();
    $debug->debug("Variable session =", $session);
    //Get user name from FB Profile
    $fbusername = $PostToFB->GetFBUserName($session);
    //Post message to user feed
    echo 'Login Successful!';
    $PostToFB->PostToFB($session);  //call function to post to fb feed
    echo 'Post Successful!';
?>