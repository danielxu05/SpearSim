<?php session_start(); ?>
<html>
<title>
Classification
</title>
<head>
<link href="Style.css" rel="stylesheet">
<script src="jquery-3.1.0.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/11.0.2/css/bootstrap-slider.css">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src ="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/11.0.2/bootstrap-slider.js"></script>
</head>
<style type="text/css">
div.a {
  font-size: 15px;
}
</style>
<body>
<script src="../ckeditor4/ckeditor.js"></script>
<div id = 'wrapper'>
<h1>Email Classification Console</h1>
</div>
<?php
include('../class/class.user.email.php');
$rater = unserialize(serialize($_SESSION['Rater']));
#echo('ID: '.$rater->getUserID().'; Trial number:'.$rater->getTrial().'<br>');
$db = Database::getInstance();
$conn = $db->getConnection(); 
if ($_SESSION['cSpear']>=3){
    $rater->abortUsers(1);
}
$emailclassification = new EmailClassification($rater->getUserID());
$result3 = $rater->checkStatus();
if ($result3->num_rows > 0) {
    // output data of each row
    $row = $result3->fetch_assoc();
    $_SESSION['Spear']=1;
    $_SESSION["emailID"] = $row['id'];
    $emailclassification->setPhishID($row['id']);
    $emailclassification->setspearIndicator(1);
} elseif ($result3->num_rows==0){
    //get the email list from the row
    $emailclassification->setspearIndicator(0);
    $_SESSION['Spear'] =0;
    //echo($rater->getEnduser());
    $profileid = (int)substr($rater->getEnduser(),-1);
    $sql2 = "SELECT * from EmailPool WHERE (User = ".$profileid." OR User = 0)  AND ID NOT in (SELECT PhishID FROM UserClassification WHERE RaterID = '".$rater->getUserID()."' ) ORDER BY RAND();";
    echo "<Br>";
    $result2 = $conn->query($sql2);
    if($result2->num_rows>0) {
        $row = $result2->fetch_assoc();
        $row['EmailCont']=$row['Email'];
        //echo $row['ID'];
        $emailclassification->setPhishID($row['ID']);
        $_SESSION['EmailType'] = $row['Type'];
        #setPhishID
    }else {
        echo "No result is return";
    }
}

  $row['EmailCont'] = preg_replace('/<a href="(.*?)"/s','<a href="javascript:void(0);"', $row['EmailCont'] );

$rater->updateTime();
$rater->checkActive();
#var_dump($row);
$_SESSION['email'] = $emailclassification;
$_SESSION['Rater'] = $rater;
$info = $rater->getProfile();
$infolist = array('Personal','Professional','Family','Interest');
$profile_type=4;
echo('<div name = "points" id = "points" style = "display: none;"><div name = "wrapper" id = "wrapper";><p style= "font-size: 25px;">Points you have accumulated so far:<b><u>'.strval($rater->getEarn()).'</u></b> Points</p>');
echo('<button type="button" id="Button1" class="btn-style" onclick="continueButton(); return false;" style="font-size: large">Continue</button></div></div>');
echo('<div name = "endpage" id = "endpage">');
echo('<div name = "wrapper" id = "wrapper"><div id = "targetinfo" name = "targetinfo"  style="display: none;margin:0px;"><center><h2>Profile Information:</h2></center><table><tr>');
for ($i = 0;$i<$profile_type;++$i){
    echo('<th>');
    echo($infolist[$i]);
    echo('</th>');
}
echo('</tr><tr>');
for ($i = 0;$i<$profile_type;++$i){
    echo('<td>');
    echo($info[$infolist[$i]]);
    echo('</td>');
}
echo('</tr></table></div></div><br>');
echo "<div name = \"wrapperC\" id = \"wrapperC\">";    

echo "<label name=\"Subjectline\" id=\"Subjectline\" style=\"font-size:medium;font-weight: bold\">Subject:</label> <input type=\"text\" name=\"Subject\" id=\"Subject\" style=\"width: 500px; border-style: solid; border-width: medium\" value=\"".$row['Subject']."\" readonly>";
echo "<br>";
echo "<textarea name=\"email\" id=\"email\" rows=\"40\" cols=\"130\" disabled>";
echo $row['EmailCont'];
if ($row['Attachment']=='1'){
    echo "<img src=\"EmailAttachment.png\" style=\"width:50px;height:60px;\">";
}
echo "</textarea></div>";


echo "<br>";
#Email Classification Label; 

?>
<div id = 'wrapperC'>
<form name="myForm" method="post" action="insert.php" onsubmit="return onsubmitform();">
<input type="hidden" id="starttime" name="starttime" value="">
<input type="hidden" id ="endtime" name="endtime" value="">
<input type="hidden" id ="slider1_data" name="slider1_data" value="">
<input type="hidden" id ="slider2_data" name="slider2_data" value="">

