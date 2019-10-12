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
$t = $_SESSION["PrevTrial"];
$ID = $_SESSION["UserID"];
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
$Block_Check = 0;
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "UPDATE Participant SET Email3=".$t." WHERE UserID='".$ID."'";
$result = $conn->query($sql);
?>
<body>
<script type="text/javascript">
    $(document).ready(function(){
        $(window).bind("beforeunload", function(){ return(false); });
    });
    /*function onsubmitform() {
        $(window).unbind('beforeunload');
    }*/
    function validate() {
        /*if (document.myForm.greed.value == false) {
            alert("Please answer all of the questions to proceed");
            return false;
        }
        if (document.myForm.curiosity.value == false) {
            alert("Please answer all of the questions to proceed");
            return false;
        }

        if (document.myForm.fear.value == false) {
            alert("Please answer all of the questions to proceed");
            return false;
        }
        if (document.myForm.urgency.value == false) {
            alert("Please answer all of the questions to proceed");
            return false;
        }
        if (document.myForm.genuine.value == false) {
            alert("Please answer all of the questions to proceed");
            return false;
        }
        if (document.myForm.other.value == false) {
            alert("Please answer all of the questions to proceed");
            return false;
        }*/

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

        <h2>Please indicate how much you agree with the following questions on a 5-point scale</h2>
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
        
   <!-- <h2>Based on the attacks you launched, note the extent to which you exploited the following emotions in your attacks</h2>
    <h3>Greed:</h3>
    <input type="radio" name="greed" value=1><label style="font-size: 16px;">None of my attacks</label>&nbsp
    <input type="radio" name="greed" value=2><label style="font-size: 16px;">Rarely</label>&nbsp
    <input type="radio" name="greed" value=3><label style="font-size: 16px;">Occasionally</label>&nbsp
    <input type="radio" name="greed" value=4><label style="font-size: 16px;">Often</label>&nbsp
    <input type="radio" name="greed" value=5><label style="font-size: 16px;">All my attacks</label>&nbsp
    <h3>Curiosity</h3>
    <input type="radio" name="curiosity" value=1><label style="font-size: 16px;">None of my attacks</label>&nbsp
    <input type="radio" name="curiosity" value=2><label style="font-size: 16px;">Rarely</label>&nbsp
    <input type="radio" name="curiosity" value=3><label style="font-size: 16px;">Occasionally</label>&nbsp
    <input type="radio" name="curiosity" value=4><label style="font-size: 16px;">Often</label>&nbsp
    <input type="radio" name="curiosity" value=5><label style="font-size: 16px;">All my attacks</label>&nbsp
    <h3>Fear</h3>
    <input type="radio" name="fear" value=1><label style="font-size: 16px;">None of my attacks</label>&nbsp
    <input type="radio" name="fear" value=2><label style="font-size: 16px;">Rarely</label>&nbsp
    <input type="radio" name="fear" value=3><label style="font-size: 16px;">Occasionally</label>&nbsp
    <input type="radio" name="fear" value=4><label style="font-size: 16px;">Often</label>&nbsp
    <input type="radio" name="fear" value=5><label style="font-size: 16px;">All my attacks</label>&nbsp
    <h3>Urgency</h3>
    <input type="radio" name="urgency" value=1><label style="font-size: 16px;">None of my attacks</label>&nbsp
    <input type="radio" name="urgency" value=2><label style="font-size: 16px;">Rarely</label>&nbsp
    <input type="radio" name="urgency" value=3><label style="font-size: 16px;">Occasionally</label>&nbsp
    <input type="radio" name="urgency" value=4><label style="font-size: 16px;">Often</label>&nbsp
    <input type="radio" name="urgency" value=5><label style="font-size: 16px;">All my attacks</label>&nbsp
    <h3>Sound Genuine</h3>
    <input type="radio" name="genuine" value=1><label style="font-size: 16px;">None of my attacks</label>&nbsp
    <input type="radio" name="genuine" value=2><label style="font-size: 16px;">Rarely</label>&nbsp
    <input type="radio" name="genuine" value=3><label style="font-size: 16px;">Occasionally</label>&nbsp
    <input type="radio" name="genuine" value=4><label style="font-size: 16px;">Often</label>&nbsp
    <input type="radio" name="genuine" value=5><label style="font-size: 16px;">All my attacks</label>&nbsp
    <br><br><span style="font-size: 20px; font-weight: bold;">Other Emotions (Enter what it is in the space. If not, leave it empty and select "None"):</span>&nbsp<input type="text" name="OtherName" id="OtherName" style="width: 150px; border-style: solid; border-width: medium" value="" ><br><br>
    <input type="radio" name="other" value=1><label style="font-size: 16px;">None of my attacks</label>&nbsp
    <input type="radio" name="other" value=2><label style="font-size: 16px;">Rarely</label>&nbsp
    <input type="radio" name="other" value=3><label style="font-size: 16px;">Occasionally</label>&nbsp
    <input type="radio" name="other" value=4><label style="font-size: 16px;">Often</label>&nbsp
    <input type="radio" name="other" value=5><label style="font-size: 16px;">All my attacks</label>&nbsp-->
<br/><br/>

<input type="submit" name="submit" class="btn-style" value="Submit" />
        <input type="hidden" name="timeval" id="timeval" value=0 />
</form>
</div>
</body>
</html>