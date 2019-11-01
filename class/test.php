<?php
include "class.attacker.php";
include "class.rater.php";

echo "<br>";
$Attacker = new Attacker('wo22w');
echo $Attacker->getTrial();
echo $Attacker->getUserID();
$Attacker->setAge(22);
echo $Attacker->getAge();
$Attacker->nextTrial();
#$Attacker->insertDB();
echo ("<br>Next Trial is ".$Attacker->getTrial());
echo "<br>";
echo "the attacker profile type is ".$Attacker->getProfileType();
echo "<br>";
print_r($Attacker->checkAttackersql()->fetch_assoc());
$Attacker->insertDB();

#print_r($result);

$Rater = new Rater('newRater');
echo $Rater->getUserID();
echo "<br>";
echo $Rater->toString();
echo "<br>";
print_r($Rater->toArray());

?>
<!DOCTYPE html>
<html>
<head>
	<title>
		test page
	</title>
</head>
<body>
<p>Hello</p>
</body>
</html>