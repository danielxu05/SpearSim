<?php
session_start();
include "../class/class.attacker.php";
#$_SESSION["starttimeval"]= time();
$attacker = new Attacker("test");
#$attacker->setWaittime($_GET['waittime']);
#$attacker->setStarttime($_SESSION["starttimeval"]);
$_SESSION['EmailAdd'] = $_GET['MTId'];
$attacker->insertDB();
$_SESSION['User'] = $attacker;
?>

<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="Style.css">
    <script src="jquery-3.1.0.min.js"></script>
</head>

<title>
    Demographic
</title>
<body>
<script type="text/javascript">
var pattern = new RegExp(/[~`!#$%\^&*+=\-\[\]\\';,/{}|\\":<>\?]/); //unacceptable chars
    function validate()
    {

        if(document.myForm.FN.value == false){
            alert('Please provide your First Name');
            return false;
        }

        if(document.myForm.LN.value == false){
            alert('Please provide your Last Name');
            return false;
        }

        var txt = "";
        if( document.myForm.age.value == false  )
        {
            alert( "Please provide your age" );
            return false;
        }else{
            if (isNaN(document.myForm.age.value)){
                alert("Please provide your age in a proper number");
                return false;
            }
        }

        if( document.myForm.Gender.value == false  )
        {
            alert( "Please answer the question on gender" );
            return false;
        }

        if( document.myForm.English.value == false )
        {
            alert( "Please answer the question on english nativity" );
            return false;
        }

        var val = document.myForm.Native.value;

        if(val==null || val.trim()==""){
            alert( "Please provide your native language " );
            return false;
        }
        if( document.myForm.Prof.value == false )
        {
            alert( "Please rate your english writing proficiency" );
            return false;
        }

        if (pattern.test(document.myForm.FN.value) || pattern.test(document.myForm.LN.value) || pattern.test(document.myForm.age.value) || pattern.test(val)) {
            alert("Please only use standard letter");
            return false;
        }   


    }
    var PageTitleNotification = {
    Vars:{
        OriginalTitle: document.title,
        Interval: null
    },    
    On: function(notification, intervalSpeed){
        var _this = this;
        _this.Vars.Interval = setInterval(function(){
             document.title = (_this.Vars.OriginalTitle == document.title)
                                 ? notification
                                 : _this.Vars.OriginalTitle;
        }, (intervalSpeed) ? intervalSpeed : 1500);
    },
    Off: function(){
        clearInterval(this.Vars.Interval);
        document.title = this.Vars.OriginalTitle;   
    }
}
PageTitleNotification.On("Experinment Start!");
$(document).click(function(e) {
    PageTitleNotification.Off();
});
</script>

<h1>Please answer the following questions</h1>
<label id="catnum12" style="font-size:x-large; color:black; font-style:italic;" ></label>
<div id="start">
<form name="myForm" method="post" onsubmit="return validate();" action="AttackerInstruction1.php">
    <h3>What is your First Name?</h3>
    <input type="text" id="FN" name="FN" cols="50" style="border-style: solid; border-width: medium" value = ""><br>
    <hr>

    <h3>What is your Last Name?</h3>
    <input type="text" id="LN" name="LN" cols="50" style="border-style: solid; border-width: medium" value = ""><br>
    <hr>

    <h3>What is your age?</h3>
    <input type="text" id="age" name="age" cols="50" style="border-style: solid; border-width: medium" maxlength="2" value = ""><br>
    <hr>

    <h3>Which of the following describes how you think of yourself?</h3>
    <label style="font-size: medium;"><input type="radio" name="Gender" value="F"/> Female<br/></label>
    <label style="font-size: medium;"><input type="radio" name="Gender" value="M"/> Male<br/></label>
    <label style="font-size: medium;"><input type="radio" name="Gender" value="B"/> Non-binary<br/></label>
    <label style="font-size: medium;"><input type="radio" name="Gender" value="O"/> Other<br/></label>
    <label style="font-size: medium;"><input type="radio" name="Gender" value="N"/> Prefer not to say<br/></label>
    <hr>

    <h3>Are you a native English speaker?</h3>
    <label style="font-size: medium;"><input type="radio" name="English" value=1 /> Yes<br/></label>
    <label style="font-size: medium;"><input type="radio" name="English" value=2 /> No<br/></label>
    <hr>

    <h3>If you answered <i>no</i> to the previous question, Please provide your native language (mother tongue). If you answered <i>yes</i>, please write "English"</h3>
    <input type="text" name="Native" id="Native" cols="50" style="border-style: solid; border-width: medium" value=""><br>
    <hr>

    <h3>Please rate your English writing proficiency using the below scale</h3>
    <label style="font-size: medium;"><input type="radio" name="Prof" value=6 />&nbsp;&nbsp;<b>Very Advanced:</b> I can write with perfect grammar, and always convey my thoughts clearly <br/></label>
        <label style="font-size: medium;"><input type="radio" name="Prof" value=5 />&nbsp;&nbsp;<b>Advanced:</b> I can write very well using appropriate grammar but may still make mistakes and fail to convey my thoughts occasionally.	<br/></label>
            <label style="font-size: medium;"><input type="radio" name="Prof" value=4 />&nbsp;&nbsp;<b>Intermediate:</b> I can write reasonably well and can use basic tenses but have problems with more complex grammar and vocabulary.	<br/></label>
                <label style="font-size: medium;"><input type="radio" name="Prof" value=3 />&nbsp;&nbsp;<b>Low Intermediate:</b> I can make simple sentences and can convey the main points of a conversation but need much more vocabulary.	<br/></label>
                    <label style="font-size: medium;"><input type="radio" name="Prof" value=2 />&nbsp;&nbsp;<b>Elementary:</b> I can write simple and short sentences only <br/></label>
                        <label style="font-size: medium;"><input type="radio" name="Prof" value=1 />&nbsp;&nbsp;<b>Beginner:</b> I can write a few words and partial sentences in English.<br/></label>

    <br/><br/>
    <div id="wrapper" name = "wrapper">
    <input type="submit" name="submit" class="btn-style" value="Submit">
    </div>
</form>
</div>
</body>
</html>

