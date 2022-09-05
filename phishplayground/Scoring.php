<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Score</title>
    <link rel="stylesheet" type="text/css" href="Style.css">
    <script src="jquery-3.1.0.min.js"></script>
    <meta charset="UTF-8">
    <meta name="description" content="Attacker EXP">
</head>
<?php 
session_start();
ini_set("memory_limit","512M");
include('../class/class.email.php');
//Setup the DB Connection Info
$db = Database::getInstance();
$conn = $db->getConnection(); 
$email = unserialize(serialize($_SESSION['Email']));
$attacker = unserialize (serialize ($_SESSION['User']));
$email1=$_POST['email1'];
$Subject = $_POST['Subject'];
$email->setEmailCont($email1);
$email->setSubject($Subject);
$email->setProfileTS($_POST['q0']);
$email->setAttackStartTS($_POST['q1']);
$email->setAttackFinishTS($_POST['q2']);
$email->setLoadTS($_POST['loadtime']);
$email->setSubmitTS($_POST['submittime']);
$email->setKeyStroke($_POST['keystroke']);
$email->setCost(100);
$email->setImpersonation($_POST['impersonation']);
$email->setTone($_POST['tone']);
$email->setGoal($_SESSION['Goal']);
$email->setTemplete($_SESSION['Templete']);
function leven($s1,$s2){
    $l1 = strlen($s1);                    // Länge des $s1 Strings
    $l2 = strlen($s2);                    // Länge des $s2 Strings
    $dis = range(0,$l2);                  // Erste Zeile mit (0,1,2,...,n) erzeugen
    // $dis stellt die vorrangeganene Zeile da.
    for($x=1;$x<=$l1;$x++){
        $dis_new[0]=$x;               // Das erste element der darauffolgenden Zeile ist $x, $dis_new ist damit die aktuelle Zeile mit der gearbeitet wird
        for($y=1;$y<=$l2;$y++){
            $c = ($s1[$x-1] == $s2[$y-1])?0:1;
            $dis_new[$y] = min($dis[$y]+1,$dis_new[$y-1]+1,$dis[$y-1]+$c);
        }
        $dis = $dis_new;
    }
    return $dis[$l2];
}

if ((($attacker->getTrial()-2)%3!=0)){
    $previousEmail = $email->getTrialCont($attacker->getTrial()-1)->fetch_assoc();
    $subjectleven = leven($previousEmail['Subject'],$Subject);
    $emailleven = leven($previousEmail['EmailCont'],$email1);
    if($subjectleven+$emailleven>150){
        $editearn = 150;
    }else{
        $editearn = $subjectleven+$emailleven;
    }
}else{
$subjectleven=0;
$emailleven=0;
}
//Easy fix with edit earn
$editearn=0;

$_SESSION['editearn'] = $editearn;
$email->setSelf_eval($_POST['slider1_data']);
$email->setSubjectEdit($subjectleven);
$email->setBodyEdit($emailleven);
$email->setNumEdit($_POST['numtyping']);
if(!empty($_POST['checkboxes'])) {
    // Loop to store and display values of individual checked checkbox.
    if(in_array("Offer",$_POST['checkboxes'])){
        $email->setOffer(1);
    }else{
        $email->setOffer(0);
    }

    if(in_array("Followup",$_POST['checkboxes'])){
        $email->setFollowup(1);
    }else{
        $email->setFollowup(0);
    }

    if(in_array("Threaten",$_POST['checkboxes'])){
        $email->setThreaten(1);
    }else{
        $email->setThreaten(0);
    }

    if(in_array("Failure",$_POST['checkboxes'])){
        $email->setFailure(1);
    }else{
        $email->setFailure(0);
    }

    if(in_array("Authority",$_POST['checkboxes'])){
        $email->setAuthority(1);
    }else{
        $email->setAuthority(0);
    }

    if(in_array("Peers",$_POST['checkboxes'])){
        $email->setPeers(1);
    }else{
        $email->setPeers(0);
    }

    if(in_array("Time",$_POST['checkboxes'])){
        $email->setTime(1);
    }else{
        $email->setTime(0);
    }

    if(in_array("Pretend",$_POST['checkboxes'])){
        $email->setPretend(1);
    }else{
        $email->setPretend(0);
    }

    if(in_array("Interest",$_POST['checkboxes'])){
        $email->setInterest(1);
    }else{
        $email->setInterest(0);
    }

    if(in_array("Other",$_POST['checkboxes'])){
        $email->setOther(1);
    }else{
        $email->setOther(0);
    }
}


