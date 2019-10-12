<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title></title>
    <link href="Style.css" rel="stylesheet">
    <script src="jquery-3.1.0.min.js"></script>
    <meta charset="UTF-8">
    <meta name="description" content="Attacker EXP">
    <meta name="author" content="Rajivan">
</head>
<?php
session_start();
//$ID = $_SESSION["UserID"];
$ID = $_SESSION["MTurkID"];
$line = "";
$file = fopen("Config.txt","r");
$temp = 0;
while(! feof($file))
{
    if($temp==0){
        $line = fgets($file);

    }
    $line = $line."+".fgets($file);
    $temp = $temp + 1;
}
fclose($file);
$pieces = explode("+",$line);
$servername = "localhost";
$username = trim( $pieces[0]);
$password = trim($pieces[1]);
$dbname = trim($pieces[2]);

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//$sql = "INSERT INTO Strategy (UserID, Greed, Curiosity, Fear, Urgency, Genuine, Other, OtherName) VALUES ('".$ID."', ".$_GET['greed'].", ".$_GET['curiosity'].", ".$_GET['fear'].", ".$_GET['urgency'].", ".$_GET['genuine'].", ".$_GET['other'].", '".$_GET['OtherName']."')";
$sql = "INSERT INTO DarkTriad (UserID, Q1, Q2, Q3, Q4, Q5, Q6, Q7, Q8, Q9, Q10, Q11, Q12, Q13, Q14, Q15, Q16, Q17, Q18, Q19, Q20, Q21, Q22, Q23, Q24, Q25, Q26, Q27,Type) VALUES ('".$ID."', ".$_GET['Q1'].", ".$_GET['Q2'].", ".$_GET['Q3'].", ".$_GET['Q4'].", ".$_GET['Q5'].", ".$_GET['Q6'].", ".$_GET['Q7'].", ".$_GET['Q8'].", ".$_GET['Q9'].", ".$_GET['Q10'].", ".$_GET['Q11'].", ".$_GET['Q12'].", ".$_GET['Q13'].", ".$_GET['Q14'].", ".$_GET['Q15'].", ".$_GET['Q16'].", ".$_GET['Q17'].", ".$_GET['Q18'].", ".$_GET['Q19'].", ".$_GET['Q20'].", ".$_GET['Q21'].", ".$_GET['Q22'].", ".$_GET['Q23'].", ".$_GET['Q24'].", ".$_GET['Q25'].", ".$_GET['Q26'].", ".$_GET['Q27'].", 2)";
$result = $conn->query($sql);

?>
<body>
<div id="wrapperC">
    <h2>Your responses has been recorded!</h2>
    <h2>We sincerely thank you for participating in our study!!</h2>
    <h3>You may close this window now.</h3>
</div>
</body>
</html>
