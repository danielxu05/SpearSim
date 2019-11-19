<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title></title>
    <link rel="stylesheet" type="text/css" href="Style.css">
    <script src="jquery-3.1.0.min.js"></script>
    <meta charset="UTF-8">
    <meta name="description" content="Attacker EXP">
    <meta name="author" content="Rajivan">
</head>
<?php 
session_start();
ini_set("memory_limit","512M");
include('../class/class.email.php');

var_dump($_POST);
//Setup the DB Connection Info
$db = Database::getInstance();
$conn = $db->getConnection(); 
$email = unserialize(serialize($_SESSION['Email']));
$attacker = unserialize (serialize ($_SESSION['User']));
$email->setEmailCont($_POST['email1']);
$email->setSubject($_POST['Subject']);

$email->setAttackStartTS($_POST['starttime']);
$email->setAttackFinishTS($_POST['endtime']);
$email->setKeyStroke($_POST['keystroke']);

echo "<br>";
$email->insertDB();
echo "<br>Done";


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


$Status =0;

$ValueString = "";
if(!empty($_POST['checkboxes'])) {
    // Loop to store and display values of individual checked checkbox.
    If(in_array("Deadline",$_POST['checkboxes']))
    {$ValueString = $ValueString."1,";}
    else{$ValueString=$ValueString."0,";}

    If(in_array("Positive",$_POST['checkboxes']))
    {$ValueString=$ValueString."1,";}
    else{$ValueString=$ValueString."0,";}

    If(in_array("Negative",$_POST['checkboxes']))
    {$ValueString=$ValueString."1,";}
    else{$ValueString=$ValueString."0,";}

    If(in_array("Authority",$_POST['checkboxes']))
    {$ValueString=$ValueString."1,";}
    else{$ValueString=$ValueString."0,";}

    If(in_array("Friend",$_POST['checkboxes']))
    {$ValueString=$ValueString."1,";}
    else{$ValueString=$ValueString."0,";}

    If(in_array("Interest",$_POST['checkboxes']))
    {$ValueString=$ValueString."1,";}
    else{$ValueString=$ValueString."0,";}

    If(in_array("Failure",$_POST['checkboxes']))
    {$ValueString=$ValueString."1,";}
    else{$ValueString=$ValueString."0,";}

    If(in_array("Deal",$_POST['checkboxes']))
    {$ValueString=$ValueString."1,";}
    else{$ValueString=$ValueString."0,";}

    If(in_array("IllGains",$_POST['checkboxes']))
    {$ValueString=$ValueString."1,";}
    else{$ValueString=$ValueString."0,";}

    If(in_array("IllMaterial",$_POST['checkboxes']))
    {$ValueString=$ValueString."1,";}
    else{$ValueString=$ValueString."0,";}

    If(in_array("Opportunity",$_POST['checkboxes']))
    {$ValueString=$ValueString."1,";}
    else{$ValueString=$ValueString."0,";}

    If(in_array("RHelp",$_POST['checkboxes']))
    {$ValueString=$ValueString."1,";}
    else{$ValueString=$ValueString."0,";}

    If(in_array("OHelp",$_POST['checkboxes']))
    {$ValueString=$ValueString."1,";}
    else{$ValueString=$ValueString."0,";}

    If(in_array("Other",$_POST['checkboxes']))
    {$ValueString=$ValueString."1";}
    else{$ValueString=$ValueString."0";}

}

//echo "Text Similarity:".$sim."<br>";
#echo $Edit."<br>";
//if($_SESSION["EmailID"] > 1){
$Button_String1 = "Attack Again";
$Button_String2 = "Done!";
date_default_timezone_set("America/New_York");
header("Content-Type: text/event-stream");
$counter = rand(1, 10); // a random counter
//}
?>

<body>
<div id="wrapperC" name="wrapperScore" >
    <form name="myform">
        <img src="waiting.gif">
        <h1>Your Result is being Evluating</h1>
        <label id="Instruction0" style="color: Red;font-size:LARGE;font-weight: bold; font-style: italic " ><?php if($attacker->getTrial()==1) {echo "(This is a practice trial)";} ?></label>
        <h4>Trial:<?php echo $attacker->getTrial(); ?></h4>
        <h4>You Currently have:<?php echo "a number to be added"; ?></h4>
        <label id="Instruction1" style="color: Red;font-size:Medium;font-weight: bold; font-style: italic " ><?php if($attacker->getTrial()==1) {echo "(The above value indicates how much total points you have remaining after this attack)";} ?></label>
        <h4>Cost of the last attack:<?php echo $email->getCost(); ?></h4>
        <label id="Instruction2" style="color: Red;font-size:Medium;font-weight: bold; font-style: italic " ><?php if($attacker->getTrial()==1) {echo "(The above value shows the cost of the attack)";} ?></label>
        <h4>You Gained:<?php echo $TotalGain; ?></h4>
        <label id="Instruction3" style="color: Red;font-size:Medium;font-weight: bold; font-style: italic " ><?php if($attacker->getTrial()==1) {echo "(The above value shows the total gains you received from the attack)";} ?></label>
        <br><label id="Instruction4" style="color: Green;font-size:Medium;font-weight: bold; font-style: italic" ><?php if($attacker->getTrial()==1) {echo "Remember: In a Phishing attack, there are no certainties on rewards from each attack. Be persistent to score big";} ?></label>
        <br />  <br />
        <input type="hidden" name="BlockCheck" id="BlockCheck" value="<?php echo $Block_Check; ?>"/>
       <br/> <label id="Instruction4" style="color: Red;font-size:Medium;font-weight: bold; font-style: italic " ><?php if($_SESSION["Practice"]==1) {echo "(Click here to try again)";} ?></label>
        <input type="hidden" name="timeval" id="timeval" value=0 />
    </form>

</div>
</body>

<?php  
while (1) {
// 1 is always true, so repeat the while loop forever (aka event-loop)
    $sql3 = "SELECT * From Spear_Phishing Where UserID ='".$attacker->getUserID()."' and Trial = '".$attacker->getTrial()."'";
    echo $sql3;
    $result3 = $conn->query($sql3);
    if ($result3->num_rows ==0){
        echo "Nothing return";
    }else{
        $row = $result3->fetch_assoc();
        var_dump($row['Status']);
        if($row['Status']==1){
            echo "done, let's go another page";
            echo "Successfully Added <a href='Templete.php'>Click Here to Continue</a>";
            break;
        }
    }
  // flush the output buffer and send echoed messages to the browser
  while (ob_get_level() > 0) {
    ob_end_flush();
  }
  flush();
  // break the loop if the client aborted the connection (closed the page)
  
  if ( connection_aborted() ) break;
  // sleep for 5 second before running the loop again
  sleep(5);
}
?>
</html>