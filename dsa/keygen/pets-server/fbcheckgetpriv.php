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
<?php include("../../../header.html");
?>

  <div class="container">

      <!-- Example row of columns -->
      <div class="row">
                <div class="span8">




		<div class=crypto-book-keys>
			<span id=keys hidden>
<?php
$token = $_GET["token"];


$data = file_get_contents("https://graph.facebook.com/app/?access_token=" . $token);
$array = json_decode($data, true);

if($array['name']=="Crypto-Bk"){

$pubs = json_decode(file_get_contents("http://mahan.webfactional.com/cobra2/dsa/keygen/pets-server/getpub.php"), true)['pubs'];
/*
$pubs[1] = file_get_contents("http://mahan.webfactional.com/dsa/keygen/pets-server/getpub.php?id=christinehong802");
$pubs[2] = file_get_contents("http://mahan.webfactional.com/dsa/keygen/pets-server/getpub.php?id=danny.jackowitz");
$pubs[3] = file_get_contents("http://mahan.webfactional.com/dsa/keygen/pets-server/getpub.php?id=davidiw");
$pubs[4] = file_get_contents("http://mahan.webfactional.com/dsa/keygen/pets-server/getpub.php?id=ennan.zhai");
$pubs[5] = file_get_contents("http://mahan.webfactional.com/dsa/keygen/pets-server/getpub.php?id=esyta");
$pubs[6] = file_get_contents("http://mahan.webfactional.com/dsa/keygen/pets-server/getpub.php?id=han.ma.39589");
$pubs[7] = file_get_contents("http://mahan.webfactional.com/dsa/keygen/pets-server/getpub.php?id=lining.wang");
$pubs[8] = file_get_contents("http://mahan.webfactional.com/dsa/keygen/pets-server/getpub.php?id=seth.lifland");
$pubs[9] = file_get_contents("http://mahan.webfactional.com/dsa/keygen/pets-server/getpub.php?id=weiyi.wu.319");
*/

$Data = array('name' => 'Dedis group', 'x' => (file_get_contents("http://mahan.webfactional.com/cobra2/dsa/keygen/pets-server/fbgetpriv.php?id=" . $token)), 'L' => $pubs);
	echo json_encode($Data);

}else{
	die("Invalid token");
}
?>
			</span>
			<span><h2>Crypto-Book keys for: Dedis group</h2></span></br>
			<button class="btn btn-success btn-large" type=button id=save>Save Keys</button>
		</div>
		<div id="info">
			<h3>What's actually happening?</h3>
			We've pre-configured a set of Facebook identities for members
			of DeDiS. When you visit this page, you fetch the public keys
			for these identities from the Crypto-Book key servers - anybody
			can retrieve these keys.
			In order to produce a linkable ring signature, you also need
			your own private key. The key servers will only return your
			private key to you after verifying your federated identity with
			Facebook.
			When you click "Save Keys" the Chrome extension intercepts the
			event and stores the set of keys in your browser's local storage.
		</div>

		<h3>Sign in to the DeDiS bulletin board.</h3>
		<form class='crypto-book-signin' action='verify.php'>
			<div hidden>
				<span id='challenge'>challenge</span>
				<input type='text' id='c0' name='c0'>
				<input type='text' id='s' name='s'>
				<input type='text' id='tag' name='tag'>
				<input hidden type='text' id='start' name='start'>
				<input hidden type='text' id='end' name='end'>
			</div>
			<input class="btn btn-warning btn-large" type='button' id='signin' value='DeDiS Anonymous Bulletin Board &raquo'>
		</form>

		<div id=info>
			<h3>What's actually happening?</h3>
			Here you get to use the keys you saved before to authenticate
			as some member of the DeDiS group. This page includes a special
			Crypto-Book signin widget that the extension recognizes. When
			you click the button, the extension intercepts the event and
			does some magic:
			<ul>
				<li>Loads your Crypto-Book keys from the browser local
					storage.</li>
				<li>Produces a linkable ring signature on a challenge
					message hidden in the widget, using these keys.</li>
				<li>Populates another hidden field with the resulting
					signature (use DevTools to make these fields
					visible if you're curious about the details).</li>
				<li>Finally, submits the form as normal.</li>
		</div>
</div>
</div>
<br>
<br>
<?php include("../../../footer.html");
?>

</div>


	</body>
</html>
