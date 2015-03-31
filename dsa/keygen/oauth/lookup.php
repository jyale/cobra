<?php

$access_token = $_GET["access_token"];


if (file_exists('oauth-tokens/' . $access_token)) {
    echo(file_get_contents('oauth-tokens/' . $access_token));
} else {
    http_response_code(400);
	echo("error=access_denied");
}



?>