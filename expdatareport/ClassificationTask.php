<?php session_start(); ?>
<html>
<head>
    <link href="Style.css" rel="stylesheet">
    <script src="jquery-3.1.0.min.js"></script>
</head>
<style type="text/css">
div.a {
  font-size: 15px;
}
</style>
<body>
    <script type="text/javascript" src="ckeditor/ckeditor.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $(window).bind("beforeunload", function(){ return(false); });
            var d = new Date();
            document.myForm.starttime.value = d.getTime();
        });
        function onsubmitform() {
            $(window).unbind('beforeunload');
            var d = new Date();
            document.myForm.endtime.value = d.getTime();
        }
    </script>
        
<?php
include('../class/class.rater.php');
$rater = unserialize(serialize($_SESSION['Rater']));
var_dump($rater);
$db = Database::getInstance();
$conn = $db->getConnection(); 

echo "<br>";

var_dump($rater->getTargetAttackerID());
$sql3 = "SELECT * FROM Spear_Phishing 
        WHERE `UserID` = '".$rater->getTargetAttackerID()."' and Status =0
        ORDER BY AttackFinishTS";
echo $sql3;
echo "<Br>";
$result3 = $conn->query($sql3);
echo "<Br>";
if ($result3->num_rows > 0) {
    // output data of each row
    $row = $result3->fetch_assoc();
    echo "Spear";
    $_SESSION['Spear'] = 1;
} elseif ($result3->num_rows==0){
    //get the email list from the row
    $EmailIDs = $rater->getEmailList();

    var_dump($EmailIDs);
    $sql2 = "SELECT * from EmailPool WHERE id IN (".implode(',',$EmailIDs).") AND id NOT in 
    (SELECT PhishID FROM UserClassification WHERE RaterID = '".$rater->getUserID()."' and spear_phishing_indicator = 0);";
    echo $sql2;
    #ORDER BY RAND();
    var_dump(implode(',',$EmailIDs));
    echo "<Br>";
    $result2 = $conn->query($sql2);
    if($result2->num_rows>0) {
        $row = $result2->fetch_assoc();
        $_SESSION['Spear']=0;
        echo $row['id'];
        echo "Non-Spear";
    }else {
        echo "No result is return";
    }
}
#var_dump($row);
$_SESSION['emailID'] = $row['id'];
echo "<label name=\"Subjectline\" id=\"Subjectline\" style=\"font-size:medium;font-weight: bold\">Subject:</label> <input type=\"text\" name=\"Subject\" id=\"Subject\" style=\"width: 500px; border-style: solid; border-width: medium\" value=\"".$row['Subject']."\" readonly>";
echo "<br>";
echo "<textarea name=\"email".$i."\" id=\"email".$i."\" rows=\"40\" cols=\"130\" disabled>";
echo $row['EmailCont'];
echo "</textarea>";
echo "<script type=\"text/javascript\">";
    echo "CKEDITOR.replace('email".$i."');";
echo "</script>";
echo "<br>";
#Email Classification Label; 
echo $emailID;
?>
<form name="myForm" method="post" action="insert.php" onsubmit="return onsubmitform();">
<h1>Email Classification Console</h1>
<input type="hidden" id="starttime" name="starttime" value="">
<input type="hidden" name="endtime" value="">
<h3>How would you manage this e-mail?</h3>
<label style= font-size: 16px;><input type="radio" id=1 name=label1 value=1 >Respond immediately</label> <br>
<label style= font-size: 16px;><input type="radio" id=1 name=label1 value=2 >Leave the email in the inbox and flag for follow up</label> <br>
<label style= font-size: 16px;><input type="radio" id=1 name=label1 value=3 >leave the email in the inbox</label> <br>
<label style= font-size: 16px;><input type="radio" id=1 name=label1 value=4 >Delete the email</label> <br>
<label style= font-size: 16px;><input type="radio" id=1 name=label1 value=5 >Delete the email and block the sender</label> <br>

<h3>Rate how confident you are with your recommendation</h3>
<label style=font-size: 16px;>No Confidence</label>
 <input type=range name='label2' min='0' max='100' value='50' step='1' style=width: 600px;>&nbsp <label style=font-size: 16px;>High Confidence</label><br>
<br><span style='margin-left: 270px'>Moderate Confidence</span><br>
<label style=font-size: 16px;><input type=radio id=2 name=label2 value=1 >No Confidence</label> <br>
<label style=font-size: 16px;><input type=radio id=2 name=label2 value=2 >Slight Confidence</label> <br>
<label style=font-size: 16px;><input type=radio id=2 name=label2 value=3 >Moderate Confidence</label> <br>
<label style=font-size: 16px;><input type=radio id=2 name=label2 value=4 >High Confidence</label> <br>

<h3>Select all applicable aspects of this email that influenced your decision</h3>
<label style=font-size: 16px;><input type=checkbox id=3 name=label3 value="important" >Reads like an important message</label><br>
<label style=font-size: 16px;><input type=checkbox id=3 name=label3 value=work>Reads like a work-related message</label><br>
<label style=font-size: 16px;><input type=checkbox id=3 name=label3 value=social >Reads like a message from an acquaintance</label><br>
<label style=font-size: 16px;><input type=checkbox id=3 name=label3 value=authority>Reads like a legal/government message</label><br>
<label style=font-size: 16px;><input type=checkbox id=3 name=label3 value=status >Reads like a status update or reminder</label><br>

<label style=font-size: 16px;><input type=checkbox id=3 name=label3 value=marketing>Reads like a marketing e-mail</label><br>
<label style=font-size: 16px;><input type=checkbox id=3 name=label3 value=personal>Reads like a message about personal account</label><br>

<label style=font-size: 16px;><input type=checkbox id=3 name=label3 value=spam >Reads like a spam message</label><br>
<label style=font-size: 16px;><input type=checkbox id=3 name=label3 value=job >Reads like a job opportunity</label><br>
<label style=font-size: 16px;><input type=checkbox id=3 name=label3 value=deadline >Message contains a deadline</label><br>
<label style=font-size: 16px;><input type=checkbox id=3 name=label3 value=positive >Message contains positive emotion (e.g., curiosity, surprise, excitement)</label><br>
<label style=font-size: 16px;><input type=checkbox id=3 name=label3 value=negative>Message contains negative emotion (e.g., fear, panic, threat)</label><br>
<label style=font-size: 16px;><input type=checkbox id=3 name=label3 value=request>Message contains request for help</label><br>
<label style=font-size: 16px;><input type=checkbox id=3 name=label3 value=offer >Message offers assistance</label><br>
<label style=font-size: 16px;><input type=checkbox id=3 name=label3 value=grammar >Contains spelling and grammatical errors</label><br>
<label style=font-size: 16px;><input type=checkbox id=3 name=label3 value=clear >Clearly written e-mail</label><br>
<label style=font-size: 16px;><input type=checkbox id=3 name=label3 value=other >Other</label><br>
<textarea name='label3' rows=9 cols=100></textarea>
<br>
<br>

<input type=hidden name=label4 value=\\>
<input type=hidden name=label5 value=\\>
<input type=hidden name=label6 value=\\>
<button onclick="myFunction()">Submit</button>
<script>
function myFunction() {
    document.getElementById("field2").value = document.getElementById("field1").value;
}
</script>    

</form>
<?php
$conn->close(); 
?>
</body>
</html>