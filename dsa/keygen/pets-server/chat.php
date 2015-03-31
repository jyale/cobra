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
  </head>


<body>

<?php
include("../../../header.html");
?>

    <div class="container">

      <!-- Example row of columns -->
      <div class="row">
                <div class="span8">


<h1>
Dedis anonymous comment board
</h1>
<b>Write your comment below to post to the anonymous comment board below.</b>

<form action="" method="post">

<label><input type="hidden" name="name" value="<?php echo $_REQUEST["name"];?>" hidden></label>
<label><input type="hidden" name="color" value="<?php echo $_REQUEST["color"];?>" hidden></label>

<!--
<label> Message: <br><textarea cols="35" rows="5" name="mes"></textarea></label><br>
-->
<label> Comment: <br><input type="text" name="mes" autofocus></label><br>

<input class="btn btn-danger btn-large" type="submit" name="post" value="Post">


</form>

<p>

<?php

$name = $_POST["name"];
$text = $_POST["mes"];
$post = $_POST["post"];
$hexcolor = $_REQUEST["color"];

if(strlen($name)<2){
#echo('<meta http-equiv="Location" content="http://example.com/">');

echo('<meta http-equiv="refresh" content="0; url=http://auvernet.org/denied/cat_not_amused.jpg" />');
}

if($post){

#Write down comments#

#append to start of file
$file_data = "<font color='#" . $hexcolor . "'<b>$name</b></font> $text<br>";
$file_data .= file_get_contents('com.txt');
file_put_contents('com.txt', $file_data);

}

#Display comments#

$read = fopen("com.txt","r+t");
echo "<h2>All comments from Dedis group</h2><br><b>Colored word is anonymous username, text next to it is the message</b><br><br>";

while(!feof($read)){
echo fread($read,1024);
}

fclose($read);


?>

</p>
</div></div>

<br><br>

<?php
include("../../../footer.html");
?>

</body>

</html>

