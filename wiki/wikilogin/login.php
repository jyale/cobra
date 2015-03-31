<?php
// get username and password

$user = $_REQUEST['lgname'];
$password = $_REQUEST['lgpassword'];

// get fresh token and cookie
exec("curl -c cookies.txt -d 'lgname=' . $user . '&lgpassword=' . $password . '&action=login&format=xml' http://mahan.webfactional.com/wiki/api.php -o output.xml");

// extract the token and cookie from file
exec("./pylogin.py",$out);

$token = $out[0];
$cookie = $out[1];

setcookie(cryptowiki_session, $cookie, 0, "/", "mahan.webfactional.com", false, false);



echo("weak<br>");
//echo("<br><br>");
//echo exec("cat cookies.txt");
echo("<br><br>");

//echo exec("cat output.xml | grep -E -m 1 -o 'token(.*)\" c' | sed -e 's,.*token=\"\([^<]*\)\" c.*,\1,g';");
var_dump($out);


echo("<br><br>");
echo("code<br>");

?>

<!-- LOGIN FORM -->

<form name = "myform" action="../api.php" method="post">

Action: <input type="text" name="action" value="login"><br>
Name: <input type="text" name="lgname" value="<?php echo $user ?>" ><br>
Password: <input type="text" name="lgpassword" value="<?php echo $password ?>"><br>
Token: <input type="text" name="lgtoken" value="<?echo $token;?>"><br>

<input type="submit">
<!-- AUTO SUBMIT THE FORM -->
<script language="JavaScript">document.myform.submit();</script>

</form>