if(!empty($_POST['checkboxes1'])) {
    // Loop to store and display values of individual checked checkbox.
    if(in_array("Personal",$_POST['checkboxes1'])){
        $email->setPersonal_(1);
    }else{
        $email->setPersonal_(0);
    }

    if(in_array("Professional",$_POST['checkboxes1'])){
        $email->setProfessional_(1);
    }else{
        $email->setProfessional_(0);
    }

    if(in_array("Family",$_POST['checkboxes1'])){
        $email->setFamily_(1);
    }else{
        $email->setFamily_(0);
    }

    if(in_array("Interest",$_POST['checkboxes1'])){
        $email->setInterest_(1);
    }else{
        $email->setInterest_(0);
    }

    if(in_array("None",$_POST['checkboxes1'])){
        $email->setUser_info(1);
    }else{
        $email->setUser_info(0);
    }
}

$email->insertDB();



$datatoJson = array('TargetID'=>$email->getTargetID(),'status'=>-1);
$nfile = '../user/'.$attacker->getGroupID().'.json';
$dp = fopen($nfile,'w');
fwrite($dp,json_encode($datatoJson));
fclose($dp);
$_SESSION['User']=$attacker;
$_SESSION['phishingresult']=$_POST['phishingresult'];


#$selfstatus = $attacker->updateTime();
#if ($selfstatus){
#    $attacker->checkActive();
#}


//}
?>
<body>
<div name="wrapperC" id = 'wrapper'>
    <form name="myform" action="processing.php">
    <div id = 'waitingsection' name = 'waitingsection'>
    <h1>We are waiting for a response from your target</h1>
    <img src="waiting.gif" id = 'image' width="100" height="100">
    <p> Please wait for the response from your target... it may take a few minutes...</p>
    <p> Do not refresh!</p>

    </div>

    <label id="Instruction0" style="color: Red;font-size:LARGE;font-weight: bold; font-style: italic " ><?php if($attacker->getTrial()==1) {echo "(This is a practice trial)";} ?></label>

        <h4>Trial:<?php echo $attacker->getTrial(); ?></h4>
        <div name="result" id = "result" style="center;display:none;color: Red;font-size:LARGE;font-weight: bold; font-style: italic ">

        <label id="resultscore" value = "Practice"></label>
        <h4>You Gained: <label id = 'Gain'> points</h4>
        <label id="Instruction3" style="color: Green;font-size:Medium;font-weight: bold; font-style: italic " ><?php if($attacker->getTrial()==1) {echo "(The above value shows the total gains you received from the attack)";} ?></label>

        <h4>You Currently have: <label id = 'Earn'><?php echo $attacker->getEarn();?></h4>
        <label id="Instruction1" style="color: Green;font-size:Medium;font-weight: bold; font-style: italic " ><?php if($attacker->getTrial()==1) {echo "(The above value indicates how much total points you have remaining after this attack)";} ?></label>
            <div id = 'game_start' name = 'game_start' style = 'display:none;'>
                <h4> Practice complete.</h4>
                <h4>You are now about to begin the experiment.</h4>
            </div>
            <br>
            <input type="submit" class="btn-style" name="submit" value="Continue"/>
            
        </div>

        <br><label id="Instruction4" style="color: Green;font-size:Medium;font-weight: bold; font-style: italic" ><?php if($attacker->getTrial()==1 or $attacker->getTrial()==2) {echo "Remember: In a Phishing attack, there are no certainties on rewards from each attack. Be persistent to score big";} ?></label>
        <br />  <br />

        <input type="hidden" name="timeval" id="timeval" value=0 />
        
    </form>
</div>
<script>
    (function (global) {

if(typeof (global) === "undefined")
{
    throw new Error("window is undefined");
}

var _hash = "!";
var noBackPlease = function () {
    global.location.href += "#";

    // making sure we have the fruit available for juice....
    // 50 milliseconds for just once do not cost much (^__^)
    global.setTimeout(function () {
        global.location.href += "!";
    }, 50);
};

// Earlier we had setInerval here....
global.onhashchange = function () {
    if (global.location.hash !== _hash) {
        global.location.hash = _hash;
    }
};

global.onload = function () {
    noBackPlease();
};

})(window);
</script>

<script type = "text/javascript">
var nfile = '<?php echo($nfile);?>';
var attackerid = '<?php echo($attacker->getUserID());?>';
var trial = <?php echo($attacker->getTrial());?>;
var capital = <?php echo($attacker->getEarn());?>;
if (trial<=1){    
    setTimeout(function () {
        $("#image").hide()
        $("#result").show()
        $("#waitingsection").hide();
        $("#game_start").show()
        
    }, 5000);
}else{
    setTimeout(function(){
        $("#image").hide()
        $("#result").show()
        $("#waitingsection").hide();
    },1000*420); //ten minutes max waiting
}
//called from script.js after gaining the result
</script>
<script src = './script.js?newversion'></script>

</html>