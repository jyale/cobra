<?php
$tokenA = $_GET["tokena"];

$tokenB = $_GET["tokenb"];

$tokenC = $_GET["tokenc"];


// get priv key part from server 0
$key0 = file_get_contents("http://mahan.webfactional.com/dsa/keygen/server0/fbcheckgetpriv.php?token=" . $tokenA);
// get priv key part from server 1
$key1 = file_get_contents("http://mahan.webfactional.com/dsa/keygen/server1/fbcheckgetpriv.php?token=" . $tokenB);
// get priv key part from server 2
$key2 = file_get_contents("http://mahan.webfactional.com/dsa/keygen/server2/fbcheckgetpriv.php?token=" . $tokenC);

/*
echo($key0);
echo("<br><br>");
echo($key1);
echo("<br><br>");

echo($key2);
*/

echo("x (private key) = ");
echo("<br>");
echo(exec("python2.7 privcombiner.py " . $key0 . " " . $key1 . " " . $key2));
echo("<br><br>");
echo("y (public key) = ");
echo("<br>");
echo(exec("python2.7 pubcombiner.py " . $key0 . " " . $key1 . " " . $key2));
echo("<br><br>");
echo("p = 89884656743115795664792711940796176851119970086295094525916939279014416884510410227155912705490141517040349493104350713250894752209598792377036705329921777150659847842412101813159134527960689713473746097408990841229149478637132788373696814456297458600531763096786958922891028326530110554624621072800084070961");
echo("<br><br>");
echo("q = 941506596250216984203090146520333547538244481697");
echo("<br><br>");
echo("g = 34602665038470649139675399213351821394778342143927940407384555720280713734040263824622508144389505207857155089278564186198863137963701380287457519992520537429937507501716393531967183791615285710169926131958833245212562988126415401503359363244583486448835867790065950788495491077021769975019105890787102335681
");
echo("<br><br>");



?>
