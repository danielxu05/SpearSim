<?php 
session_start();
#print_r($_SESSION);
include('../class/class.rater.php');
#print_r($_SESSION);
$db = Database::getInstance();
$conn = $db->getConnection(); 

print_r($_POST);
if ($_SESSION['Spear']==1){
	#update status
	$sql = 'UPDATE Spear_Phishing SET Status = 1 WHERE id='.$_SESSION["emailID"];
	#echo $sql;
	$result = $conn->query($sql);
	#insert reuslt 
}
#insert into user Classification
$sql1 = "INSERT INTO UserClassification (PhishID, RaterID, Response,spear_phishing_indicator) VALUES ('".$_SESSION['emailID']."','".$ID."','".$_POST['label1']."','".$_SESSION['Spear']."');";
$result1 = $conn->query($sql1);
#echo $sql1;
header("Location: ./ClassificationTask.php");
#exit;
?>