<html>
<body>

<?php
require_once "common.php";

//capture code from auth
$code = $_GET["code"];

//construct POST object for access token fetch request
$postvals = sprintf("client_id=%s&client_secret=%s&grant_type=authorization_code&code=%s&redirect_uri=%s", KEY, SECRET, $code, urlencode(CALLBACK_URL));

//get JSON access token object (with refresh_token parameter)
$token = json_decode(run_curl(ACCESS_TOKEN_ENDPOINT, 'POST', $postvals));

echo($token);

echo("Weak");



?>

</body>
</html>