<?php session_start();?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns="http://www.w3.org/1999/html">
<head>
    <title>Profile</title>
    <link href="Style.css" rel="stylesheet">
    <script src="jquery-3.1.0.min.js"></script>
    <meta charset="UTF-8">
    <meta name="description" content="Attacker EXP">
    <meta name="author" content="Rajivan">
</head>
<title>Profile</title>
<body>
<h2>Target Profile</h2>
<?php
#print_r($_SESSION);
include('../class/class.attacker.php');
#need unserialize and serialize the object variable from session. 

$attacker = unserialize (serialize ($_SESSION['User']));
$type = $attacker->getProfileType();
if ($type == 'Facebook'){
   echo "<h4>Facebook</h4>";
    echo '<img src="Facebook.png">';
}elseif ($type=='Linkedin') {
    echo "<h4>LinkedIn</h4>";
	echo '<img src="LinkedIn1.png">';
	echo '<img src="LinkedIn2.png">';
	echo '<img src="LinkedIn3.png">';
}elseif ($type == 'Twitter') {
    echo "<h4>Twitter</h4>";
	echo '<img src="Twitter.png">';
}
?>
</body>
<form method="get" action="ExperimentBlock.php">
<input type="submit" name="submit" class="btn-style" value="Practice"/>
</html>




