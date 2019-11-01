<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns="http://www.w3.org/1999/html">
<head>
    <title></title>
    <link href="Style.css" rel="stylesheet">
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
session_start();

$_SESSION["Check1"]=0;
$_SESSION["Check2"]=0;

print_r($_SESSION);
print_r($_GET);

include('class.database.php');

$db = Database::getInstance();
$conn = $db->getConnection(); 

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if( $_SESSION["Manipulation"]==0){
    $serialized_boxes = serialize( $_GET['boxes'] );
    $Uses = $conn->real_escape_string($serialized_boxes);
    $sql = "INSERT INTO Creativity (UserID, CreativeUses) VALUES ('".$_SESSION["workerId"]."', '".$Uses."')";
}
else {
    $sql = "INSERT INTO Demographics (UserID, Age, Gender, NativeEnglish, EnglishProf, NativeLanguage) VALUES('" . $_SESSION["workerId"] . "','" . $_GET['age'] . "','" . $_GET['Gender'] . "'," . $_GET['English'] . "," . $_GET['Prof'] . ",'" . $_GET['Native'] . "')";
}
if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
    echo $_GET['age'] . $_GET['Gender'] . $_GET['English'] . $_GET['Prof'] . $_GET['Native'];
}
$conn->close();
?>
<div id="wrapperC">
<h2>Take someone for a ride</h2></div>
<div id="wrapperL">
<form type = "post" action="Setup.php" onsubmit="return onsubmitform();">
<!--<p>This is an experiment on human lying behavior in e-mail communications.</p>-->
    <p>In this study, we investigate how humans can be <b><i>creative at deceiving</i></b> other people through e-mail communications. You will play the role of a computer hacker (an online criminal) who will use phishing attacks to deceive others(take someone for a ride). Hence you will be called a <i>“Phisher”</i>
    </p>
    <p><b>What is phishing?</b> - <i>“Phishing scams are typically fraudulent email messages appearing to come from legitimate enterprises (e.g., from a bank, one’s employer, from a tax official, from one’s internet service provider). These messages usually direct people to a spoofed website or otherwise get them to divulge private information (e.g., passphrase, credit card, or other account updates). The perpetrators then use this private information to commit identity theft and earn money.” </i>– An Internet definition for phishing
    </p>
    <p>Phishers target people through fraudulent, deceptive e-mails that exploit weaknesses of human psychology and emotions. These emails induce regular people (victims) into believing that they must disclose their personal information. People who respond to such emails compromise their personal security and identity.
    </p>

<p>As a phisher, you will be asked to write multiple fraudulent, deceptive emails and launch them repeatedly over several trials/rounds. <b>Your ultimate goal is to make as much money</b> as possible by successfully deceiving other people. After you launch an email in each trial, you will receive feedback about your performance and the money you made.
</p>
<p><b>You will not be actually sending out these emails to real people.</b> They will only be sent to computer simulated humans for research purposes.
</p>
<p>Your sincere participation in this study will help us better detect phishing attacks.</p>
</div>
<div id="wrapperC">
<input type="submit" name="submit" id="submit" class="btn-style" value="Next"/>
    <!--<input type="hidden" name="timeval" id="timeval" value=0 />-->
</form>
</div>
</body>
</html>