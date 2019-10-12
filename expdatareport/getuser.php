<!DOCTYPE html>
<html>
<head>
</head>
<body>
<?php
/**
 * Created by PhpStorm.
 * User: prashanthrajivan
 * Date: 10/26/16
 * Time: 9:48 AM
 */
$q = $_GET['q'];
//echo $q;
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
//echo $line;

$pieces = explode("+",$line);
$servername = "localhost";
$username = trim( $pieces[0]);
$password = trim($pieces[1]);
$dbname = trim($pieces[2]);
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    echo "Connection Error";
}


$sql="SELECT ID, SubjectEdit, BodyEdit, Subject, Email2 FROM Phishing WHERE UserID = '".$q."'";
$result = $conn->query($sql);
$EmailText = "";
$SubjectText = "";
$count = 0;
if ($result->num_rows > 0) {
    //echo "We have Results";
    while($row = $result->fetch_assoc()) {

        echo "Email Trial: ".$count."<br>";
        echo "Subject Edit: ".$row["SubjectEdit"]."<br>";
        echo "Body Edit: ".$row["BodyEdit"]."<br>";
        echo "---------------------------------------"."<br>";
        echo "Subject Line:".$row["Subject"]."<br>";
        echo "---------------------------------------"."<br>";
        echo $row["Email2"];
        echo '<hr>';
        echo '<br><br>';
        $count = $count + 1;
        $pid = $row["Email2"];
        $sql2="SELECT YN, Score FROM Classification WHERE PhishID = '$pid';";
        $result1 = $conn->query($sql2);
        $row1 = $result1->fetch_assoc();
        //echo "Is it a Phish?:".$row1['YN']."<br>";
        //echo "Phish Score:".$row1['Score']."<br>";
        $result1->free();
    }
} else {
    echo "Something is wrong. No results";
}

?>
</body>
</html>
