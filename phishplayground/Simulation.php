<?php session_start(); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns="http://www.w3.org/1999/html">
<title>
Simulation
</title>
<head>
<link rel="stylesheet" type="text/css" href="Style.css">
<script src="jquery-3.1.0.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/11.0.2/css/bootstrap-slider.css">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src ="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/11.0.2/bootstrap-slider.js"></script>

<script src="../ckeditor4/ckeditor.js"></script>

<meta charset="UTF-8">
<meta name="description" content="Attacker Experiment">
</head>

<?php 
ini_set("memory_limit","512M");
$StartTime = time();
include '../class/class.email.php';
$attacker = unserialize (serialize ($_SESSION['User']));

//Setup the DB Connection Info
$db = Database::getInstance();
$conn = $db->getConnection(); 
#$Attacker,$Templete,$Practice_I,$Status,$AttackStartTS
echo "<br><br>";


$Current_Capital = $attacker->getEarn();
$val = ($Current_Capital/10000) * 100;
$global_percent = $val;
$TempleteID = array(11,6,12); 

$goallist = array('Your mission is to get the username and password for bank account of the target.','Your mission is to persuade your target to download an attachment.','Your mission is to get the username and password to the work account of your target.' );
#$templeID
$targetlist = array($attacker->getTargetID1(), $attacker->getTargetID2(),$attacker->getTargetID3());
$Email = new Email($attacker,$attacker->getTrial(),0);
#view for the trial

if($attacker->getTrial()>10){
    $attacker->abortUsers(1);#abort to the survey or end. 
    exit();
}

#template and previous edit
if(($attacker->getTrial()-1)%3 ==1 or $attacker->getTrial()==1){
    $array = array(0,1,2);  
    shuffle($array);
    $_SESSION['targetorder'] =$array;
    #Templete ID is depend on the target 
    if($attacker->getTrial()==1){
        $templeteID = 3;
    }else{
        $goalnum = $_SESSION['goalorder'][floor(($attacker->getTrial()-2)/3)];
        $templeteID = $TempleteID[$goalnum];
    }
    $sql = "SELECT `Email`, `Subject` FROM `Email` WHERE id = ".$templeteID;
    $result = $conn->query($sql)->fetch_assoc();
    
    #each start of the trial update 
}else{
    $result = $Email->getTrialCont($attacker->getTrial()-1)->fetch_assoc();
    $result['Email'] = $result['EmailCont'];
}


if($attacker->getTrial()==1){
    $Email->setPractice_I(1);
    $Email->setStatus(1);
    $info = $attacker->getTargetprofile(0);
    $goalnum = 5;
    $goaltext = 'Your mission is to get the username and password for Amazon account of the target.';
}elseif($attacker->getTrial()>=2 and $attacker->getTrial()<11){
    $goalnum = $_SESSION['goalorder'][floor(($attacker->getTrial()-2)/3)];
    $goaltext = $goallist[$goalnum];
    $subTrial = ($attacker->getTrial()-1)%3;
//    echo "Target ".$targetlist[$subTrial];
    $Email->setTargetID($targetlist[$_SESSION['targetorder'][$subTrial]]);
    $Email->setPractice_I(0);
 //   var_dump($_SESSION['targetorder']);
    $info = $attacker->getTargetprofile($_SESSION['targetorder'][$subTrial]+1);
}

$profile_type = $attacker->getProfileType();
//$profile_type=1;######remember to remove;
$infolist = array('Personal','Professional','Family','Interest');

$EmailText = $result['Email'];
$SubjectText = $result['Subject'];
$_SESSION['User']=$attacker;
$_SESSION['Email'] = $Email;
$_SESSION['Templete']= $templeteID;
$_SESSION['Goal']= $goalnum;
#$selfstatus = $attacker->updateTime();
#if ($selfstatus){
#    $attacker->checkActive();
#}
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<!-- Display the countdown timer in an element -->
<script>
    var slider_flag=1;


