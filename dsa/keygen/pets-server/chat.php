<html>

 <head>
    <meta charset="utf-8">
    <title>Crypto-Book</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="../../../assets/css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
      body {
	padding-top: 60px;
        padding-bottom: 40px;
      }
    </style>
    <link href="../../../assets/css/bootstrap-responsive.css" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="assets/js/html5shiv.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
      <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
                    <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">
                                   <link rel="shortcut icon" href="assets/ico/favicon.png">

	<script type="text/javascript">
		var update = function() {
			xmlHttp = new XMLHttpRequest();
			xmlHttp.onreadystatechange = function() {
				if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
					document.getElementById("com").innerHTML = xmlHttp.responseText;
				}
			}
			xmlHttp.open("GET", "comments.php?groupid=<?php echo $_REQUEST['groupid']; ?>", true);
			xmlHttp.send();
		};
		window.onload = function(e) {
			update();
			setInterval(update, 1000);
		}
	</script>
  </head>


<body>

<?php
include("../../../header.html");
?>

    <div class="container">

      <!-- Example row of columns -->
      <div class="row">
                <div class="span8">

<?php

$name = $_POST["name"];
$text = $_POST["mes"];
$post = $_POST["post"];
$hexcolor = $_REQUEST["color"];
?>

<h1>
<font color="red"><?php echo(file_get_contents($_REQUEST["groupid"] . "-name")); ?></font> anonymous comment board
</h1>
<b>Write your comment below to post to the anonymous comment board below.</b>
<br><br>
<b>You are logged in as: <?php echo("<font color='#" . $hexcolor . "'<b>$name</b></font>")?></b>

<br><br>
<form action="" method="post">

<label><input type="hidden" name="name" value="<?php echo $_REQUEST["name"];?>" hidden></label>
<label><input type="hidden" name="groupid" value="<?php echo $_REQUEST["groupid"];?>" hidden></label>
<label><input type="hidden" name="color" value="<?php echo $_REQUEST["color"];?>" hidden></label>

<!--
<label> Post: <br><textarea cols="35" rows="5" name="mes" autofocus></textarea></label><br>
-->
<label> Post: <br><input type="text" name="mes" autofocus></label><br>

<input class="btn btn-danger btn-large" type="submit" name="post" value="Post">


</form>

<p>

<?php

if(strlen($name)<2){
#echo('<meta http-equiv="Location" content="http://example.com/">');

echo('<meta http-equiv="refresh" content="0; url=http://mahan.webfactional.com/cobra2/dsa/keygen/pets-server/creategroup.php" />');
}

if($post){

#Write down comments#

#append to start of file
$name = trim($name);
$file_data = "<font color='#" . $hexcolor . "'<b>$name</b></font> $text<br>\n";

if(!file_exists($_REQUEST["groupid"] . '-com.txt')) 
{ 
   $fp = fopen($_REQUEST["groupid"] . '-com.txt',"w");  
   fwrite($fp,"0");  
   fclose($fp); 
}  

$file_data .= file_get_contents($_REQUEST["groupid"] . '-com.txt');
file_put_contents($_REQUEST["groupid"] . '-com.txt', $file_data);

}

#Display comments#
echo "<h2>All comments</h2><br><b>Colored word is anonymous username, text next to it is the message</b><br><br>";
?>
<div id="com"></div>
</p>
</div></div>

<h2>Shareable Link</h2>
<p>
Use this link to share this chat group with other members of the group.
</p>

<input type="text" name="link" value="http://cryptobook.ninja/cobra2/dsa/keygen/pets-login.php?groupid=<?php echo($_REQUEST["groupid"]); ?>" size="200" readonly>

<br><br>

<?php
include("../../../footer.html");
?>

</body>

</html>