<h3>How would you manage this e-mail?</h3>
<label style= font-size: 16px;><input type="radio" id=label11 name=label1 value=1 > &nbsp; Respond(reply or take action) immediately</label> <br>
<label style= font-size: 16px;><input type="radio" id=label12 name=label1 value=2 > &nbsp; Flag the email and follow-up later</label> <br>
<label style= font-size: 16px;><input type="radio" id=label13 name=label1 value=3 > &nbsp; Leave the email in the inbox</label> <br>
<label style= font-size: 16px;><input type="radio" id=label14 name=label1 value=4 > &nbsp; Delete the email</label> <br>
<label style= font-size: 16px;><input type="radio" id=label15 name=label1 value=5 > &nbsp; Delete the email and block the sender</label> <br>

<br>
<div id = 'q3' name = 'q3'>
<h3>Rate how confident you are with your recommendation</h3>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input id="selfeval" type="text" slide = 'my_slider_Function()'
style="width:700px;"
data-slider-ticks="[50, 62.5,75 , 87.5, 100]" 
data-slider-ticks-tooltip="true" 
ticks_positions="[0, 25, 50, 75, 100]"           
data-slider-ticks-labels='["Not Confident\n\r at all", "Slightly Confident", "Somewhat Confident","Fairly Confident","Fully Confident"]'
/>
<br>
</div>
<br>

<h3>In your opinion, how important is this message to <?php echo($info['Name']);?></h3>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input id="importance" type="text" 
style="width:700px;"
data-slider-ticks="[1,3,5,7,9]" 
data-slider-ticks-tooltip="true" 
ticks_positions="[0, 25, 50, 75, 100]"           
data-slider-ticks-labels='["Not Important at all", "Slightly Important", "Somewhat Important","Fairly Important","Very Important"]'
/>
<br>

        <br>
<h3>What was the content of this message? Select 'Yes' for all that apply:</h3>
<label style=font-size: 16px;><input type="checkbox" id=label31 name=label3[] value="action" >&nbsp; Request for action (Task assigned, click on a link, download attachment, etc)</label><br>
<label style=font-size: 16px;><input type="checkbox" id=label32 name=label3[] value="information">&nbsp; Request for information or opinion (send a reply message, contact info,send file, image, etc)</label><br>
<label style=font-size: 16px;><input type="checkbox" id=label34 name=label3[] value="project">&nbsp; Contains status update for an ongoing project or task</label><br>
<label style=font-size: 16px;><input type="checkbox" id=label35 name=label3[] value="meeting">&nbsp; Request for a meeting or other communication with you</label><br>

<label style=font-size: 16px;><input type=checkbox id=label36 name=label3[] value="deadline">&nbsp; Contains reminder for a meeting, event, or upcoming deadline</label><br>

<label style=font-size: 16px;><input type=checkbox id=label38 name=label3[] value="spam">&nbsp; Spam or marketing or suspicious</label><br>
<label style=font-size: 16px;><input type=checkbox id=label39 name=label3[] value="other">&nbsp; Other</label><br>

<br>
<br>
<div id = 'wrapper'>
<center>
<input type="submit" name="submit" class="btn-style" value="Submit">
</center>
</div>

</form>
</div>
</div>
<script>
CKEDITOR.replace('email');

var trial = <?php echo($rater->getTrial());?>;
$(document).ready(function(){
            $(window).bind("beforeunload", function(){ return(false); });
            var d = new Date();
            document.myForm.starttime.value = d.getTime();
            if ((trial>5) & ((trial-1)%10 ==0)){
                $("#endpage").hide();
                $("#points").show();
            }
        });
var slider_flag=0;
var slider_flag1=0;
var slider = new Slider("#selfeval", {
	formatter: function(value) {
		return 'Current value: ' + value;
	},
    ticks_tooltip: true,
    ticks_positions: [0, 25, 50, 75, 100],

    step: 0.01,
    });

    var slider1 = new Slider("#importance", {
	formatter: function(value) {
		return 'Current value: ' + value;
	},
    ticks_tooltip: true,
    ticks_positions: [0, 25, 50, 75, 100],

    step: 0.01,
    });
slider.on('change',function(){
    slider_flag =1;
    document.myForm.slider1_data.value = slider.getValue();
})
slider1.on('change',function(){
    slider_flag1 =1;
    document.myForm.slider2_data.value = slider1.getValue();

})



function myFunction() {
    document.getElementById("field2").value = document.getElementById("field1").value;
}
function continueButton(){
    $("#points").hide();
    $("#endpage").show();
    $("#targetinfo").show();
}

function onsubmitform() {
    if (document.myForm.label1.value == false || $('input[type=checkbox]:checked').length == 0)  {
        alert("Please answer all the question to proceed");
        return false;
    }

    if(slider_flag==0){
        alert('Please select confidence level in Q2.');
        return false;
    }

    if(slider_flag1==0){
        alert('Please select confidence level in Q3.');
        return false;
    }

    $(window).unbind('beforeunload');
    var d = new Date();
    document.myForm.endtime.value = d.getTime();
}

</script>    
</body>
</html>