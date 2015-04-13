<?php
$read = fopen($_REQUEST["groupid"] . "-com.txt","r+t");
while(!feof($read)) {
echo fread($read,1024);
}
fclose($read);
?>