function count_time(){
    var trial = <?php echo($attacker->getTrial());?>;
    if (trial==1){
        var minutes = 5;
    }else{
        var minutes = 7;
    }
    var countDownDate = new Date().getTime()+minutes*60000;
    // Update the count down every 1 second
    var x = setInterval(function() {
    // Get today's date and time
    var now = new Date().getTime();
    // Find the distance between now and the count down date
    var distance = countDownDate - now;
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    document.getElementById("demo").innerHTML = 'Time remaining:'+minutes + "m " + seconds + "s ";
    if (distance < 0) {
        clearInterval(x);
        document.getElementById("demo").innerHTML = "Time to edit is over! Please continue to answer the questions below.";
        Q2_click();
    }
    }, 1000);
}
    var editor;
    // The instanceReady event is fired when an instance of CKEditor has finished
    // its initialization.
    $(document).ready(function(){
            var d = new Date();
            document.myForm.loadtime.value = d.getTime();
       });
    

    CKEDITOR.on('instanceCreated',function(ev){
        var arr = [];
        var start = null;
        ev.editor.on('contentDom', function(e) {
            e.editor.document.on('keydown',function(event){
                if (!start) {//checking is a new user input
                    start = $.now();
                }
            });
            e.editor.document.on('keyup',function(event){
                var timeElapsed = $.now() - start;
                if (timeElapsed<2000){
                    arr.push(timeElapsed);
                }
                start = null;//start the next  timing tracking
                const arrAvg = arr.reduce((a,b) => a + b, 0) / arr.length;
                const len = arr.length;
                document.myForm.keystroke.value = Math.floor(arrAvg * 10000) / 10000 ;
                document.myForm.numtyping.value = len;
                });
            });
        });

    function toggleReadOnly() {
        if ( CKEDITOR.status == 'loaded' ) {
            // The API can now be fully used.
            CKEDITOR.instances["email1"].setReadOnly(true);
        }
    }

    function onsubmitform() {
        if( document.myForm.impersonation.value == false  )
        {
            alert( "Please answer the First question" );
            return false;
        }

        if( document.myForm.tone.value == false  )
        {
            alert( "Please answer the Second question" );
            return false;
        }

        if(!Validatecheckbox('strategies')){
            alert('Please report your strategies.');
            return false
        }

        if(!Validatecheckbox('informationused')){
            alert('Please report what information you used from the profile.');
            return false
        }


        if (slider_flag ==0){
            alert('Please report your confidence');
            return false;
        }
        var d = new Date();
        document.myForm.submittime.value = d.getTime();

    }

    function Validatecheckbox(checkboxid) {
        var checked = 0;
 
        //Reference the Table.
        var tblFruits = document.getElementById(checkboxid);
 
        //Reference all the CheckBoxes in Table.
        var chks = tblFruits.getElementsByTagName("INPUT");
 
        //Loop and count the number of checked CheckBoxes.
        for (var i = 0; i < chks.length; i++) {
            if (chks[i].checked) {
                checked++;
            }
        }
 
        if (checked == 0) {
            return false;
        }else{
            return true;
        }
    };

    function Q2_click(){
        $("#Button2").hide();
        $("#targetinfo").hide();
        $("#linkintro").hide();
        var parent = $("#questions");
        var divs = parent.find("label");
        while (divs.length) {
            parent.append(divs.splice(Math.floor(Math.random() * divs.length), 1)[0]);
        }
//time stamp
        var d = new Date();
        document.myForm.q2.value = d.getTime();
        $("#strategyq").show();
        $("#launchB").show();
        toggleReadOnly();
    }

    function Q0_click(){
        $("#Button0").hide();
        $("#targetinfo").show();
        var d = new Date();
        document.myForm.q0.value = d.getTime();

    }

    function Q1_click(){
        $("#Button1").hide();
        $("#Email").show();
        $("#Button2").show();
        count_time();
        var d = new Date();

        document.myForm.q1.value = d.getTime();

    }

</script>

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
<body>


