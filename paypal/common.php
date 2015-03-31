<?php
define('KEY', 'AWaHKxBJNZU319-tusw1q8-nG7vk2xoLKJwSuM50-xfUVqNUFrcwu5q8Gc2V');
define('SECRET', 'EMJpNRDI4oqA0ZmVogQVLdGAQVSmR07GS_qRbvuz1ERdn-gr37h3lbOpCxJE');

define('CALLBACK_URL', 'http://mahan.webfactional.com/paypal/done.php');

define('ACCESS_TOKEN_ENDPOINT', 'https://api.sandbox.paypal.com/v1/identity/openidconnect/tokenservice');


/***************************************************************************
 * Function: Run CURL
 * Description: Executes a CURL request
 * Parameters: url (string) - URL to make request to
 *             method (string) - HTTP transfer method
 *             headers - HTTP transfer headers
 *             postvals - post values
 **************************************************************************/
function run_curl($url, $method = 'GET', $postvals = null){
    $ch = curl_init($url);
    
    //GET request: send headers and return data transfer
    if ($method == 'GET'){
        $options = array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_SSLVERSION => 3
        );
        curl_setopt_array($ch, $options);
    //POST / PUT request: send post object and return data transfer
    } else {
        $options = array(
            CURLOPT_URL => $url,
            CURLOPT_POST => 1,
            CURLOPT_VERBOSE => 1,
            CURLOPT_POSTFIELDS => $postvals,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_SSLVERSION => 3
        );
        curl_setopt_array($ch, $options);
    }
    
    $response = curl_exec($ch);
    curl_close($ch);
    
    return $response;
}
?>
