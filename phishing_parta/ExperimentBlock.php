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
#print_r($_SESSION);
include('../class/class.attacker.php');
#need unserialize and serialize the object variable from session. 
#var_dump($_SESSION['User']);
$attacker = unserialize (serialize ($_SESSION['User']));
$type = $attacker->getProfileType();
$array = array(0,1,2);
shuffle($array);
//$_SESSION['goalnum'] = 0;
$_SESSION['goalorder'] = $array;
shuffle($array);
$_SESSION['targetorder'] =$array;
$info = $attacker->getTargetprofile($array[0]+1);
if($_POST['diff']=="1"){
    $attacker->setQ1(1);
}else{
    $attacker->setQ1(0);

}

if($_POST['points']=="3"){
    $attacker->setQ2(1);
}else{
    $attacker->setQ2(0);
}

if($_POST['goal']=="3"){
    $attacker->setQ3(1);
}else{
    $attacker->setQ3(0);
}
$_SESSION['User']=$attacker;
$attacker->insertDB();
?>
<body>
<div id="wrapper">
    <h3>Next you will be given one trial to practice the tasks in the experiment.</h3>
    <h3>The practice trial is for training purposes only and will not affect your final performance in this study</h3>
    <h4>Please click the below button to start your practice trial.</h4></div>
<div id="wrapper">
    <form method="get" action="Simulation.php" onsubmit="return onsubmitform();">
        <input type="submit" name="submit" id="submit" class="btn-style" value="Proceed"/>
        <input type="hidden" name="timeval" id="timeval" value=0 />
    </form>
</div>
</body>
</html>