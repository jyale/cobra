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
Create chat group</h1>
<b>
List Facebook IDs one per line in box below for the people you want in the group.
</b>


<form action="creategroup.php" method="POST">
    <label> Post: <br><textarea cols="40" rows="15" name="field1" autofocus>
<?php
$homepage = file_get_contents('groups/221288');
echo $homepage;
?>

</textarea></label><br>

<p>
    <label><b>Group name</b></label>
The name for your group.
</p>
<input type="text" name="groupname" value="DeDiS Group">


    <input type="submit" name="submit" value="Create Group">
</form>


<p>


<?php
if(isset($_POST['field1'])) {
    $data = $_POST['field1'];
    $groupname = $_POST['groupname'];

$dataarr = preg_split("/[\r\n,]+/", $data, -1, PREG_SPLIT_NO_EMPTY);

sort($dataarr);
$data = implode("\n", $dataarr);

    $groupid = 'groups/' . substr(hash('sha1', $data),0,6);

    //unlink($groupid);
    $ret = true;
    $newgroup = false;

    // create file only if the group has not already been created
    if(!file_exists($groupid)){
	$newgroup = true;
	$ret = file_put_contents($groupid, rtrim($data), LOCK_EX);
    	// save file contents
    	file_put_contents($groupid . "-name", rtrim($groupname), LOCK_EX);
    }

    if($ret === false) {
        die('There was an error creating the group (writing the group facebook ids file)');
    }
    else {
	if($newgroup){
		echo "Group created! <a href='http://mahan.webfactional.com/cobra2/dsa/keygen/pets-login.php?groupid=$groupid'>Log in here!!!!</a>";
	}else{
		echo "Group already exists [" . file_get_contents($groupid . "-name") . "]! <a href='http://mahan.webfactional.com/cobra2/dsa/keygen/pets-login.php?groupid=$groupid'>Log in here!!!!</a>";
	}
    }
}
else {
   echo('No POST data to process');
}
?>

<br><br>
<h1>Existing Groups</h1>
<br>

                <form class='crypto-book-signin' action='verify.php' >
                        <div hidden>
                                <span id='challenge'>challenge</span>
                                <input type='text' id='c0' name='c0'>
                                <input type='text' id='s' name='s'>
                                <input type='text' id='tag' name='tag'>
                                <input type='text' id='start' name='start'>
                                <input type='text' id='end' name='end'>
                                <input type='text' id='groupid' name='groupid'>
                        </div>
<?php

// list all the available groups
$groups = scandir('/home/mahan/webapps/cobra2/dsa/keygen/pets-server/groups');
foreach($groups as $result) {
    if (strpos($result, 'com.txt') == FALSE){
	if (strlen($result) == 6){
		// echo a button instead of the link. The "id" of the button is the group id ($result). The "class" of the button
		// is
		echo "<input data-href='http://mahan.webfactional.com/cobra2/dsa/keygen/pets-login.php?groupid=groups/$result' class='btn btn-warning btn-large crypto-book-signin-btn' type='button' id='$result' value='" . file_get_contents("groups/" . $result . "-name") .  "&raquo'>";
echo "<br><br>";
//		echo "<a href='http://mahan.webfactional.com/cobra2/dsa/keygen/pets-login.php?groupid=groups/$result'>";
//		echo file_get_contents("groups/" . $result . "-name");
//		echo "</a><br>";
		

	}    
    }

}
?>

</form>

</p>
</div></div>

<br><br>

<?php
include("../../../footer.html");
?>

</body>

</html>

