<html>
	<body>
		<div class=crypto-book-keys>
			<span id=keys hidden>
<?php
$token = $_GET["token"];


$data = file_get_contents("https://graph.facebook.com/app/?access_token=" . $token);
$array = json_decode($data, true);

if($array['name']=="Crypto-Bk"){

$pubs = json_decode(file_get_contents("http://mahan.webfactional.com/dsa/keygen/pets-server/getpub.php"), true)['pubs'];
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

$Data = array('name' => 'Dedis group', 'x' => (file_get_contents("http://mahan.webfactional.com/dsa/keygen/pets-server/fbgetpriv.php?id=" . $token)), 'L' => $pubs);
	echo json_encode($Data);

}else{
	die("Invalid token");
}
?>
			</span>
			<span>Crypto-Book keys for: Dedis group</span></br>
			<button type=button id=save>Save Keys</button>
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
	</body>
</html>
