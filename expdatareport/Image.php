<?php
session_start();
include '../class/class.rater.php';
$rater = unserialize(serialize($_SESSION['Rater']));
$trial = $rater->getTrial();
$characterlist =array('+','-','=','%');
$reflist = array('plus','minus','percent','equal');
$n = mt_rand(0,3);
$imageid = intdiv($trial,5)+10;
$nfile = 'Slide'.strval($imageid).'.jpeg';
$_SESSION['imageid']=$imageid;
$_SESSION['refid']=$reflist[$n];

?>

<!DOCTYPE html>
  <html lang = 'en'>
  <link href="Style.css" rel="stylesheet">

  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <head>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  	<title>Image</title>
  </head>
<script>
$(document).ready(function(){
var d = new Date();
document.myForm.loadtime.value = d.getTime();
});

function onsubmitform(){
  if (document.myForm.estimation.value ==false){
    alert('Please answer the question to proceed.');
    return false
  }
  if (isNaN(document.myForm.estimation.value)){
    alert('Please enter a number');
    return false
  }
  if (document.myForm.estimation.value>100){
    alert('Please enter a reasonable number');
    return false
  }
var d = new Date();
            document.myForm.submittime.value = d.getTime();
  }
</script>
  <body>
  <form name="myForm" action="ImageInsert.php" method="post"onsubmit="return onsubmitform();">
  <input type="hidden" id="submittime" name="submittime" value="">
  <input type="hidden" id="loadtime" name="loadtime" value="">
  <div id = "wrapper">
<h1>Image Classification Task</h1>
<h2>Please look at the image and answer the questions</h2>
<img src="stimuli/<?php echo($nfile);?>" id = 'image' width="500" height="500">
<h3>Enter the number of <label style = "color:Red;font-size:large;"><b><?php echo($characterlist[$n]);?></b></label> characters in the image?</h3>
<input type="text" id ="estimation" name = 'estimation' value="">
<br><br>
<input type="submit" name="submit" class="btn-style" value="Submit">

</div>
</form>
</body>
</html>