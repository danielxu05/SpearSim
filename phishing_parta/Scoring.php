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
<?php ini_set("memory_limit","512M"); ?>
<?php
session_start();
$Manipulation = $_SESSION["Manipulation"];
$EmailID = $_SESSION["EmailID"];
$Capital = $_POST["Capital"];
$line = "";
$file = fopen("Config.txt","r");
$temp = 0;
while(! feof($file))
{
    if($temp==0){
        $line = fgets($file);

    }
    $line = $line."+".fgets($file);
    $temp = $temp + 1;
}
fclose($file);
//echo $line;

$pieces = explode("+",$line);
$servername = "localhost";
$username = trim( $pieces[0]);
$password = trim($pieces[1]);
$dbname = trim($pieces[2]);
$Block_Check = 0;
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$_SESSION['UserID'] = $_SESSION['workerId'];
$ID = $_SESSION["UserID"];
$Trial = $_SESSION["Trial"];
$PrevTrial = $Trial - 1;
$sql = "SELECT Subject, Email2 FROM Phishing Where UserID='".$ID."' AND Trial=".$PrevTrial;
$result = $conn->query($sql);
$Email2Text = "";
$Subject2Text = "";
if ($result->num_rows > 0) {
    #echo "We have Results";
    while($row = $result->fetch_assoc()) {
        $Email2Text = $row["Email2"];
        $Subject2Text = $row["Subject"];
    }
} else {
    echo "Something is wrong1. No results";
}

$block = 10;
$block1 = 8;
$Scaling = 0.35;
$location1 = 6;
$ID = $_SESSION["UserID"];
$Trial = $_SESSION["Trial"];

$Gain=0;

$Edit = 0;
$Email1Text = mysqli_real_escape_string($conn, $_POST["email1"]);
$SubjectText = mysqli_real_escape_string($conn, $_POST["Subject"]);
//Levenshtein function: https://en.wikibooks.org/wiki/Algorithm_Implementation/Strings/Levenshtein_distance#PHP
/*function lev($s,$t) {
    $m = strlen($s);
    $n = strlen($t);

    for($i=0;$i<=$m;$i++) $d[$i][0] = $i;
    for($j=0;$j<=$n;$j++) $d[0][$j] = $j;

    for($i=1;$i<=$m;$i++) {
        for($j=1;$j<=$n;$j++) {
            $c = ($s[$i-1] == $t[$j-1])?0:1;
            $d[$i][$j] = min($d[$i-1][$j]+1,$d[$i][$j-1]+1,$d[$i-1][$j-1]+$c);
        }
    }
    return $d[$m][$n];
}*/
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
$Cost= 200;
//$BodyEdit = lev(strip_tags($Email1Text),strip_tags($Email2Text));
//echo $BodyEdit;
$BodyEdit = leven(strip_tags($Email1Text),strip_tags($Email2Text));
//echo "****";
//echo $BodyEdit1;
$SubjectEdit = leven(strip_tags($SubjectText),strip_tags($Subject2Text));
$Edit = $BodyEdit + $SubjectEdit;

if($Edit > 200){
    $Edit = 200;
}

//Cauchy PDF
//$den1 = pow((($Trial%$block)-($location1)),2);
//$den2 = pow($Scaling,2);
//$Denom = ($den1+$den2);
//$pifactor = (1/pi());
//$f = ($pifactor)*($Scaling/$Denom);
$var1 = (($Trial%$block)-$location1);
$f = 0.5 + (atan($var1)/pi());

$rand = mt_rand(1,10000)/10000;

if($_SESSION["EmailID"]>1){//the lottery is not performed in practice trials
if(($Edit > 50) AND ($_SESSION["LotteryPaid"] == 0)){ //if no edits in this trial and if they have not already received the lottery they play lottery

    if($rand < $f){
        $Gain = 2000;
        $_SESSION["LotteryPaid"] = 1;
        //add the insert to insert the lottery trials
        $sql = "UPDATE Participant SET LotteryTrial=".$Trial." WHERE UserID='".$ID."'";
        $result = $conn->query($sql);
        }
    }
}
$TotalGain = $Gain+$Edit;
$Capital = $Capital - $Cost + $Gain + $Edit;

//$serialized_boxes = serialize( $_POST['checkboxes'] );
//$Strategies = $conn->real_escape_string($serialized_boxes);

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

