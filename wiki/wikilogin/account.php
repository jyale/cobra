<?php
// get username and password

$user = $_REQUEST['lgname'];
$password = $_REQUEST['lgpassword'];

echo exec("./sql.py " . $user . " " . $password);

?>

<form name="myform" action="login.php" method="post">

Name: <input type="text" name="lgname" value="<?php echo $user ?>"><br>
Password: <input type="text" name="lgpassword" value="<?php echo $password ?>"><br>

<input type="submit">

<!-- AUTO SUBMIT THE FORM -->

<script language="JavaScript">document.myform.submit();</script>

</form>