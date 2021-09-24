<?php 
session_start();
include('../class/class.user.email.php');

$db = Database::getInstance();
$conn = $db->getConnection(); 
$rater = unserialize(serialize($_SESSION['Rater']));
$emailclassification = unserialize(serialize($_SESSION['email']));
$classificationResult = '0';
if ($_SESSION['Spear']==1){
	#update status
	$sql = 'UPDATE Spear_Phishing SET Status = 1 WHERE id='.$_SESSION["emailID"];
	$result = $conn->query($sql);
    #insert reuslt 
    $_SESSION['cSpear']= $_SESSION['cSpear']+1;
    if($_POST['label1']>=3){
        $rater->setEarn($rater->getEarn()+100);
        $classificationResult = '1';
    }
}
if($_SESSION['EmailType']=='0' ){#phishing
    if($_POST['label1']>3){
        $rater->setEarn($rater->getEarn()+100);
        $classificationResult = '1';
    }
}

if($_SESSION['EmailType']=='1'){
    if($_POST['label1']<=3){
        $rater->setEarn($rater->getEarn()+100);
        $classificationResult = '1';
    }
}

if($_SESSION['EmailType']=='2'){
    if(in_array("spam",$output3)){
        $rater->setEarn($rater->getEarn()+100);
        $classificationResult = '1';

    }
}

#insert into user Classification
$output3 = $_POST['label3'];
$emailclassification->setResponse($_POST['label1']);
$emailclassification->setConfidence($_POST['slider1_data']);
$emailclassification->setImportant($_POST['slider2_data']);
$emailclassification->setStarttime($_POST['starttime']);
$emailclassification->setEndtime($_POST['endtime']);
$rater->nextTrial();



$emailclassification->setResult($classificationResult);

if(!empty($output3)) {
    // Loop to store and display values of individual checked checkbox.
    if(in_array("action",$output3)){
        $emailclassification->setAction(1);
    }else{
        $emailclassification->setAction(0);
    }

    if(in_array("information",$output3)){
        $emailclassification->setInformation(1);
    }else{
        $emailclassification->setInformation(0);
    }

    if(in_array("project",$output3)){
        $emailclassification->setProject(1);
    }else{
        $emailclassification->setProject(0);
    }


    if(in_array("meeting",$output3)){
        $emailclassification->setMeeting(1);
    }else{
        $emailclassification->setMeeting(0);
    }

    if(in_array("deadline",$output3)){
        $emailclassification->setDeadline(1);
    }else{
        $emailclassification->setDeadline(0);
    }

    if(in_array("spam",$output3)){
        $emailclassification->setSpam(1);
    }else{
        $emailclassification->setSpam(0);
    }

    if(in_array("other",$output3)){
        $emailclassification->setOther(1);
    }else{
        $emailclassification->setOther(0);
    }
}
$emailclassification->insertDB();
//change the value of json file 
if($emailclassification->getspearIndicator()){
    $nfile = '../user/'.$rater->getGroupID().'.json';
    $arr = file_get_contents($nfile);
    $array = json_decode($arr,true);
    $array['status']= $_POST['label1'];
    $dp = fopen($nfile,'w');
    fwrite($dp,json_encode($array));
    fclose($fp);
}
$selfstatus = $rater->updateTime();
if ($selfstatus){
    $rater->checkActive();
}

$rater->updateTrial();

$_SESSION['Rater'] = $rater;
if ($rater->getTrial() % 4 == 0){
    echo '<script>self.location = "./Image.php";</script>';
}else{
    echo '<script>self.location = "./ClassificationTask.php";</script>';

}
?>