<form method="post" name="myForm" id="myForm" action="Scoring.php" onsubmit="return onsubmitform();">
    <input type="hidden" id="submittime" name="submittime" value="">
    <input type="hidden" id="loadtime" name="loadtime" value="">
    <input type="hidden" id="q0" name="q0" value="">
    <input type ="hidden" id = "q1" name ="q1" value = "">
    <input type="hidden" name="q2" value="q2">
    <input type="hidden" id="keystroke" name="keystroke" value="">
    <input type="hidden" id="numtyping" name="numtyping" value="">
    <input type="hidden" id ="slider1_data" name="slider1_data" value="">

<div class="header">
    <h1 style='text-align: center;'>Phishing Attacker Console</h1>
    <div name="goal" id="wrapper">

        <label id="Instruction0" style="color: Red;font-size:LARGE;font-weight: bold; font-style: italic " ><?php if($attacker->getTrial()==1) {echo "(This is a practice trial)";} elseif ($attacker->getTrial()==2){echo "(Your attack starts!)";} ?></label>
        <p> Trial number: <?php echo($attacker->getTrial());?></p>
        <p><b>Goal for this Trial:</b><?php echo $goaltext;?></p>
        <div id="wrapper">
            <button type="button" id="Button0" class="btn-style" onclick="Q0_click(); return false;" style="font-size: large">Continue</button>
        </div>
        
    </div>

    <div id="wrapper">

    <div id = "targetinfo" name = "targetinfo" style="display: none;" style="margin:0px;">
        <h2>Target Information:</h2>
        <table>
            <br>
                <tr>
                <?php 
                for ($i = 0;$i<$profile_type;$i++){
                    echo('<th>');
                    echo($infolist[$i]);
                    echo('</th>');
                }
                echo('</tr><tr>');
                for ($i = 0;$i<$profile_type;$i++){
                    echo('<td>');
                    echo($info[$infolist[$i]]);
                    echo('</td>');
                }
                ?>
                </tr>
        </table>

        <div class="wrapper">
            <button type="button" id="Button1" class="btn-style" onclick="Q1_click(); return false;" style="font-size: large">Continue</button>
        </div>
    </div>
    </div>
</div>
    <!--Email part of the page -->
    <div id="wrapperC" style="font-size: 20px;color: Red;">
       <b> <p id="demo"></p></b>
    </div>


<div name = "Email" id ="Email"  style="display: none;">
<div name = "wrapperC" id = "wrapperC">    
    <label id="MoneyYouHave" style="font-size: large">Total points You Have: </label><i>(Min=0, Max=10000)</i>
    <div id="bar_blank" style="width: 300px;margin:0px">
        <div id="bar_color" style="width:<?php echo (($global_percent/100)*300); ?>px">
            <label id="Capitalval" style="color: white" ><?php echo $Current_Capital; ?></label>
        </div>
    </div>
    <label id="Instruction1" style="color: Red;font-size:Medium;font-weight: bold; font-style: italic " ><?php if($attacker->getTrial()==1) {echo "This bar will tell you how much points you have accumulated(min and max possible is also shown for reference)";} ?></label>

    <input type="hidden" name="Capital" id="Capital" value="<?php echo $Current_Capital; ?>"/>
    <br /><br />
    <label name="Subjectline" id="Subjectline" style="font-size:medium;font-weight: bold">Subject:</label> <input type="text" name="Subject" id="Subject" style="width: 500px; border-style: solid; border-width: medium" value="<?php echo $SubjectText; ?>" > <label id="Instruction" style="color: Red;font-size:Medium;font-weight: bold; font-style: italic " ><?php if($attacker->getTrial()==1) {echo "<---- Edit the subject line of the email here";} ?></label><br>
    <textarea name="email1" id="email1" rows="50" cols="150" class="ckeditor"> <?php echo $EmailText
        #presetting email content?> </textarea> <label id="Instruction" style="color: Red;font-size:large;font-weight: bold; font-style: italic " ><?php if($attacker->getTrial()==1) {echo "Edit the main body of the email here. You can use the formatting options available at the top of the box.";} ?></label>
    <label id="Instruction5" style="color: green;font-size:large;font-weight: bold; font-style: italic " ><?php if($attacker->getTrial()==1) {echo "You can double click the link inside the email and use the popup to edit the text. Don't worry about the actual link address";} ?></label><br><br>
    <?php
    if ($attacker->getTrial()==1){
        echo "<center><img id = 'linkintro' name = 'linkintro'src=\"URL_Editing_GIF.gif\" style=\"width:600px;height:388px;\"></center>";
    }?>
