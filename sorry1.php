<?php
session_start();
if (isset($_SESSION['Rater'])){
	include "./class/class.rater.php";
	$user = unserialize(serialize($_SESSION['Rater']));
}elseif(isset($_SESSION['User'])){
	include "./class/class.attacker.php";
	$user = unserialize (serialize ($_SESSION['User']));
}
$user->setmturkcredential();
$earn = $user->getEarn();
if ($earn == NULL){
	$earn =0;
}
$user->insertDB();
?>


<!DOCTYPE html>
<html>
<head>
	<title>Sorry</title>
	<link href="./expdatareport/Style.css" rel="stylesheet">

</head>
<script type="textjavascript">


</script>
<body>

<div id = 'wrapper' style="font-size:25px">
<p><b>The experiment has ended abruptly because a person in your group chose to leave the experiment. </b></p>
<p><b>This is not your fault. You will be compensated for your time.</b></p>
<p><strong>You will receive an email with a $10 tango card by email in 48 hours. This is your guaranteed base payment. </strong></p>
<p><strong>&nbsp;</strong></p>
<p><u>What is a Tango Card?</u> Tango card is an online gift card that is used to pay research subjects. The link provided will take you to a website (trust us it is not phishing) where you can purchase gift cards from a variety of vendors online (e.g., Kohls, Starbucks etc).</p>
<p>&nbsp;</p>
<p>You may close the window now.</p>
<p><strong>&nbsp;</strong></p>
<p><strong>Here is a link to UW Tango Card information: </strong><a href="https://finance.uw.edu/ps/how-pay/research-subjects/tango-card-0">https://finance.uw.edu/ps/how-pay/research-subjects/tango-card-0</a></p>
</div>
</body>
</html>

