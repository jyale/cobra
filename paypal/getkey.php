<?php
require '../php-sdk/facebook.php';
session_start();
// Create our Application instance (replace this with your appId and secret).
$facebook = new Facebook(array(
  'appId'  => '131686000339117',
  'secret' => 'bda3a9ca0d385c804d42ecd7beb91c65',
));

// Get User ID
$user = $facebook->getUser();

	// echo("<br><br>");
	$info = $facebook->api('/me');
	$paypalName = $_REQUEST['name'];
	$fbName = $info['name'];

	//echo("Paypal name: " . $paypalName);
	//echo("<br>Facebook name: ");
	//print_r($fbName);	
	//echo("<br><br>");

	$token = $facebook->getAccessToken();
	//echo($token);

	//echo('<br><br>');

	if($fbName == $paypalName){
		//echo("Same");
		//echo("<br><br>");
		// collect the private key as we have verified the user
		exec('./../dsa/keygen/getcomppriv.py ' . $token);
		$myFile = "output/" . $info['username'] . '.priv';
		$fh = fopen($myFile, 'r');
		$theData = fread($fh, filesize($myFile));
		fclose($fh);
		//echo $theData;

		echo('<a href="download.php?data=' . $theData . '">Download my private key</a>');
?>

<?php
		
	} else {
		echo("Your name on your PayPal account must match your Facebook name.");
	}

?>