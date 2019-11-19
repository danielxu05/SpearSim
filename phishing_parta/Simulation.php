<?php session_start(); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns="http://www.w3.org/1999/html">
<head>
    <title></title>
    <link rel="stylesheet" type="text/css" href="Style.css">
    <script src="jquery-3.1.0.min.js"></script>
    <script type="text/javascript" src="ckeditor/ckeditor.js"></script>
    <meta charset="UTF-8">
    <meta name="description" content="Attacker Experiment">
    <meta name="author" content="Rajivan">
</head>

<?php 
ini_set("memory_limit","512M");
$StartTime = time();
include '../class/class.email.php';
$attacker = unserialize (serialize ($_SESSION['User']));
if($attacker->getTrial()==0) {
    echo '<script type="text/javascript"> alert("Reminder:You have exceeded 45 minutes in the experiment"); </script>';
}
//Setup the DB Connection Info
$db = Database::getInstance();
$conn = $db->getConnection(); 
$attacker->nextTrial();
$Practice_I = 0;
#$Attacker,$Templete,$Practice_I,$Status,$AttackStartTS
echo "<br><br>";
$Email = new Email($attacker,$_POST['TempleteID'],$Practice_I,0,$StartTime);
#var_dump($Email);
#if($attacker->getTrial()>1){
#}elseif($attacker->getTrial()>1 and $attacker->getTrial()<2 ){
    #practice Trial 
#}else
$EmailText = "preset";
$SubjectText ="preset";


$sql = "SELECT `Email`, `Subject` FROM `Email` WHERE id = ".$_POST['TempleteID'];
$result = $conn->query($sql)->fetch_assoc();
$EmailText = $result['Email'];
$SubjectText = $result['Subject'];
$Current_Capital = 2000;
$val = ($Current_Capital/4000) * 100;
$global_percent = $val;
$_SESSION['User']=$attacker;

?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<script>
   

    var editor;
    // The instanceReady event is fired when an instance of CKEditor has finished
    // its initialization.
    $(document).ready(function(){
            $(window).bind("beforeunload", function(){ return(false); });
            var d = new Date();
            document.myForm.starttime.value = d.getTime();
       });
    

    CKEDITOR.on('instanceCreated',function(ev){
        console.log('created');
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
                console.log(['time elapsed:', timeElapsed, 'ms'].join(' '));
                console.log(['average ',arrAvg,'ms'].join(' '));
                console.log(arr.length);
                document.myForm.keystroke.value = Math.floor(arrAvg * 10000) / 10000 ;
                document.myForm.numtyping.value = len;
                });
            });
        });
    function toggleReadOnly( isReadOnly ) {
        editor.setReadOnly( isReadOnly );
    }

    $(document).ready(function(){
        $(window).bind("beforeunload", function(){ return(false); });
    });


    function onsubmitform() {
        if($('input[type=checkbox]:checked').length == 0)//******same method on the user-end
        {
            alert( "Please choose all applicable strategies to proceed" );
            return false;
        }else {
            // grab the value of the hidden donecheck element
            <?php ?>
            $(window).unbind('beforeunload');
            var d = new Date();
            document.strategyq.starttime.value = d.getTime();

        }
    }

    function Q1_click(){
        $("#Button1").hide();
        var parent = $("#questions");
        var divs = parent.find("label");
        console.log('pass');
        while (divs.length) {
            parent.append(divs.splice(Math.floor(Math.random() * divs.length), 1)[0]);
        }

        //time stamp
        $(window).unbind('beforeunload');
        var d = new Date();
        document.myForm.endtime.value = d.getTime();

        $("#strategyq").show();
        $("#launchB").show();
        toggleReadOnly();
    }
    
</script>

