<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Thank You</title>
    <link href="Style.css" rel="stylesheet">
    <script src="jquery-3.1.0.min.js"></script>
    <meta charset="UTF-8">
    <meta name="description" content="Attacker EXP">
    <meta name="author" content="Rajivan">
</head>
<?php
session_start();
include "../class/class.rater.php";
$user = unserialize(serialize($_SESSION['Rater']));
if($_POST['submit']=='I Agree'){
    $user->setDebrifing(1);
}elseif($_POST['submit']=='I Deny'){
    $user->setDebrifing(0);
}
#
$user->setmturkcredential();
$earn = $user->getEarn();
if ($earn == NULL){
	$earn =0;
}
$user->insertDB();

?>
<body>
<div id="wrapper">
<p><strong>Thank you for participating in the experiment! You will receive an email with a $10 tango card by email in 48 hours. This is your guaranteed base payment. You will receive a separate email within two weeks containing payment for the bonus points you accumulated. </strong></p>
<p><u>What is a Tango Card?</u> Tango card is an online gift card that is used to pay research subjects. The link provided will take you to a website (trust us it is not phishing) where you can purchase gift cards from a variety of vendors online (e.g., Kohls, Starbucks etc).</p>
<p><strong>Here is a link to UW Tango Card information: </strong><a href="https://finance.uw.edu/ps/how-pay/research-subjects/tango-card-0">https://finance.uw.edu/ps/how-pay/research-subjects/tango-card-0</a></p>
<p>You may close the window now.</p>
</div>
</body>
</html>
