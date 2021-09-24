<?php
session_start();
include '../class/class.rater.php';

$rater = unserialize(serialize($_SESSION['Rater']));
$info = $rater->getProfile();
if($_POST['name']=="1"){
    $rater->setQ1(1);
}else{
    $rater->setQ1(0);

}

if($_POST['points']==$info['Birth']){
    $rater->setQ2(1);
}else{
    $rater->setQ2(0);
}

if($_POST['goal']==$info['Bank']){
    $rater->setQ3(1);
}else{
    $rater->setQ3(0);
}

if($_POST['position']=="4"){
    $rater->setQ4(1);
}else{
    $rater->setQ4(0);
}
$rater->insertDB();
$_SESSION['Rater'] = $rater;
$_SESSION['cSpear']=0;
?>

<!DOCTYPE html>
  <html lang = 'en'>
  <link href="Style.css" rel="stylesheet">

  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <head>

  	<title>Start</title>
  </head>
  <body>
  <form name="myForm" action="ClassificationTask.php">

  <div id = "wrapper">
<h2>You are about to begin the experiment.</h2>
<h3>Next, you will be presented with a series of email messages, one at a time. Please answer them to the best of your ability</h3>
<input type="submit" name="submit" class="btn-style" value="Submit">

</div>
</form>
</body>
</html>