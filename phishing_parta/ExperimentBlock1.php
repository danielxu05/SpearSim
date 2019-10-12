<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title></title>
    <link href="Style.css" rel="stylesheet">
    <script src="jquery-3.1.0.min.js"></script>
    <meta charset="UTF-8">
    <meta name="description" content="Attacker EXP">
    <meta name="author" content="Rajivan">
</head>
<script type="text/javascript">
    $(document).ready(function(){
        $(window).bind("beforeunload", function(){ return(false); });
    });
    function onsubmitform() {
        $(window).unbind('beforeunload');
    }
</script>
<?php
session_start();
?>
<body>
<div id="wrapperC">


<div id="wrapperL">
    <form method="get" action="QA.php" onsubmit="return onsubmitform();">
        <h3>Next you will be asked basic questions to test your knowledge on the tasks you are going to perform in the experiment</h3>
        <h3>The questions are based on instructions you read earlier and practice trials you performed</h3>
        <h3>You must answer all questions correctly to proceed in the study</h3>


</div>
<div id="wrapperC">
    <h4>Please click the below button to start the test</h4></div>
    <input type="submit" name="submit" id="submit" class="btn-style" value="Proceed"/>
    <input type="hidden" name="timeval" id="timeval" value=0 />
    </form>
</div>
</body>
</html>