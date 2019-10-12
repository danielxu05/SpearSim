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
<h4>LinkedIn/Facebook/Twitter information</h4>
<?php
session_start();
#print_r($_SESSION);
include('class.database.php');
$db = Database::getInstance();
$mysqli = $db->getConnection(); 
$sql = "SELECT `profile_type` FROM `AttackerType` WHERE `UserID`='".$_SESSION["workerId"]."'";
$result = $mysqli->query($sql);
$type = $result->fetch_assoc()['profile_type'];
if ($type == 'Facebook'){
	echo '<img src="Facebook.png">';
}elseif ($type=='LinkedIn') {
	echo '<img src="LinkedIn1.png">';
	echo '<img src="LinkedIn2.png">';
	echo '<img src="LinkedIn3.png">';
}elseif ($type == 'Twitter') {
	echo '<img src="Twitter.png">';
}

?>
</body>

<form method="get" action="ExperimentBlock.php">
<input type="submit" name="submit" class="btn-style" value="Practice"/>
</html>