if ($_SESSION["EmailID"]==1 && $Trial==2){
    //copy files to new table
    $sql1 = "INSERT INTO Phishing_Pract SELECT * FROM Phishing WHERE UserID='".$ID."'";
    $result1 = $conn->query($sql1);

    $sql2 = "INSERT INTO Phishing_Pract (UserID, Trial, Cost, Gain, Edit, Manipulation, EmailID, Capital,Subject,Email2,SubjectEdit,BodyEdit)
VALUES ('".$ID."', ".$Trial.", ".$Cost.", ".$Gain.", ".$Edit.", ".$Manipulation.", ".$EmailID.", ".$Capital.", '".$SubjectText."', '".$Email1Text."', ".$SubjectEdit.", ".$BodyEdit.")";
    $result2 = $conn->query($sql2);

    $sql = "DELETE FROM Phishing WHERE UserID='".$ID."'";
    $result = $conn->query($sql);
    $sql = "DELETE FROM AttackStrategy WHERE UserID='".$ID."'";
    $result = $conn->query($sql);
    $Block_Check = 1;
}
else {
    $sql = "INSERT INTO Phishing (UserID, Trial, Cost, Gain, Edit, Manipulation, EmailID, Capital,Subject,Email2,SubjectEdit,BodyEdit)
VALUES ('".$ID."', ".$Trial.", ".$Cost.", ".$Gain.", ".$Edit.", ".$Manipulation.", ".$EmailID.", ".$Capital.", '".$SubjectText."', '".$Email1Text."', ".$SubjectEdit.", ".$BodyEdit.")";
    $result = $conn->query($sql);

    $sql = "INSERT INTO AttackStrategy (UserID, Trial, Deadline, Positive, Negative, Authority, Friend, Interest, Failure, Deal, IllGains, IllMaterial, Opportunity, RHelp, OHelp, Other)
VALUES ('".$ID."', ".$Trial.", ".$ValueString.")";
    $result = $conn->query($sql);

    if($Trial==8){//on the final trial update the values
        $sql1 = "UPDATE Participant SET FinalEarnings=".$Capital." WHERE UserID='".$ID."'";
        $result = $conn->query($sql1);
    }
}
$Button_String1 = "Attack Again";
$Button_String2 = "Done!";
//}
?>
<script type="text/javascript" language="javascript">
    $(document).ready(function(){
        $(window).bind("beforeunload", function(){ return(false); });
    });
    function onsubmitform() {
        $(window).unbind('beforeunload');
        // grab the value of the hidden choice element
        var choice = document.getElementById("BlockCheck").value;
        // Condition check on the choice
        if(choice == 0)
        {
            document.myform.action ="Simulation.php";
        }
        else {
            document.myform.action = "ExperimentBlock1.php";
        }
        return true;
    }
</script>
<body>
<div id="wrapperC" name="wrapperScore" >

    <form name="myform" onsubmit="return onsubmitform();">
        <img src="waiting.gif">
        <h1>Your Result is being Evluating</h1>
        <label id="Instruction0" style="color: Red;font-size:LARGE;font-weight: bold; font-style: italic " ><?php if($_SESSION["Practice"]==1) {echo "(This is a practice trial)";} ?></label>
        <h4>Trial:<?php echo $Trial; ?></h4>
        <h4>You Currently have:<?php echo $Capital; ?></h4>
        <label id="Instruction1" style="color: Red;font-size:Medium;font-weight: bold; font-style: italic " ><?php if($_SESSION["Practice"]==1) {echo "(The above value indicates how much total points you have remaining after this attack)";} ?></label>
        <h4>Cost of the last attack:<?php echo $Cost; ?></h4>
        <label id="Instruction2" style="color: Red;font-size:Medium;font-weight: bold; font-style: italic " ><?php if($_SESSION["Practice"]==1) {echo "(The above value shows the cost of the attack)";} ?></label>
        <h4>You Gained:<?php echo $TotalGain; ?></h4>
        <label id="Instruction3" style="color: Red;font-size:Medium;font-weight: bold; font-style: italic " ><?php if($_SESSION["Practice"]==1) {echo "(The above value shows the total gains you received from the attack)";} ?></label>
        <br><label id="Instruction4" style="color: Green;font-size:Medium;font-weight: bold; font-style: italic" ><?php if($_SESSION["Practice"]==1) {echo "Remember: In a Phishing attack, there are no certainties on rewards from each attack. Be persistent to score big";} ?></label>
        <br />  <br />
        <input type="hidden" name="BlockCheck" id="BlockCheck" value="<?php echo $Block_Check; ?>"/>
        <input type="submit" name="submit" class="btn-style" value="<?php if($Trial==$block1){ echo $Button_String2; } else {echo $Button_String1;} ?>"/>
       <br/> <label id="Instruction4" style="color: Red;font-size:Medium;font-weight: bold; font-style: italic " ><?php if($_SESSION["Practice"]==1) {echo "(Click here to try again)";} ?></label>
        <input type="hidden" name="timeval" id="timeval" value=0 />
    </form>

</div>
</body>

</html>