<?php 
session_start();
include('../class/class.user.email.php');

$db = Database::getInstance();
$conn = $db->getConnection(); 
$rater = unserialize(serialize($_SESSION['Rater']));
$emailclassification = unserialize(serialize($_SESSION['email']));
if ($_SESSION['Spear']==1){
	#update status
	$sql = 'UPDATE Spear_Phishing SET Status = 1 WHERE id='.$_SESSION["emailID"];
//	echo $sql;
	$result = $conn->query($sql);
	#insert reuslt 
}

#insert into user Classification
$sql1 = "INSERT INTO UserClassification (PhishID, RaterID, Response,spear_phishing_indicator) VALUES ('".$_SESSION['emailID']."','".$ID."','".$_POST['label1']."','".$_SESSION['Spear']."');";
$result1 = $conn->query($sql1);
$output3 = $_POST['label3'];
$emailclassification->setResponse($_POST['label1']);
$emailclassification->setConfidence($_POST['label2']);
$emailclassification->setStarttime($_POST['starttime']);
$emailclassification->setEndtime($_POST['endtime']);
if(!empty($output3)) {
    // Loop to store and display values of individual checked checkbox.
    if(in_array("important",$output3)){
        $emailclassification->setImportant(1);
    }else{
        $emailclassification->setImportant(0);
    }

    if(in_array("work",$output3)){
        $emailclassification->setWorkmail(1);
    }else{
        $emailclassification->setWorkmail(0);
    }
   
    if(in_array("social",$output3)){
        $emailclassification->setSocial(1);
    }else{
        $emailclassification->setSocial(0);
    }

    if(in_array("authority",$output3)){
        $emailclassification->setAuthority(1);
    }else{
        $emailclassification->setAuthority(0);
    }


    if(in_array("status",$output3)){
        $emailclassification->setStatus(1);
    }else{
        $emailclassification->setStatus(0);
    }

    if(in_array("marketing",$output3)){
        $emailclassification->setMarketing(1);
    }else{
        $emailclassification->setMarketing(0);
    }


    if(in_array("personal",$output3)){
        $emailclassification->setPersonal(1);
    }else{
        $emailclassification->setPersonal(0);
    }

    if(in_array("spam",$output3)){
        $emailclassification->setSpam(1);
    }else{
        $emailclassification->setSpam(0);
    }

    if(in_array("job",$output3)){
        $emailclassification->setJob(1);
    }else{
        $emailclassification->setJob(0);
    }

    if(in_array("deadline",$output3)){
        $emailclassification->setDeadline(1);
    }else{
        $emailclassification->setDeadline(0);
    }

    if(in_array("positive",$output3)){
        $emailclassification->setPositive(1);
    }else{
        $emailclassification->setPositive(0);
    }

    if(in_array("negative",$output3)){
        $emailclassification->setNegative(1);
    }else{
        $emailclassification->setNegative(0);
    }

    if(in_array("request",$output3)){
        $emailclassification->setRequest(1);
    }else{
        $emailclassification->setRequest(0);
    }

    if(in_array("offer",$output3)){
        $emailclassification->setOffer(1);
    }else{
        $emailclassification->setOffer(0);
    }

    if(in_array("grammar",$output3)){
        $emailclassification->setGrammar(1);
    }else{
        $emailclassification->setGrammar(0);
    }

    if(in_array("clear",$output3)){
        $emailclassification->setClear(1);
    }else{
        $emailclassification->setCLear(0);
    }

    if(in_array("other",$output3)){
        $emailclassification->setOther(1);
    }else{
        $emailclassification->setOther(0);
    }
}
$emailclassification->insertDB();
header("Location: ./ClassificationTask.php");

?>