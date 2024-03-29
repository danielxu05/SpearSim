<?php
session_start();
include "../class/class.rater.php";
$user = unserialize(serialize($_SESSION['Rater']));
$qarray=array();
for ($i=1;$i<=24;$i++){
  $idx = 'Q'.$i;
  array_push($qarray,$_POST[$idx]);
}
$conq = implode("','",$qarray);
$conq = "'".$user->getUserID()."','".$conq;
$sql = "INSERT INTO `survey`(`UserID`, `Q1`, `Q2`, `Q3`, `Q4`, `Q5`, `Q6`, `Q7`, `Q8`, `Q9`, `Q10`, `Q11`, `Q12`, `Q13`, `Q14`, `Q15`, `Q16`, `Q17`, `Q18`, `Q19`, `Q20`, `Q21`, `Q22`, `Q23`, `Q24`) VALUES";
$sql = $sql."(".$conq."');";
$db = Database::getInstance();
$conn = $db->getConnection(); 
$conn->query($sql);
$selfstatus = $user->updateTime();
#if ($selfstatus){
#    $user->checkActive();
#}

?>


<!DOCTYPE html>
  <html>

  <html lang = 'en'>
  <link href="Style.css" rel="stylesheet">

  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <head>
  	<title></title>
  </head>
  <body>
  <form name="myForm" method="post" action="ThankYou.php" onsubmit="return validate()">

    <div id ='wrapper'>
  <p><strong><u>DEBRIEFING FORM</u></strong></p>
<p>Thank you for taking part in this research!</p>
<p><strong>Please read the material on this form carefully to learn important information about your experience in this study and mail us any questions that you have. After this debriefing, you may choose to have information we collected from you removed from this research study.</strong></p>
<p>For this study, it was important that we withhold some information from you about some aspects of the study. Now that your participation is completed, we will describe what information was withheld and why. We will also answer any of your questions and give you the opportunity to decide whether you would like to have your data included in this study or removed from it.&nbsp;</p>
<p><strong>What You Should Know About This Study</strong></p>
<p>Before you started participating in this research, you were told that the purpose of the study was to understand your decisions on email messages presented to you. However, the actual purpose of the study was to understand people&rsquo;s decision different types of phishing messages. So, among the regular messages you responded to, there were a small sample (&lt;10%) of messages with phishing intent. <b>There was absolutely <u>no risk</u> to your or your information because these were fake messages for the purposes of the experiment.</b>&nbsp;</p>
<p>We did not tell you the true purpose of the study because past research shows that when people are told it is a study on phishing, people become excessively cautious and suspicious of all the messages they receive and tend to classify majority as suspicious, artificially skewing their decisions, results and hence, invalidating the experiment.</p>
<p><strong>Your Right to Withdraw Data&nbsp;</strong></p>
<p>Now that you know the true purpose of this research study, you may decide whether you want to have your data removed from the study or not. If you choose to have your data removed, please email us with your MTurk ID and simple request asking to remove the data and we will remove all your decisions from our dataset. We will retain only your Mturk ID for payment and accounting purposes. There will be no penalties or negative consequences for you if you withdraw from the study. Even if you withdraw from the study, you are still entitled to your payments. Before making your decision, please email us any questions you have.&nbsp;</p>
<p><strong>Confidentiality</strong></p>
<p>Whether you allow your data to be used in this study or not, please remember that the integrity of this research depended on keeping some of the details from you and the other participants. Therefore, it is important that you do not tell anyone else about the details of this study. Although the purpose of this study was different from what was originally explained to you, everything else on the consent form is correct.&nbsp;</p>
<p>We will keep all information we have about you completely confidential, including your decision about whether to withdraw from the study. If you have any questions or concerns about this study and the research procedures used, you may contact us at: Prashanth Rajivan at University of Washington using the email address:&nbsp;<a href="mailto:prajivan@uw.edu">prajivan@uw.edu</a>&nbsp;</p>
<p>If you have any questions regarding your rights as a research participant in this study, you may contact our Institutional Review Board at 206 543 0098. In case you experience any adverse effects that you feel result from being in this study, please contact us using the above information.&nbsp;</p>
<p>Please click <b> &ldquo;I agree&rdquo; </b> below to indicate&nbsp;that I have read and understand the information in this debriefing form, and I give permission for the data collected from or about me to be included in the study.</p>
<p>Please click &ldquo; I deny&rdquo; below to indicate that I DO NOT give permission for the data collected from or about me to be included in the study.&nbsp;</p>

<center><input type="submit" name="submit"  class="btn-style" value="I Agree" />
<input type="submit" name="submit"  class="btn-style" value="I Deny" /></center>


</div>

</body>
</html>
