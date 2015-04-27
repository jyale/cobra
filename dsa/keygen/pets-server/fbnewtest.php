<?php

require '../../../php-sdk/facebook.php';

$appId  = '131686000339117';
$secret = 'bda3a9ca0d385c804d42ecd7beb91c65';

// Create our Application instance (replace this with your appId and secret).
$facebook = new Facebook(array(
  'appId'  => $appId,
  'secret' => $secret,
));

// Get User ID
$user = $facebook->getUser();
$token = $facebook->getAccessToken();
echo $token;
echo '<br><br>';
// Skip these two lines if you're using Composer
define('FACEBOOK_SDK_V4_SRC_DIR', '/home/mahan/webapps/cobra2/dsa/keygen/pets-server/facebook-php-sdk-v4/src/Facebook/');
require __DIR__ . '/facebook-php-sdk-v4/autoload.php';

require_once( FACEBOOK_SDK_V4_SRC_DIR . 'FacebookSession.php' );
require_once( FACEBOOK_SDK_V4_SRC_DIR . 'FacebookRequest.php' );
require_once( FACEBOOK_SDK_V4_SRC_DIR . 'GraphUser.php' );
require_once( FACEBOOK_SDK_V4_SRC_DIR . 'FacebookRequestException.php' );

use Facebook\FacebookSession;
use Facebook\FacebookRequest;
use Facebook\GraphUser;
use Facebook\FacebookRequestException;


FacebookSession::setDefaultApplication($appId,$secret);

// Use one of the helper classes to get a FacebookSession object.
//   FacebookRedirectLoginHelper
//   FacebookCanvasLoginHelper
//   FacebookJavaScriptLoginHelper
// or create a FacebookSession with a valid access token:
$session = new FacebookSession($token);

// Get the GraphUser object for the current user:

try {
  $me = (new FacebookRequest(
    $session, 'GET', '/me'
  ))->execute()->getGraphObject(GraphUser::className());
  echo $me->getName();

$request = new FacebookRequest(
  $session,
  'GET',
  '/307455162682924/members?limit=5000'
);
$response = $request->execute();
$graphObject = $response->getGraphObject();

echo '<br><br>';
echo(count($graphObject->getPropertyAsArray('data')));
echo '<br><br>';




for ($i = 0; $i<count($graphObject->getPropertyAsArray('data')); $i++){
	$curUser = $graphObject->getPropertyAsArray('data')[$i];
	print_r($curUser->getProperty('name') . ' ' . $curUser->getProperty('id') . '<br>');

$test = 'https://graph.facebook.com/' . $curUser->getProperty('id') . '?access_token=' . $token;
$json = file_get_contents($test);
$obj = json_decode($json);
echo $obj->username;


$userrequest = new FacebookRequest(
  $session,
  'GET',
  '/' . $curUser->getProperty('id')
);
$userresponse = $userrequest->execute();
$userGraphObject = $userresponse->getGraphObject();
//var_dump($userGraphObject->getProperty('username'));
echo('<br><br><br>');


}


} catch (FacebookRequestException $e) {
  // The Graph API returned an error
  print_r($e);
} catch (\Exception $e) {
  // Some other error occurred
print_r($e);
}




?>
