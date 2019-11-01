<!DOCTYPE html>
<html>
<head>
	<title>Result</title>
</head>
<body>



<?php 
session_start();
include 'class/class.attacker.php';
$attacker = unserialize(serialize($_SESSION['User']));
var_dump($attacker);
?>

<form action = "Simulation.php"></form>
<input type="submit" value = "Attack Again!">

</body>
</html>