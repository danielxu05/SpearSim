<?php
session_start();
include '../class/class.rater.php';
$rater = unserialize(serialize($_SESSION['Rater']));
$db = Database::getInstance();
$conn = $db->getConnection(); 
$sql = "Select * from stimuli where number='".$_SESSION['imageid']."';";
$data = $conn->query($sql)->fetch_assoc();
var_dump($_POST);
if($data[$_SESSION['refid']]==$_POST['estimation']){
    $rater->setEarn($rater->getEarn()+100);
    $validation = '1';
}else{
    $validation = '0';
}
$sql1 = "INSERT INTO `imageclassification`(`UserID`, `StartTS`, `EndTS`, `Answer`, `Validation`) VALUES ('" .$rater->getUserID()."','". $_POST['loadtime']."','".$_POST['submittime']."','".$_POST['estimation']."','".$validation."');";
echo($sql1);
$conn->query($sql1);
$rater->nextTrial();
$_SESSION['Rater']=$rater;
$rater->checkActive();
header('Location:ClassificationTask.php')

?>
