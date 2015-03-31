#!/usr/bin/php
<?php

# Sandbox
$host = 'https://api.sandbox.paypal.com';
$clientId = 'AWaHKxBJNZU319-tusw1q8-nG7vk2xoLKJwSuM50-xfUVqNUFrcwu5q8Gc2V';
$clientSecret = 'EMJpNRDI4oqA0ZmVogQVLdGAQVSmR07GS_qRbvuz1ERdn-gr37h3lbOpCxJE';

$token = '';
// function to read stdin
function read_stdin() {
        $fr=fopen("php://stdin","r"); // open our file pointer to read from stdin
        $input = fgets($fr,128); // read a maximum of 128 characters
        $input = rtrim($input); // trim any trailing spaces.
        fclose ($fr); // close the file handle
        return $input; // return the text entered
}

function get_access_token($url, $postdata) {
global $clientId, $clientSecret;
$curl = curl_init($url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_USERPWD, $clientId . ":" . $clientSecret);
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $postdata);
# curl_setopt($curl, CURLOPT_VERBOSE, TRUE);
$response = curl_exec( $curl );
if (empty($response)) {
// some kind of an error happened
die(curl_error($curl));
curl_close($curl); // close cURL handler
} else {
$info = curl_getinfo($curl);
echo "Time took: " . $info['total_time']*1000 . "ms\n";
curl_close($curl); // close cURL handler
if($info['http_code'] != 200 && $info['http_code'] != 201 ) {
echo "Received error: " . $info['http_code']. "\n";
echo "Raw response:".$response."\n";
die();
}
}

// Convert the result from JSON format to a PHP array
$jsonResponse = json_decode( $response );
return $jsonResponse->access_token;
}

function make_post_call($url, $postdata) {
global $token;
$curl = curl_init($url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HTTPHEADER, array(
'Authorization: Bearer '.$token,
'Accept: application/json',
'Content-Type: application/json'
));

curl_setopt($curl, CURLOPT_POSTFIELDS, $postdata);
#curl_setopt($curl, CURLOPT_VERBOSE, TRUE);
$response = curl_exec( $curl );
if (empty($response)) {
// some kind of an error happened
die(curl_error($curl));
curl_close($curl); // close cURL handler
} else {
$info = curl_getinfo($curl);
echo "Time took: " . $info['total_time']*1000 . "ms\n";
curl_close($curl); // close cURL handler
if($info['http_code'] != 200 && $info['http_code'] != 201 ) {
echo "Received error: " . $info['http_code']. "\n";
echo "Raw response:".$response."\n";
die();
}
}

// Convert the result from JSON format to a PHP array
$jsonResponse = json_decode($response, TRUE);
return $jsonResponse;
}

function make_get_call($url) {
global $token;
$curl = curl_init($url);
curl_setopt($curl, CURLOPT_POST, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HTTPHEADER, array(
'Authorization: Bearer '.$token,
'Accept: application/json',
'Content-Type: application/json'
));

#curl_setopt($curl, CURLOPT_VERBOSE, TRUE);
$response = curl_exec( $curl );
if (empty($response)) {
// some kind of an error happened
die(curl_error($curl));
curl_close($curl); // close cURL handler
} else {
$info = curl_getinfo($curl);
echo "Time took: " . $info['total_time']*1000 . "ms\n";
curl_close($curl); // close cURL handler
if($info['http_code'] != 200 && $info['http_code'] != 201 ) {
echo "Received error: " . $info['http_code']. "\n";
echo "Raw response:".$response."\n";
die();
}
}

// Convert the result from JSON format to a PHP array
$jsonResponse = json_decode($response, TRUE);
return $jsonResponse;
}

echo "\n";
echo "###########################################\n";
echo "Obtaining OAuth2 Access Token.... \n";
$url = $host.'/v1/oauth2/token';
$postArgs = 'grant_type=client_credentials';
$token = get_access_token($url,$postArgs);
echo "Got OAuth Token: ".$token;
echo "\n \n";
echo "#########";

?>