<?php
include '../class/class.email.php';
session_start();
$attacker = unserialize (serialize ($_SESSION['User']));
$nfile = '../user/'.$attacker->getGroupID().'.json';
$jsonvalue = json_decode(file_get_contents($nfile), true);
$phishingresult = $jsonvalue['status'];
$attacker->nextTrial();
if ($phishingresult>0 && $phishingresult<=2){
    $attacker->setEarn($attacker->getEarn()+1000);
}
$_SESSION['User'] = $attacker;
echo "<script type='text/javascript'>window.top.location='Simulation.php';</script>";
?>