</div>
</div>
</div>
        <div id = "wrapper">
            <button type="button" id="Button2" class="btn-style" style="display: none;text-align:center;" onclick="Q2_click(); return false;">Submit</button>
        </div>
    
        <div id = "wrapperC">
            
    <!-- Strategy Query -->
    <div id="strategyq" name="strategyq" style="display: none;" onsubmit="return onsubmitform();">
    <h2 style="text-align: left;">Answer the following questions about the phishing email you have created</h2>
    <h3 style="text-align: left;">Select the <u>impersonation</u> you have employed in the attack</h3>
         <div id="question1" name="question1">
            <label style="font-size: medium;"> <input type="radio" id="impersonation" name="impersonation"  value=1 /> &nbsp; Pretended to be a government/law enforcement personnel<br /></label><br>
            <label style="font-size: medium;"> <input type="radio" id="impersonation" name="impersonation" value=2 />&nbsp; Pretended to be a spouse/partner/relative/friend/acquaintance<br /></label><br>
            <label style="font-size: medium;"> <input type="radio" id="impersonation" name="impersonation" value=3 />&nbsp; Pretended to be a workplace colleague/supervisor<br /></label><br>
            <label style="font-size: medium;"> <input type="radio" id="impersonation" name="impersonation" value=4 />&nbsp; Pretended to be a software automation (automatic reminders or notification)<br /></label><br>
            <label style="font-size: medium;"> <input type="radio" id="impersonation" name="impersonation" value=5 />&nbsp; Pretended to be an IT/tech expert (e.g., email from the technology office at workplace)<br /></label><br>
            <label style="font-size: medium;"> <input type="radio" id="impersonation" name="impersonation" value=6 />&nbsp; Pretended to be from a commercial organization (e.g., bank, stores, shopping websites)<br /></label><br>
            <label style="font-size: medium;"> <input type="radio" id="impersonation7" name="impersonation" value=7 />&nbsp; Other<br /></label><br>
        </div>
<br>
        <h2 style="text-align: left;">Select the applicable <u>emotional manipulation</u> you have employed in the attack</h2>
        <div id ="question2" name = "question2">
            <label style="font-size: medium;"><input type="radio" name="tone" id = "tone" value=1>&nbsp;Positive emotion (happy/excite/cheer/proud/amaze/surprise)<br>
            (e.g., a message that offer a deal/lottery/reward/job/promotion etc)</label><br>
            <label style="font-size: medium;"><input type="radio" name="tone" id = "tone" value=2>&nbsp;Neutral emotion – This Messages is not likely to elicit any kind of strong emotion <br>
            (e.g., a message that is informational)</label><br>
            <label style="font-size: medium;"><input type="radio" name="tone" id = "tone" value=3>&nbsp;Negative emotion (sadness/anger/disgust/fear/guilt/shame)<br>
            (e.g., a message that is threatening or inform a problem/failure/loss/deadline)
            </label><br>

        </div>
