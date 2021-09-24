<?php session_start(); 
include '../class/class.attacker.php';
$attacker = unserialize (serialize ($_SESSION['User']));
//$type = $attacker->getProfileType();
//$nfile = 'Phishing_Instruction_'.$type.'.mp4';
$nfile = 'PhishingInstruction_V4_KD.mp4';
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Instructions</title>
    <link rel="stylesheet" type="text/css" href="Style.css">
    <script src="jquery-3.1.0.min.js"></script>
    <meta charset="UTF-8">
    <meta name="description" content="Attacker EXP">
</head>

<body>
<div id="wrapper">

<h1 style='text-align:center;  margin-top: 40px;'>Instructions</h1>
<p> This video has no sound</p>
<video oncanplay="this.muted=true" width="640" height="480" controls>
  <source id = 'video1' name = 'video1' src=<?php echo($nfile);?> type="video/mp4"'>
  <source src="movie.ogg" type="video/ogg">
Your browser does not support the video tag.
</video>
</div>
<div id="wrapperC">

<form action="./QA.php" method="post">
<h3>Strategies for success</h3>

<ul>
<li><strong>Change your phishing email</strong>&nbsp;in each trial. You will need to make at least a moderate amount of changes to the email content (e.g., few sentences)&nbsp;</li>
<li><strong>Use the information</strong>&nbsp;about the target to your advantage. Customize you phishing emails.</li>
<li><strong>Be creative</strong>&nbsp;with your story. Phishing attacks exploit weaknesses in human psychology and emotions (e.g., greed, curiosity, obedience to authority, urgency); pretend to be friends or colleagues; offer help and opportunity; sound urgent and set deadlines. You don&rsquo;t have to use complicated words or sentence structure.</li>
<li>Deception is subjective, you need to keep trying. Sometimes you will be successful and other times you might not. However, if you are <strong><em>not being creative, deceptive</em></strong> or purposeful, you are very <em>unlikely</em> to gain any rewards.</li>
</ul>
</div>

<div id="wrapper">
    <input type="submit" name="submit" id="submit" class="btn-style" value="Next"/>
</div>

</body>

</html>
