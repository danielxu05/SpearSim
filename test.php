<?php
echo('test');

include "./class/class.attacker.php";
$attacker = new Attacker('wowwww');
echo('hello');
$attacker->setmturkcredential();
var_dump($attacker);
$attacker->insertDB();
?>
