<?php
session_start();
include('../class/class.attacker.php');
$attacker = unserialize (serialize ($_SESSION['User']));
$attacker->setAge($_POST['age']);
$attacker->setGender($_POST['Gender']);
$attacker->setNatLang($_POST['Native']);
$attacker->setBNatLang($_POST['English']);
$attacker->setLangProf($_POST['Prof']);
$_SESSION['User']=$attacker;
#$attacker->insertInfo($_SESSION['EmailAdd'],$_POST['FN'],$_POST['LN'],$attacker->getUserID(),'Attacker');
#$attacker->insertDB();
?>  
<!DOCTYPE html>
  <html>
  <link href="Style.css" rel="stylesheet">

  <head>
  	<title>Instructions</title>
  </head>
  <body>

  <form action="./AttackerInstruction2.php" method="post">
  <div id="wrapperC">

  <h1 style='text-align:center;  margin-top: 40px;'>Instructions</h1>
  <p>You have been randomly chosen to play the <em><u>role</u></em><u> of a phishing attacker</u>. You, as a phishing attacker (a.k.a phisher), will create multiple phishing messages targeting others in your group. Your aim is to deceive them and get them to respond to your messages.</p>
<p>There are 3 other participants in your group. They are playing the role of an end-user who will make decisions on emails they receive. Others in your group do not know they are going to be phished by you. They will however be debriefed at the end of the experiment about the true nature of the experiment.</p>
<p><em>Important Note: This is a phishing simulation game. You will be sending only phishing intent email messages and others in your group are only making decisions on whether to respond or not to emails they receive. So, no harm is made. We are interested in understanding how phishing attackers (a.k.a phishers) create phishing emails exploiting the personal information of their targets. The results from these experiments intends to improve phishing safety.&nbsp;</em></p>
</div>
<div id = "wrapper">
<p>Click next to learn more details about your task</p>

    <input type="submit" name="submit" id="submit" class="btn-style" value="Next" style = 'text-align:center'/>
</div>

</body>
</html>
