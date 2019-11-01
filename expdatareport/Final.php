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
<script type="text/javascript">
    $(document).ready(function(){
        $(window).bind("beforeunload", function(){ return(false); });
    });
    </script>
<?php
session_start();


include('class.database.php');
$ID = $_SESSION["MTurkID"];
print_r($ID);
$db = Database::getInstance();
$conn = $db->getConnection(); 
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    echo "Connection Error";
}

$ID = $conn->real_escape_string($ID);
//get the email list from the row
$sql = "SELECT EmailList from Rater WHERE UserID='$ID' ORDER BY ID;";
echo $sql;
$result = $conn->query($sql);
$row = $result->fetch_assoc();

//split the string and get the list of IDS
$EmailIDs = explode(",", $row['EmailList']);
sort($EmailIDs);
#yui$i = 0;
//$length = count($EmailIDs);
//echo "StartTime:".$_GET["starttime"];
$prevtime = $_POST["starttime"];
foreach ($EmailIDs as $emailID) {
    //get the participant ID using the email ID from Phishing table
    $output = 0;
    if($emailID>11) {
        $sql0 = "SELECT UserID from Phishing WHERE ID='" . $emailID . "'";
        $result0 = $conn->query($sql0);
        $row0 = $result0->fetch_assoc();
        $MID = $row0["UserID"];
        //get the sample ID using the participant ID from Participant table
        $sql1 = "SELECT Email1 from Participant WHERE UserID='" . $MID . "'";
        $result1 = $conn->query($sql1);
        $row1 = $result1->fetch_assoc();
        $output = $row1["Email1"];
    }

    //echo $emailID;
    //echo '<br>';
    //$output = 0;
    $label1 = "Q1_".$emailID;
    $label2 = "Q2_".$emailID;
    $label3 = "Q3_".$emailID;
    $label5 = "T1_".$emailID;
    $label6 = "T2_".$emailID;
    $output1 = $_POST[$label1];
    $output2 = $_POST[$label2];
    $output3 = $_POST[$label3];
    $output6 = $_POST[$label6];
    //echo "<br>";
    //echo $output6;
    //echo "<br>";
    //echo $prevtime;
    //echo "<br>";
    //$time=$output6-$prevtime;
    //$prevtime = $output6;
    $time=$output6;

    $ValueString = "";
    if(!empty($output3)) {
        // Loop to store and display values of individual checked checkbox.
        If(in_array("important",$output3))
        {$ValueString = $ValueString."1,";}
        else{$ValueString=$ValueString."0,";}

        If(in_array("work",$output3))
        {$ValueString=$ValueString."1,";}
        else{$ValueString=$ValueString."0,";}

        If(in_array("social",$output3))
        {$ValueString=$ValueString."1,";}
        else{$ValueString=$ValueString."0,";}

        If(in_array("authority",$output3))
        {$ValueString=$ValueString."1,";}
        else{$ValueString=$ValueString."0,";}

        If(in_array("status",$output3))
        {$ValueString=$ValueString."1,";}
        else{$ValueString=$ValueString."0,";}

        If(in_array("marketing",$output3))
        {$ValueString=$ValueString."1,";}
        else{$ValueString=$ValueString."0,";}

        If(in_array("personal",$output3))
        {$ValueString=$ValueString."1,";}
        else{$ValueString=$ValueString."0,";}

        If(in_array("spam",$output3))
        {$ValueString=$ValueString."1,";}
        else{$ValueString=$ValueString."0,";}

        If(in_array("job",$output3))
        {$ValueString=$ValueString."1,";}
        else{$ValueString=$ValueString."0,";}

        If(in_array("deadline",$output3))
        {$ValueString=$ValueString."1,";}
        else{$ValueString=$ValueString."0,";}

        If(in_array("positive",$output3))
        {$ValueString=$ValueString."1,";}
        else{$ValueString=$ValueString."0,";}

        If(in_array("negative",$output3))
        {$ValueString=$ValueString."1,";}
        else{$ValueString=$ValueString."0,";}

        If(in_array("request",$output3))
        {$ValueString=$ValueString."1,";}
        else{$ValueString=$ValueString."0,";}

        If(in_array("offer",$output3))
        {$ValueString=$ValueString."1,";}
        else{$ValueString=$ValueString."0,";}

        If(in_array("grammar",$output3))
        {$ValueString=$ValueString."1,";}
        else{$ValueString=$ValueString."0,";}

        If(in_array("clear",$output3))
        {$ValueString=$ValueString."1,";}
        else{$ValueString=$ValueString."0,";}

        If(in_array("other",$output3))
        {$ValueString=$ValueString."1";}
        else{$ValueString=$ValueString."0";}
    }

   /* foreach ($output3 as $arr){
        echo $arr;
        echo "<br>";
    }
    echo "<br>";*/
    //echo "For EmailID:".$emailID;
    //echo $_GET[$label5];
    //echo $_GET[$label6];
    //$output3 = $conn->real_escape_string($output3);

    if($i>0){
        $sql2 .= "INSERT INTO UserClassification (SampleID, PhishID, RaterID, Response, Confidence, important, workmail, social, authority, status, marketing, personal, spam, job, deadline, positive, negative, request, offer, grammar, clear, other, decisiontime) VALUES (".$output.", ".$emailID.", '".$ID."', ".$output1.", ".$output2.", ".$ValueString.", ".$time.");";
    }
    else{
        $sql2 = "INSERT INTO UserClassification (SampleID, PhishID, RaterID, Response, Confidence, important, workmail, social, authority, status, marketing, personal, spam, job, deadline, positive, negative, request, offer, grammar, clear, other, decisiontime) VALUES (".$output.", ".$emailID.", '".$ID."', ".$output1.", ".$output2.", ".$ValueString.", ".$time.");";
    }
    //insert $output, $emailID, $ID, $output1, $output2, $output3

    $i++;
}
echo $sql2;
echo "<Br>";
//update the row as completed
$sql2 = "UPDATE Rater SET Completed=1 WHERE UserID='$ID'; ";
//$result2 = $conn->multi_query($sql2);
/*if ($conn->multi_query($sql2) === TRUE) {
    echo "<h2>Thank You! Your decisions have been recorded. You may close the window now.</h2>";
} else {
    echo "Error: Your decisions were not recorded. Please inform the experimenter.";
}*/
$i=0;
if ($conn->multi_query($sql2)) {
    do {
        /* store first result set */
        $i++;
        if ($result = $conn->store_result()) {
            $result->free();
        }
        /* print divider */
        if ($conn->more_results()) {

        }
        else{
            echo "<h2>Thank You! Your e-mail decisions have been recorded.</h2>";
        }
    } while ($conn->next_result());
}
if ($conn->errno) {
    echo "Error: Your decisions were not recorded. Please inform the experimenter.<br>";
    echo "Batch execution prematurely ended on statement $i.\n";
    var_dump($conn->error);
}
//$result3 = $conn->query($sql3);
$conn->close();
?>
<body>
<script type="text/javascript">
    function validate() {

        if (document.myForm.Q1.value == false) {
            alert("Please answer question 1 to proceed");
            return false;
        }
        else if (document.myForm.Q2.value == false) {
            alert("Please answer question 2 to proceed");
            return false;
        }
        else if (document.myForm.Q3.value == false) {
            alert("Please answer question 3 to proceed");
            return false;
        }
        else if (document.myForm.Q4.value == false) {
            alert("Please answer question 4 to proceed");
            return false;
        }
        else if (document.myForm.Q5.value == false) {
            alert("Please answer question 5 to proceed");
            return false;
        }
        else if (document.myForm.Q6.value == false) {
            alert("Please answer question 6 to proceed");
            return false;
        }
        else if (document.myForm.Q7.value == false) {
            alert("Please answer question 7 to proceed");
            return false;
        }
        else if (document.myForm.Q8.value == false) {
            alert("Please answer question 8 to proceed");
            return false;
        }
        else if (document.myForm.Q9.value == false) {
            alert("Please answer question 9 to proceed");
            return false;
        }
        else if (document.myForm.Q10.value == false) {
            alert("Please answer question 10 to proceed");
            return false;
        }
        else if (document.myForm.Q11.value == false) {
            alert("Please answer question 11 to proceed");
            return false;
        }
        else if (document.myForm.Q12.value == false) {
            alert("Please answer question 12 to proceed");
            return false;
        }else if (document.myForm.Q13.value == false) {
            alert("Please answer question 13 to proceed");
            return false;
        }
        else if (document.myForm.Q14.value == false) {
            alert("Please answer question 14 to proceed");
            return false;
        }
        else if (document.myForm.Q15.value == false) {
            alert("Please answer question 15 to proceed");
            return false;
        }
        else if (document.myForm.Q16.value == false) {
            alert("Please answer question 16 to proceed");
            return false;
        }
        else if (document.myForm.Q17.value == false) {
            alert("Please answer question 17 to proceed");
            return false;
        }
        else if (document.myForm.Q18.value == false) {
            alert("Please answer question 18 to proceed");
            return false;
        }
        else if (document.myForm.Q19.value == false) {
            alert("Please answer question 19 to proceed");
            return false;
        }
        else if (document.myForm.Q20.value == false) {
            alert("Please answer question 20 to proceed");
            return false;
        }
        else if (document.myForm.Q21.value == false) {
            alert("Please answer question 21 to proceed");
            return false;
        }
        else if (document.myForm.Q22.value == false) {
            alert("Please answer question 22 to proceed");
            return false;
        }
        else if (document.myForm.Q23.value == false) {
            alert("Please answer question 23 to proceed");
            return false;
        }
        else if (document.myForm.Q24.value == false) {
            alert("Please answer question 24 to proceed");
            return false;
        }
        else if (document.myForm.Q25.value == false) {
            alert("Please answer question 25 to proceed");
            return false;
        }
        else if (document.myForm.Q26.value == false) {
            alert("Please answer question 26 to proceed");
            return false;
        }
        else if (document.myForm.Q27.value == false) {
            alert("Please answer question 27 to proceed");
            return false;
        }
        else{
            $(window).unbind('beforeunload');
        }
    }