<br>
       <h2 style="text-align: left;">Select all the applicable <u>strategies</u> you have employed in this attack. </h2>
       <h3>This message intends to deceive and influence the target by:</h3>
        <div id="strategies" name="strategies">
            <label style="font-size: medium;"> <input id="C_1" name="checkboxes[]" type="checkbox" value="Offer" />&nbsp;Offering something (e.g., offering reward) </label><br />
            <label style="font-size: medium;"> <input id="C_2" name="checkboxes[]" type="checkbox" value="Followup" />&nbsp;Pretending to follow-up on an earlier communication</label><br>
            <label style="font-size: medium;"> <input id="C_3" name="checkboxes[]" type="checkbox" value="Threaten" />&nbsp;Threatening with unfavorable consequences (e.g., disclosing websites visited to police)</label><br>
            <label style="font-size: medium;"> <input id="C_4" name="checkboxes[]" type="checkbox" value="Failure" />&nbsp;Informing a problem/failure and extending help (e.g., hacked account)</label><br>
            <label style="font-size: medium;"> <input id="C_5" name="checkboxes[]" type="checkbox" value="Authority" />&nbsp;Appearing to be from a person or institution of authority (e.g., CEO, IRS, FBI, CDC, supervisor)</label><br>
            <label style="font-size: medium;"> <input id="C_6" name="checkboxes[]" type="checkbox" value="Peers" />&nbsp;Informing other people, often peers, had already taken this action (e.g., 80% of your friends have updated to this new version)</label><br>
            <label style="font-size: medium;"> <input id="C_6" name="checkboxes[]" type="checkbox" value="Time" />&nbsp;Informing about a limited offer or resource or time (e.g., limited offer / deadline)</label><br>
            <label style="font-size: medium;"> <input id="C_6" name="checkboxes[]" type="checkbox" value="Pretend" />&nbsp;Pretending to be a regular message (personal or work-related)</label><br>
            <label style="font-size: medium;"> <input id="C_6" name="checkboxes[]" type="checkbox" value="Interest" />&nbsp;Trying to be familiar or desirable in terms of shared interest, belief or background</label> <br>
            <label style="font-size: medium;"> <input id="C_6" name="checkboxes[]" type="checkbox" value="Other" />&nbsp;None of the above</label><br>
        </div>
<br>
        <h2 style="text-align: left;">Select all applicable information you have used to <u>personalize</u> the attack?</h2><h3> Select all that apply. </h3>
         <div id="informationused" name="informationused">
        
        <?php
        for ($i = 0;$i<$profile_type;$i++){
            echo('<label style="font-size: medium;">');
            echo('<input id="'.$infolist[$i].'" name="checkboxes1[]" type="checkbox" value="'.$infolist[$i].'"/>&nbsp;'.$infolist[$i]);
            echo('</label><br>');
        }
        ?>
            
        <label style="font-size: medium;"> <input id="C_41" name="checkboxes1[]" type="checkbox" value="None" />&nbsp;None<br /></label>
        </div>

        <h2 style="text-align: left;">How confident are you on accomplishing the goal with this attempt?</h2>
        <div id ="metacognition" name = "metacognition">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

        <input id="selfeval" type="text" name = "selfeval"
        style="width:700px;"
        data-slider-ticks="[50, 62.5,75 , 87.5, 100]" 
        data-slider-ticks-tooltip="true" 
        ticks_positions="[0, 25, 50, 75, 100]"           
        data-slider-ticks-labels='["Not Confident at all", "Slightly Confident", "Somewhat Confident","Fairly Confident","Fully Confident"]'
        />
<br>
        </div>
        <br/>
        <!--<button id="Button2" onclick="Q2_click(); return false;" style="font-size: large">Submit</button>-->
    </div>

    <!--Final Launch Button -->
    <div id="launchB" name="LaunchB" style="display: none;" >
        <center><input type="submit" class="btn-style" name="submit" value="Launch"/></center>
        <br />  <label id="Instruction4" style="color: Red;font-size:large;font-weight: bold; font-style: italic " ><?php if($attacker->getTrial()==1) {echo "Click this button to record the strategy and launch the phishing email attack during each trial";} ?></label>
    </div>
    <!-- </div>-->
    <br /><br />
</div>
</form>
</body>
<script>
var slider = new Slider("#selfeval", {
    formatter: function(value) {
    return 'Current value: ' + value;
    },
    ticks_tooltip: true,
    ticks_positions: [0, 25, 50, 75, 100],

    step: 0.01
    });

slider.on('change',function(){
    console.log(slider.getValue());
    slider_flag =1;
    document.myForm.slider1_data.value = slider.getValue();
})
</script>


</html>

