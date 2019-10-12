<?php  session_start();  ?>
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
$_SESSION["MTurkID"]=$_GET["MTId"];

include('class.database.php');
$db = Database::getInstance();
$conn = $db->getConnection(); 

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT UserID FROM Rater Where UserId='".$_SESSION["MTurkID"]."';";
$result1 = $conn->query($sql);
if ($result1->num_rows > 0) {
    header('Location: Error.html');
}
$conn->close();
?>
<div id="wrapperC">
<h2>Email Management</h2></div>
<div id="wrapperL">
<form method="get" action="ClassificationTask.php" onsubmit="return onsubmitform();">
<!--<p>This is an experiment on human lying behavior in e-mail communications.</p>-->
    <p>We’re interested in assessing how people manage their emails.
    </p>
    <p>Nowadays, people are often overwhelmed with large number of email communications and the management of these emails can become a difficult day-to-day task. We’re interested in assessing people's e-mail response decisions  to different e-mails and factors that influence their decisions.
    </p>

<p>In this task, you will be presented with a number of emails, both personal and work related, taken from the inbox of <i>‘Sally Jones’</i>. Your job is to examine each email, with the aim of assisting Sally to process her Inbox. For each email, you will be asked what action you would take to manage it. You will also be asked to provide a rating of how confident you are with your decision, and what aspects of the email most influenced your decision.
</p>
    <p>Your sincere participation in this study will help us improve e-mail management software.</p>
</div>
<div id="wrapperC">
<input type="submit" name="submit" id="submit" class="btn-style" value="Start"/>
    <input type="hidden" name="timeval" id="timeval" value=0 />
</form>
</div>
</body>
</html>