</script>
<div id="finalQuestions">
    <form name="myForm" method="get" action="ThankYou1.php" onsubmit="return(validate());">

        <h2>Next, please indicate how much you agree with the following statements on a 5-point scale</h2>

        <span style="font-size: large; font-weight: bold;">1. It's not wise to tell your secrets:</span> <br />
        <label style="font-size: 16px;"><input type="radio" name="Q1" value=1>Strongly Disagree </label>&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q1" value=2>Disagree</label>&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q1" value=3>Neither agree nor Disagree</label>&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q1" value=4>Agree</label>&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q1" value=5>Strongly Agree</label>&nbsp
        <br /><br />

        <span style="font-size: large; font-weight: bold;">2. I like to use clever manipulation to get my way:</span> <br />
        <label style="font-size: 16px;"><input type="radio" name="Q2" value=1>Strongly Disagree </label>&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q2" value=2>Disagree</label>&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q2" value=3>Neither agree nor Disagree</label>&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q2" value=4>Agree</label>&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q2" value=5>Strongly Agree</label>&nbsp
        <br /><br />

        <span style="font-size: large; font-weight: bold;">3. Whatever it takes, you must get the important people on your side:</span> <br />
        <label style="font-size: 16px;"><input type="radio" name="Q3" value=1>Strongly Disagree </label>&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q3" value=2>Disagree</label>&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q3" value=3>Neither agree nor Disagree</label>&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q3" value=4>Agree</label>&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q3" value=5>Strongly Agree</label>&nbsp
        <br /><br />

        <span style="font-size: large; font-weight: bold;">4. Avoid direct conflict with others because they may be useful in the future:</span> <br />
        <label style="font-size: 16px;"><input type="radio" name="Q4" value=1>Strongly Disagree </label>&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q4" value=2>Disagree</label>&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q4" value=3>Neither agree nor Disagree</label>&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q4" value=4>Agree</label>&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q4" value=5>Strongly Agree</label>&nbsp
        <br /><br />

        <span style="font-size: large; font-weight: bold;">5. It’s wise to keep track of information that you can use against people later:</span> <br />
        <label style="font-size: 16px;"><input type="radio" name="Q5" value=1>Strongly Disagree </label>&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q5" value=2>Disagree</label>&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q5" value=3>Neither agree nor Disagree</label>&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q5" value=4>Agree</label>&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q5" value=5>Strongly Agree</label>&nbsp
        <br /><br />

        <span style="font-size: large; font-weight: bold;">6. You should wait for the right time to get back at people:</span> <br />
        <label style="font-size: 16px;"><input type="radio" name="Q6" value=1>Strongly Disagree </label>&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q6" value=2>Disagree</label>&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q6" value=3>Neither agree nor Disagree</label>&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q6" value=4>Agree</label>&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q6" value=5>Strongly Agree</label>&nbsp
        <br /><br />

        <span style="font-size: large; font-weight: bold;">7. There are things you should hide from other people because they don’t need to know:</span> <br />
        <label style="font-size: 16px;"><input type="radio" name="Q7" value=1>Strongly Disagree </label>&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q7" value=2>Disagree</label>&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q7" value=3>Neither agree nor Disagree</label>&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q7" value=4>Agree</label>&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q7" value=5>Strongly Agree</label>&nbsp
        <br /><br />

        <span style="font-size: large; font-weight: bold;">8. Make sure your plans benefit you, not others:</span> <br />
        <label style="font-size: 16px;"><input type="radio" name="Q8" value=1>Strongly Disagree </label>&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q8" value=2>Disagree</label>&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q8" value=3>Neither agree nor Disagree</label>&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q8" value=4>Agree</label>&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q8" value=5>Strongly Agree</label>&nbsp
        <br /><br />

        <span style="font-size: large; font-weight: bold;">9. Most people can be manipulated:</span> <br />
        <label style="font-size: 16px;"><input type="radio" name="Q9" value=1>Strongly Disagree </label>&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q9" value=2>Disagree</label>&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q9" value=3>Neither agree nor Disagree</label>&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q9" value=4>Agree</label>&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q9" value=5>Strongly Agree</label>&nbsp
        <br /><br />

        <span style="font-size: large; font-weight: bold;">10. People see me as a natural leader:</span> <br />
        <label style="font-size: 16px;"><input type="radio" name="Q10" value=1>Strongly Disagree </label>&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q10" value=2>Disagree</label>&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q10" value=3>Neither agree nor Disagree</label>&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q10" value=4>Agree</label>&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q10" value=5>Strongly Agree</label>&nbsp
        <br /><br />

        <span style="font-size: large; font-weight: bold;">11. I hate being the center of attention:</span> <br />
        <label style="font-size: 16px;"><input type="radio" name="Q11" value=1>Strongly Disagree </label>&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q11" value=2>Disagree</label>&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q11" value=3>Neither agree nor Disagree</label>&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q11" value=4>Agree</label>&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q11" value=5>Strongly Agree</label>&nbsp
        <br /><br />

        <span style="font-size: large; font-weight: bold;">12. Many group activities tend to be dull without me:</span> <br />
        <label style="font-size: 16px;"><input type="radio" name="Q12" value=1>Strongly Disagree </label>&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q12" value=2>Disagree</label>&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q12" value=3>Neither agree nor Disagree</label>&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q12" value=4>Agree</label>&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q12" value=5>Strongly Agree</label>&nbsp
        <br /><br />

        <span style="font-size: large; font-weight: bold;">13. I know that I am special because everyone keeps telling me so:</span> <br />
        <label style="font-size: 16px;"><input type="radio" name="Q13" value=1>Strongly Disagree </label>&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q13" value=2>Disagree</label>&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q13" value=3>Neither agree nor Disagree</label>&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q13" value=4>Agree</label>&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q13" value=5>Strongly Agree</label>&nbsp
        <br /><br />

        <span style="font-size: large; font-weight: bold;">14. I like to get acquainted with important people:</span> <br />
        <label style="font-size: 16px;"><input type="radio" name="Q14" value=1>Strongly Disagree </label>&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q14" value=2>Disagree</label>&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q14" value=3>Neither agree nor Disagree</label>&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q14" value=4>Agree</label>&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q14" value=5>Strongly Agree</label>&nbsp
        <br /><br />

        <span style="font-size: large; font-weight: bold;">15. I feel embarrassed if someone compliments me:</span> <br />
        <label style="font-size: 16px;"><input type="radio" name="Q15" value=1>Strongly Disagree </label>&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q15" value=2>Disagree</label>&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q15" value=3>Neither agree nor Disagree</label>&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q15" value=4>Agree</label>&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q15" value=5>Strongly Agree</label>&nbsp
        <br /><br />

        <span style="font-size: large; font-weight: bold;">16. I have been compared to famous people:</span> <br />
        <label style="font-size: 16px;"><input type="radio" name="Q16" value=1>Strongly Disagree </label>&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q16" value=2>Disagree</label>&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q16" value=3>Neither agree nor Disagree</label>&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q16" value=4>Agree</label>&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q16" value=5>Strongly Agree</label>&nbsp
        <br /><br />

        <span style="font-size: large; font-weight: bold;">17. I am an average person:</span> <br />
        <label style="font-size: 16px;"><input type="radio" name="Q17" value=1>Strongly Disagree </label>&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q17" value=2>Disagree</label>&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q17" value=3>Neither agree nor Disagree</label>&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q17" value=4>Agree</label>&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q17" value=5>Strongly Agree</label>&nbsp
        <br /><br />

        <span style="font-size: large; font-weight: bold;">18. I insist on getting the respect I deserve:</span> <br />
        <label style="font-size: 16px;"><input type="radio" name="Q18" value=1>Strongly Disagree </label>&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q18" value=2>Disagree</label>&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q18" value=3>Neither agree nor Disagree</label>&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q18" value=4>Agree</label>&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q18" value=5>Strongly Agree</label>&nbsp
        <br /><br />

        <span style="font-size: large; font-weight: bold;">19. I like to get revenge on authorities:</span> <br />
        <label style="font-size: 16px;"><input type="radio" name="Q19" value=1>Strongly Disagree </label>&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q19" value=2>Disagree</label>&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q19" value=3>Neither agree nor Disagree</label>&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q19" value=4>Agree</label>&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q19" value=5>Strongly Agree</label>&nbsp
        <br /><br />

        <span style="font-size: large; font-weight: bold;">20. I avoid dangerous situations:</span> <br />
        <label style="font-size: 16px;"><input type="radio" name="Q20" value=1>Strongly Disagree </label>&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q20" value=2>Disagree</label>&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q20" value=3>Neither agree nor Disagree</label>&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q20" value=4>Agree</label>&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q20" value=5>Strongly Agree</label>&nbsp
        <br /><br />

        <span style="font-size: large; font-weight: bold;">21. Payback needs to be quick and nasty:</span> <br />
        <label style="font-size: 16px;"><input type="radio" name="Q21" value=1>Strongly Disagree </label>&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q21" value=2>Disagree</label>&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q21" value=3>Neither agree nor Disagree</label>&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q21" value=4>Agree</label>&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q21" value=5>Strongly Agree</label>&nbsp
        <br /><br />

        <span style="font-size: large; font-weight: bold;">22. People often say I’m out of control:</span> <br />
        <label style="font-size: 16px;"><input type="radio" name="Q22" value=1>Strongly Disagree </label>&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q22" value=2>Disagree</label>&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q22" value=3>Neither agree nor Disagree</label>&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q22" value=4>Agree</label>&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q22" value=5>Strongly Agree</label>&nbsp
        <br /><br />

        <span style="font-size: large; font-weight: bold;">23. It’s true that I can be mean to others:</span> <br />
        <label style="font-size: 16px;"><input type="radio" name="Q23" value=1>Strongly Disagree </label>&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q23" value=2>Disagree</label>&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q23" value=3>Neither agree nor Disagree</label>&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q23" value=4>Agree</label>&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q23" value=5>Strongly Agree</label>&nbsp
        <br /><br />

        <span style="font-size: large; font-weight: bold;">24. People who mess with me always regret it:</span> <br />
        <label style="font-size: 16px;"><input type="radio" name="Q24" value=1>Strongly Disagree </label>&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q24" value=2>Disagree</label>&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q24" value=3>Neither agree nor Disagree</label>&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q24" value=4>Agree</label>&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q24" value=5>Strongly Agree</label>&nbsp
        <br /><br />

        <span style="font-size: large; font-weight: bold;">25. I have never gotten into trouble with the law:</span> <br />
        <label style="font-size: 16px;"><input type="radio" name="Q25" value=1>Strongly Disagree </label>&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q25" value=2>Disagree</label>&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q25" value=3>Neither agree nor Disagree</label>&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q25" value=4>Agree</label>&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q25" value=5>Strongly Agree</label>&nbsp
        <br /><br />

        <span style="font-size: large; font-weight: bold;">26. I enjoy having sex with people I hardly know:</span> <br />
        <label style="font-size: 16px;"><input type="radio" name="Q26" value=1>Strongly Disagree </label>&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q26" value=2>Disagree</label>&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q26" value=3>Neither agree nor Disagree</label>&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q26" value=4>Agree</label>&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q26" value=5>Strongly Agree</label>&nbsp
        <br /><br />

        <span style="font-size: large; font-weight: bold;">27. I’ll say anything to get what I want:</span> <br />
        <label style="font-size: 16px;"><input type="radio" name="Q27" value=1>Strongly Disagree </label>&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q27" value=2>Disagree</label>&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q27" value=3>Neither agree nor Disagree</label>&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q27" value=4>Agree</label>&nbsp
        <label style="font-size: 16px;"><input type="radio" name="Q27" value=5>Strongly Agree</label>&nbsp
        <br /><br />

        <br/><br/>

        <input type="submit" name="submit" class="btn-style" value="Submit" />
        <input type="hidden" name="timeval" id="timeval" value=0 />
    </form>
</div>
</body>
</html>
