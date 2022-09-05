

<!DOCTYPE html>
  <html>
  <head>
      <title>Group Instruction</title>
      <h3>Thank you for choosing to participate in our experiment.</h3>

  </head>
  <body>
<p>This is a group experiment and you are part of a 4-people group.</p>
<p>Each person in the group will be assigned a role</p>
<p>In the next page, you will be given more instructions about the role randomly assigned to you and your tasks in the experiment.</p>
<p>Depending on your role in the group, you may not have to contact or communicate with others in the group.</p>
<p><u>Important</u>: At any time during this experiment, if one or more members in your group decide to drop out or become inactive for more than (2-minutes for end-user, 10-minutes for attacker), the experiment will the aborted for the <u>entire group</u>. Similarly, if you decide to drop out, the experiment will be aborted for others in your team.</p>
<p>In such a scenario:</p>
<ol style="list-style-type: circle;">
    <li>You will be informed about when the experiment has been aborted</li>
    <li>You will be redirected to a page with further information</li>
    <li>You will be compensated for your time - You will be paid the base amount promised but you will not receive any bonus points because the experiment did not come to an end.</li>
</ol>
</body>
<a href="AttackerInstruction1.php">Next</a>
</html>

<?php
include('../class/class.attacker.php');
$attacker = unserialize (serialize ($_SESSION['User']));
$attacker->setAge($_GET['age']);
$attacker->setGender($_GET['Gender']);
$attacker->setLangProf($_GET['Prof']);
$attacker->setNatLang($_GET['Native']);
$attacker->setEarn(1100);
$db = Database::getInstance();
$conn = $db->getConnection(); 
$attacker->insertDB();
$_SESSION['User'] = $attacker;
?>