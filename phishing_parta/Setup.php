<?php session_start(); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title></title>
    <link rel="stylesheet" type="text/css" href="Style.css">
    <script src="jquery-3.1.0.min.js"></script>
    <meta charset="UTF-8">
    <meta name="description" content="Attacker EXP">
    <meta name="author" content="Rajivan">
</head>
<script type="text/javascript">
    $(document).ready(function(){
        $(window).bind("beforeunload", function(){ return(false); });
    });
    function onsubmitform() {
        $(window).unbind('beforeunload');
    }
</script>
<body>
<?php
print_r($_GET);
#print_r($_SESSION);
include('../class/class.attacker.php');
$attacker = unserialize (serialize ($_SESSION['User']));
$attacker->setAge($_GET['age']);
$attacker->setGender($_GET['Gender']);
$attacker->setLangProf($_GET['Prof']);
$attacker->setNatLang($_GET['Native']);
$_SESSION['User'] = $attacker;
#$attacker->
#$db = Database::getInstance();
#$conn = $db->getConnection(); 

?>
<h3>Task Description:</h3>

<form action="profile.php" onsubmit="return onsubmitform();">

    <p>You will perform 8 trials of "writing phishing emails". A sample will be provided to you at the beginning. Use the initial sample phishing email to edit and write your own phishing emails. During each trial in the experiment you will: (1) write a phishing email attack (2) launch the attack to make money and (3) get feedback on your success.
    </p>
    <p>
        <b>Cost and Gains </b>
        You will start the task with 2000 points. Each attack will cost you 200 points, so in each trial you will lose 200 points, but you will earn a reward according to how well you meet these two objectives:
    </p>
    <ol>
        <li>Evade/avoid detection by an attack detection software (see figure and read description below) </li>
        <li>Deceive/trick people to give their personal information (see figure and read description  below) </li>
    </ol>
    So after 8 trials you can end up with a <b>maximum of 4000 points and a minimum of 0 points</b> depending on your performance on these objectives.

    <p>
        <b>Payment</b>
        Your total points will accumulate across trials. At the end, your total points for performance will be converted to real dollars at a rate of <b>$1 for 1000 points</b>. Your cumulative earnings will be added to your $1.00 base payment.
    </p>
    <IMG BORDER="0" SRC="Picture21.png",height="230" width="600">
    <p>
        <b>How to evade detection?</b>
        The detection software is quite simple. It only looks for keywords in emails already known to be associated with phishing emails. Hence, to evade detection, it is recommended <b>that you edit and change your phishing content</b> during each trial. You <i>do not need</i> to change the entire email, but you will need to make at least a moderate amount of changes to the email content (e.g., a couple of sentences). Evading detection is necessary for your phishing email to successfully reach the human on the other end (as shown in figure). Only then you can deceive them and gain maximum rewards.
    </p>

    <p>
        <b>How to deceive people?</b>
        This is entirely up to your judgement and intuition. We ask you to <b>be intuitive and creative</b> about deciding what emails would <b>persuade and lure</b> a user into clicking the link in the email and providing information. Phishing attacks <b>exploit weaknesses in human psychology and emotions</b> (e.g., greed, curiosity, obedience to authority, urgency); pretend to be friends or colleagues; offer help and opportunity; sound urgent and set deadlines. You don’t have to use complicated words or sentence structure.<br/><br/>
        Since deception is subjective, you need to keep trying. Sometimes you will get a big reward and other times you might not. However, if you are <i><b>not being creative, deceptive</b></i> or purposeful, you are very <i>unlikely</i> to gain any rewards.
    </p>

    <h3>
        Note: At any time in the experiment, <b>please do not refresh the page or hit back button </b>
    </h3>

    <div id="wrapperC">
    <input type="submit" name="submit" class="btn-style" value="Practice"/></div>
    <!--<input type="hidden" name="timeval" id="timeval" value=0 />-->
</form>

</body>
</html>