<?php  session_start();  
include '../class/class.rater.php';
$rater = unserialize(serialize($_SESSION['Rater']));
$info = $rater->getProfile();
$rater->setAge($_POST['Age']);
$rater->setGender($_POST['Gender']);
$rater->setDegree($_POST['Degree']);
$_SESSION['Rater'] = $rater;
$rater->insertDB();
$rater->insertInfo($_SESSION['EmailAdd'],$_POST['FN'],$_POST['LN'],$rater->getUserID(),'Rater');
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns="http://www.w3.org/1999/html">
<head>
    <title>Email management under distraction</title>
    <link href="Style.css" rel="stylesheet">
    <script src="jquery-3.1.0.min.js"></script>
    <meta charset="UTF-8">
    <meta name="description" content="Attacker EXP">
    <meta name="author" content="Daniel">
</head>

<body>

<div id="wrapper">
<h1>Email management under distraction</h1>
</div>
<div id="wrapperC">
<form method="get" action="end_profile.php">
<p>We&rsquo;re interested in understanding how people manage their emails under distraction.</p>
<p>Nowadays, people are often overwhelmed with large number of email communications and the management of these emails can become a difficult day-to-day task. We&rsquo;re interested in assessing people's response to different e-mails and understand how different types of distractions could affect their response decisions.&nbsp;</p>
<p>In this task, you will be presented with a number of emails, both personal and work related, taken from the inbox of&nbsp;<i> <?php echo($info['Name']);?></i>. Your task is to examine each email, with the aim of assisting&nbsp;to process his inbox. For each email, you will be asked what action you would take to manage it. You will also be asked to provide a rating of how confident you are with your decision, and what is the content of each email. Further, in between processing emails, you will also be presented with an image and will be asked a question about the characters shown in the image.</p>
<p>Your sincere participation in this study will help us improve e-mail management.</p>
<p><strong>Rewards:&nbsp;</strong>You will start the task with 0 points. You will earn 100 rewards points each time you make the correct decision in each trial &ndash; chose the correct email response or correctly answered the question about the image presented.</p>
<div id="wrapper">
<h3>Payment</h3>
</div>
<p><strong>Base Payment:</strong>&nbsp;You will receive a guaranteed base payment of $10.00.</p>
<p><strong>Bonus</strong>: Points you earn in each trial will accumulate. At the end, your total points will be converted to real dollars at the rate of $0.50 for 1000 points. For e.g., if you accumulate 8000 points at the end of the experiment, you will receive $4.00 as bonus.  </p>
<p><strong>Total</strong>: On completion, depending on your performance and time spent, you can earn anywhere between $10 and $16 (estimated average total = $14).</strong></p>
<p><strong>Note: At any time in the experiment, please do not refresh the page or hit back button&nbsp;</strong></p>
   
<div id="wrapper">

<p><strong>Next, you will be presented with more information about&nbsp; <i> <?php echo($info['Name']);?></i>, whose inbox you will be processing.</strong></p>
</div>
</div>
<div id="wrapper">
<input type="submit" name="submit" id="submit" class="btn-style" value="Start"/>
</form>
</div>
</body>
</html>



