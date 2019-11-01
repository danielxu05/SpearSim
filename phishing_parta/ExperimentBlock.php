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
    <h3>Next you will be given two trials to practice the tasks in the experiment.</h3>
    <h3>The two practice trials are for training purposes only and will not affect your final performance in this study</h3>
    <h4>Please click the below button to start your practice trial.</h4></div>
<div id="wrapperC">
    <form method="get" action="Templete.php" onsubmit="return onsubmitform();">
        <input type="submit" name="submit" id="submit" class="btn-style" value="Proceed"/>
        <input type="hidden" name="timeval" id="timeval" value=0 />
    </form>
</div>
</body>
</html>