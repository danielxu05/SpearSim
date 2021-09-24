<?php
session_start();
include '../class/class.rater.php';
$rater = new Rater(md5($_GET['MTId']));
$rater->setWaittime($_GET['waittime']);
$rater->setStarttime(time());
$_SESSION['Rater']=$rater;
$_SESSION['EmailAdd'] = $_GET['MTId'];
$_SESSION['CSpear']=0;
$rater->insertDB();
?>

<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="./Style.css">
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

        if( document.myForm.Age.value == false)
        {
            alert( "Please provide your age" );
            return false;
        }else{
            if (isNaN(document.myForm.Age.value)){
                alert("Please provide your age in a proper number");
                return false;
            }
        }

        if( document.myForm.Gender.value == false  )
        {
            alert( "Please answer the question on gender" );
            return false;
        }

        if( document.myForm.Degree.value == false )
        {
            alert( "Please answer the question on Degree" );
            return false;
        }

        if (pattern.test(document.myForm.FN.value) || pattern.test(document.myForm.LN.value) || pattern.test(document.myForm.Age.value)) {
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
<label id="catnum12" style="font-size:x-large; color:black; font-style:italic;" ></label>
<div id= 'wrapperC'>
<form name="myForm" method="post" onsubmit="return validate();" action="Intro.php">
<h1>Please answer the following questions</h1>

<h3>What is your First Name?</h3>
    <input type="text" id="FN" name="FN" cols="50" style="border-style: solid; border-width: medium" value = ""><br>
    <hr>

    <h3>What is your Last Name?</h3>
    <input type="text" id="LN" name="LN" cols="50" style="border-style: solid; border-width: medium" value = ""><br>
    <hr>

    <h3>What is your age?</h3>
    
    <input type="text" id="Age" name="Age" cols="50" style="border-style: solid; border-width: medium" maxlength="2" value = ""><br>
    <hr>

    <h3>Which of the following describes how you think of yourself?</h3>
    <label style="font-size: medium;"><input type="radio" name="Gender" value="F"/> Female<br/></label>
    <label style="font-size: medium;"><input type="radio" name="Gender" value="M"/> Male<br/></label>
    <label style="font-size: medium;"><input type="radio" name="Gender" value="B"/> Non-binary<br/></label>
    <label style="font-size: medium;"><input type="radio" name="Gender" value="O"/> Other<br/></label>
    <label style="font-size: medium;"><input type="radio" name="Gender" value="N"/> Prefer not to say<br/></label>
    <hr>

    <h3>What is your education Background</h3>

    <label style="font-size: medium;"><input type="radio" name="Degree" value="H"/> High School<br/></label>
    <label style="font-size: medium;"><input type="radio" name="Degree" value="B"/> Bachlors' degree<br/></label>
    <label style="font-size: medium;"><input type="radio" name="Degree" value="M"/> Master's degree<br/></label>
    <label style="font-size: medium;"><input type="radio" name="Degree" value="P"/> Ph.D. and higher degree<br/></label>
    <label style="font-size: medium;"><input type="radio" name="Degree" value="O"/> Other<br/></label>


    <br>
    <div id = "wrapper">
        <input type="submit" name="submit" class="btn-style" value="Submit">
    </div>
</form>
</div>
</body>
</html>

