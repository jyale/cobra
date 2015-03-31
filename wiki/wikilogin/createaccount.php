<?php

// get username and password

$user = $_REQUEST['lgname'];
$password = $_REQUEST['lgpassword'];

?>

Create account
<br><br>

<form action="account.php" method="post">

Name: <input type="text" name="lgname" value="<?php echo $user ?>"><br>
Password: <input type="text" name="lgpassword" value="<?php echo $password ?>"><br>

<input type="submit">
</form>