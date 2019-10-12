<?php
/**
 * Created by PhpStorm.
 * User: prashanthrajivan
 * Date: 11/2/16
 * Time: 9:30 AM
 */
$ID = 1234;
$BEdits = $_GET["Edits"];
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

//Result = Select PhishID and SampleID of all emails from the Phishing sorted by SampleID using a join and body edit >= T
$sql="SELECT Phishing.ID AS PhishingID, Participant.Email1 AS SampleID FROM Phishing INNER JOIN Participant ON Phishing.UserID=Participant.UserID WHERE BodyEdit >=".$BEdits." AND Phishing.ID > 488 ORDER BY Email1 ASC";
$result = $conn->query($sql);
//Variables:
$Y = $_GET["Samples"]; //Number of Samples
//echo $result->num_rows;
$N = $result->num_rows;
echo $N;
echo "<br>";
$X = $N/$Y; //(Rows in matrix)
//Create X*Y Matrix M
$X = ceil($X);
echo $X;
echo "<br>";
$K = 5;//Number of raters (5)
$T = 0;//Median Body Edits

$i=0;
$j=0;
for($j=0;$j<$Y;$j++)
{
    for($i=0;$i<$X;$i++)
	{
        //Get the next result
        $row = $result->fetch_assoc();
        //Add email ID to M[i,j]
        $M[$i][$j] = $row["PhishingID"];
    }
}
//iterate: For each row in matrix
for($i=0;$i<$X;$i++){
    //get values from each row into an array
    $rowvals = array();
    for($j=0;$j<$Y;$j++){
        array_push($rowvals, $M[$i][$j]);
    }
    //Shuffle entries in each row of matrix
    shuffle($rowvals);

    //Concatenate the row of IDS into a string
    $emailString = implode(",",$rowvals);
    echo $i.":::".$emailString."::Count=".count($rowvals);
    echo "<br>";

    //Insert the row K times in Raters tables with the remaining entries Null
    //for($p=0;$p<$K;$p++) {
      //  $sql2 = "INSERT INTO Rater (EmailList) VALUES ('" . $emailString . "')";
        //$result2 = $conn->query($sql2);
    //}
}
$conn->close();
//Number of records in the table determines the number of participants
//-----------------------------------------
?>

<form method="get" name="myForm1" id="myForm1" action="Shuffle_Start.html">
    <input type="submit" class="btn-style" name="submit" value="Try Again"/><br>
</form>