<body>
<form method="post" name="myForm" id="myForm" action="Scoring.php" onsubmit="return onsubmitform();">
    <input type="hidden" id="starttime" name="starttime" value="">
    <input type="hidden" name="endtime" value="">
    <input type="hidden" id="keystroke" name="keystroke" value="">
    <input type="hidden" id="numtyping" name="numtyping" value="">

    <!--Title and score part of the page -->
    <div name="wrapper" id="wrapperC">
        <h1>Phishing Attacker Console</h1>
        <label id="Instruction0" style="color: Red;font-size:LARGE;font-weight: bold; font-style: italic " ><?php if($_SESSION['Trial']==1) {echo "(This is a practice trial)";} ?></label>
    </div>

    <!--Email part of the page -->
    <div name="wrapper" id="wrapper">
        <label id="MoneyYouHave" style="font-size: large">Total points You Have: </label><i>(Min=0, Max=4000)</i>
        <div id="bar_blank" style="width: 300px;">
            <div id="bar_color" style="width:<?php echo (($global_percent/100)*300); ?>px">
                <label id="Capitalval" style="color: white" ><?php echo $Current_Capital; ?></label>
            </div>
        </div>
        <label id="Instruction1" style="color: Red;font-size:Medium;font-weight: bold; font-style: italic " ><?php if($Practice==1) {echo "This bar will tell you how much points you have accumulated(min and max possible is also shown for reference)";} ?></label>

        <input type="hidden" name="Capital" id="Capital" value="<?php echo $Current_Capital; ?>"/>
        <br /><br />
        <label name="Subjectline" id="Subjectline" style="font-size:medium;font-weight: bold">Subject:</label> <input type="text" name="Subject" id="Subject" style="width: 500px; border-style: solid; border-width: medium" value="<?php echo $SubjectText; ?>" > <label id="Instruction" style="color: Red;font-size:Medium;font-weight: bold; font-style: italic " ><?php if($Practice==1) {echo "<---- Edit the subject line of the email here";} ?></label><br>
        <textarea name="email1" id="email1" rows="50" cols="150" class="ckeditor"> <?php echo $EmailText
         #presetting email content?> </textarea> <label id="Instruction" style="color: Red;font-size:large;font-weight: bold; font-style: italic " ><?php if($attacker->getTrial()==1) {echo "Edit the main body of the email here. You can use the formatting options available at the top of the box.";} ?></label>
        <!-- <script type="text/javascript">
            CKEDITOR.replace( 'email1' );
        </script> -->
        <label id="Instruction5" style="color: green;font-size:large;font-weight: bold; font-style: italic " ><?php if($Practice==1) {echo "You can double click the link inside the email and use the popup to edit the text. Don't worry about the actual link address";} ?></label><br>
        <?php if($Practice==1) {echo '<IMG BORDER="1" SRC="Tutorial_Image.png" height="100" width="300"  />';} ?>
        <div name="wrapperC">
        <br /> <button type="button" id="Button1" onclick="Q1_click(); return false;" style="font-size: large">Submit</button>
        </div>
        <a href="Templete.php">Want to change another Templete?</a><br>
        <a href="profile.php" target="_top">Target Social Profile</a>
    </div>

    <!-- Strategy Query -->
    <div id="strategyq" name="strategyq" style="display: none;">
       <h2 style="text-align: left;">Select all applicable strategies you have employed in this phishing attack</h2>
         <div id="questions" name="questions">
            <label style="font-size: medium;"> <input id="C_1" name="checkboxes[]" type="checkbox" value="Deadline" />Deadlines<br /></label>
            <label style="font-size: medium;"> <input id="C_2" name="checkboxes[]" type="checkbox" value="Positive" />Positive emotion (e.g., curiosity, surprise, excitement)<br /></label>
            <label style="font-size: medium;"> <input id="C_3" name="checkboxes[]" type="checkbox" value="Negative" />Negative emotion (e.g., fear, panic, threat)<br /></label>
            <label style="font-size: medium;"> <input id="C_4" name="checkboxes[]" type="checkbox" value="Authority" />Pretend to be a government/legal/workplace authority<br /></label>
            <label style="font-size: medium;"> <input id="C_5" name="checkboxes[]" type="checkbox" value="Friend" />Pretend to be a friend/colleague/acquaintance/relative<br /></label>
            <label style="font-size: medium;"> <input id="C_6" name="checkboxes[]" type="checkbox" value="Interest" />Pretend to have shared interest (work or activity)<br /></label>
            <label style="font-size: medium;"> <input id="C_7" name="checkboxes[]" type="checkbox" value="Failure" />Inform problem/failure/loss<br /></label>
            <label style="font-size: medium;"> <input id="C_8" name="checkboxes[]" type="checkbox" value="Deal" />Offer deal/lottery/reward<br /></label>
            <label style="font-size: medium;"> <input id="C_9" name="checkboxes[]" type="checkbox" value="IllGains" />Pretend to provide reminder/update/notification<br /></label>
            <label style="font-size: medium;"> <input id="C_10" name="checkboxes[]" type="checkbox" value="IllMaterial" />Offer illegal material (e.g., pornography, drugs)<br /></label>
            <label style="font-size: medium;"> <input id="C_11" name="checkboxes[]" type="checkbox" value="Opportunity" />Present new opportunity (job, product or service)<br /></label>
            <label style="font-size: medium;"> <input id="C_12" name="checkboxes[]" type="checkbox" value="RHelp" />Request help/favor<br /></label>
            <label style="font-size: medium;"> <input id="C_13" name="checkboxes[]" type="checkbox" value="OHelp" />Offer help/assistance<br /></label>
            <label style="font-size: medium;"> <input id="C_14" name="checkboxes[]" type="checkbox" value="Other" />Other<br /></label>
        </div>
        <h2 style="text-align: left;">How confident are you on accomplishing the goal with this attempt
        <div id ="metacognition" name = "metacognition">
            <label style="font-size: medium;"><input type="checkbox" name="checkboxes1[]" value=1>No Confidence</label><br>
            <label style="font-size: medium;"><input type="checkbox" name="checkboxes1[]" value=2>Medium Confidence</label><br>
            <label style="font-size: medium;"><input type="checkbox" name="checkboxes1[]" value=3>Confidence</label><br>
            <label style="font-size: medium;"><input type="checkbox" name="checkboxes1[]" value=4>Highly Confidence</label><br>
        </div>
        <br/>
        <!--<button id="Button2" onclick="Q2_click(); return false;" style="font-size: large">Submit</button>-->
    </div>

    <!--Final Launch Button -->
    <div id="launchB" name="LaunchB" style="display: none;">
        <input type="submit" class="btn-style" name="submit" value="Launch"/>
        <br />  <label id="Instruction4" style="color: Red;font-size:large;font-weight: bold; font-style: italic " ><?php if($Practice==1) {echo "Click this button to record the strategy and launch the phishing email attack during each trial";} ?></label>
    </div>
    <!-- </div>-->
    <br /><br />

</form>

</body>
</html>