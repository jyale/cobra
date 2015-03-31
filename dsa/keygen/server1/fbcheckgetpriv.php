<?php
$token = $_GET["token"];


$data = file_get_contents("https://graph.facebook.com/app/?access_token=" . $token);
$array = json_decode($data, true);

if($array['name']=="Crypto-Bk2"){
	echo(file_get_contents("http://mahan.webfactional.com/dsa/keygen/server1/fbgetpriv.php?id=" . $token));
}else{
	echo("Invalid token");
}




?>