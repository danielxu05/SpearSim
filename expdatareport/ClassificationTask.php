<?php session_start(); ?>
<html>
<head>
    <link href="Style.css" rel="stylesheet">
    <script src="jquery-3.1.0.min.js"></script>
</head>

<body>
    <script type="text/javascript" src="ckeditor/ckeditor.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $(window).bind("beforeunload", function(){ return(false); });
            var d = new Date();
            document.myForm.starttime.value = d.getTime();
        });
        function onsubmitform() {
            $(window).unbind('beforeunload');
            var d = new Date();
            document.myForm.endtime.value = d.getTime();
        }
    </script>

    <form name="myForm" method="post" action="Final.php" onsubmit="return onsubmitform();">
        <h1>Email Classification Console</h1>
        <input type="hidden" id="starttime" name="starttime" value="">
        <input type="hidden" name="endtime" value="">
        
<?php
include('class.database.php');
$ID = $_SESSION["MTurkID"];
$db = Database::getInstance();
$conn = $db->getConnection(); 
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    echo "Connection Error";
}

$ID = $conn->real_escape_string($ID);
$sql = "UPDATE Rater SET Assigned=1, UserID='$ID' WHERE id IN (SELECT id FROM (SELECT id FROM Rater Where Assigned=0 LIMIT 1) tmp);";
$result = $conn->query($sql);

//get the email list from the row
$sql1 = "SELECT EmailList from Rater WHERE UserID='$ID' ORDER BY ID;";
$result1 = $conn->query($sql1);
$row1 = $result1->fetch_assoc();

//split the string and get the list of IDS
$EmailIDs = explode(",", $row1['EmailList']);
sort($EmailIDs);
$length = count($EmailIDs);

$sql2 = "SELECT ID, Email2, Subject FROM Phishing WHERE ID IN (".implode(',',$EmailIDs).") UNION SELECT ID as ID, Email as Email2, Subject as Subject FROM HamEmail WHERE ID IN (".implode(',',$EmailIDs).") ORDER BY RAND();";
$result2 = $conn->query($sql2);

if ($result2->num_rows > 0) {
    // output data of each row
    $i=1;

    while($row = $result2->fetch_assoc()) {
        //$row = $result1->fetch_assoc();
        //display the email text

        $emailID = $row['ID'];
        //echo $emailID;
        //echo $emailID;
        //echo '<br>';
        $label1 = "Q1_".$emailID;
        $label2 = "Q2_".$emailID;
        $label3 = "Q3_".$emailID;
        $label4 = "Q4_".$emailID;
        $label5 = "T1_".$emailID; //time to answer first question
        $label6 = "T2_".$emailID; //time to rate each e-mail in total

        if($i<2){
            echo "<div id=".$i.">";
        }
        else{
            echo "<div id=".$i." style=\"display:none;\">";
        }

        echo "<label name=\"Subjectline\" id=\"Subjectline\" style=\"font-size:medium;font-weight: bold\">Subject:</label> <input type=\"text\" name=\"Subject\" id=\"Subject\" style=\"width: 500px; border-style: solid; border-width: medium\" value=\"".$row['Subject']."\" readonly>";
        echo "<br>";
        echo "<textarea name=\"email".$i."\" id=\"email".$i."\" rows=\"40\" cols=\"130\" disabled>";
        echo $row['Email2'];
        echo "</textarea>";
        echo "<script type=\"text/javascript\">";
            echo "CKEDITOR.replace('email".$i."');";
        echo "</script>";
        echo "<br>";

        //onclick=\"S2".$i."_click(this.value); return false;\"
        echo "<h3>How would you manage this e-mail?</h3>";
        echo "<label style=\"font-size: 16px;\"><input type=\"radio\" id='".$label1."' name='".$label1."' value=1 >Respond immediately</label> <br>";
        echo "<label style=\"font-size: 16px;\"><input type=\"radio\" id='".$label1."' name='".$label1."' value=2 >Leave the email in the inbox and flag for follow up</label><br>";
        echo "<label style=\"font-size: 16px;\"><input type=\"radio\" id='".$label1."' name='".$label1."' value=3 >leave the email in the inbox</label><br>";
        echo "<label style=\"font-size: 16px;\"><input type=\"radio\" id='".$label1."' name='".$label1."' value=4 >Delete the email</label><br>";
        echo "<label style=\"font-size: 16px;\"><input type=\"radio\" id='".$label1."' name='".$label1."' value=5 >Delete the email and block the sender</label><br>";

        echo "<h3>Rate how confident you are with your recommendation</h3>";
        //echo "<label style=\"font-size: 16px;\">No Confidence</label>&nbsp <input type=\"range\" name='".$label2."' min='0' max='100' value='50' step='1' style=\"width: 600px;\">&nbsp <label style=\"font-size: 16px;\">High Confidence</label>&nbsp";
        //echo "<br><span style='margin-left: 270px'>Moderate Confidence</span>";
        echo "<label style=\"font-size: 16px;\"><input type=\"radio\" id='".$label2."' name='".$label2."' value=1 >No Confidence</label> <br>";
        echo "<label style=\"font-size: 16px;\"><input type=\"radio\" id='".$label2."' name='".$label2."' value=2 >Slight Confidence</label><br>";
        echo "<label style=\"font-size: 16px;\"><input type=\"radio\" id='".$label2."' name='".$label2."' value=3 >Moderate Confidence</label><br>";
        echo "<label style=\"font-size: 16px;\"><input type=\"radio\" id='".$label2."' name='".$label2."' value=4 >High Confidence</label><br>";


        echo "<h3>Select all applicable aspects of this email that influenced your decision</h3>";
        echo "<label style=\"font-size: 16px;\"><input type=\"checkbox\" id='".$label3."' name='".$label3."[]' value=\"important\" >Reads like an important message</label><br>";
        echo "<label style=\"font-size: 16px;\"><input type=\"checkbox\" id='".$label3."' name='".$label3."[]' value=\"work\" >Reads like a work-related message</label><br>";
        echo "<label style=\"font-size: 16px;\"><input type=\"checkbox\" id='".$label3."' name='".$label3."[]' value=\"social\" >Reads like a message from an acquaintance</label><br>";
        echo "<label style=\"font-size: 16px;\"><input type=\"checkbox\" id='".$label3."' name='".$label3."[]' value=\"authority\" >Reads like a legal/government message</label><br>";
        echo "<label style=\"font-size: 16px;\"><input type=\"checkbox\" id='".$label3."' name='".$label3."[]' value=\"status\" >Reads like a status update or reminder</label><br>";
        echo "<label style=\"font-size: 16px;\"><input type=\"checkbox\" id='".$label3."' name='".$label3."[]' value=\"marketing\" >Reads like a marketing e-mail</label><br>";
        echo "<label style=\"font-size: 16px;\"><input type=\"checkbox\" id='".$label3."' name='".$label3."[]' value=\"personal\" >Reads like a message about personal account</label><br>";
        echo "<label style=\"font-size: 16px;\"><input type=\"checkbox\" id='".$label3."' name='".$label3."[]' value=\"spam\" >Reads like a spam message</label><br>";
        echo "<label style=\"font-size: 16px;\"><input type=\"checkbox\" id='".$label3."' name='".$label3."[]' value=\"job\" >Reads like a job opportunity</label><br>";
        echo "<label style=\"font-size: 16px;\"><input type=\"checkbox\" id='".$label3."' name='".$label3."[]' value=\"deadline\" >Message contains a deadline</label><br>";
        echo "<label style=\"font-size: 16px;\"><input type=\"checkbox\" id='".$label3."' name='".$label3."[]' value=\"positive\" >Message contains positive emotion (e.g., curiosity, surprise, excitement)</label><br>";
        echo "<label style=\"font-size: 16px;\"><input type=\"checkbox\" id='".$label3."' name='".$label3."[]' value=\"negative\" >Message contains negative emotion (e.g., fear, panic, threat)</label><br>";
        echo "<label style=\"font-size: 16px;\"><input type=\"checkbox\" id='".$label3."' name='".$label3."[]' value=\"request\" >Message contains request for help</label><br>";
        echo "<label style=\"font-size: 16px;\"><input type=\"checkbox\" id='".$label3."' name='".$label3."[]' value=\"offer\" >Message offers assistance</label><br>";
        echo "<label style=\"font-size: 16px;\"><input type=\"checkbox\" id='".$label3."' name='".$label3."[]' value=\"grammar\" >Contains spelling and grammatical errors</label><br>";
        echo "<label style=\"font-size: 16px;\"><input type=\"checkbox\" id='".$label3."' name='".$label3."[]' value=\"clear\" >Clearly written e-mail</label><br>";
        echo "<label style=\"font-size: 16px;\"><input type=\"checkbox\" id='".$label3."' name='".$label3."[]' value=\"other\" >Other</label><br>";

        //echo "<textarea name='".$label3."' rows=\"9\" cols=\"100\">";
        //echo "</textarea>";
        echo "<br>";
        echo "<br>";

        echo "<input type=\"hidden\" name='".$label4."' value=\"\">";
        echo "<input type=\"hidden\" name='".$label5."' value=\"\">";
        echo "<input type=\"hidden\" name='".$label6."' value=\"\">";

        echo "<button id=\"Button".$i."\" onclick=\"Q".$i."_click(); return false;\" style=\"font-size: large\">";
        echo "Submit";
        echo "</button>";

        echo "</div>";

        $n = $i + 1;

        //Echo the script

        if($i<$length){
            echo "<script type=\"text/javascript\">";
                echo "function Q".$i."_click(){";
                    echo "if (document.myForm.".$label1.".value == false || document.myForm.".$label2.".value == false || ($('input[name=\"".$label3."[]\"]:checked').length == 0) ) {";
                        echo "alert(\"Please answer all the question to proceed\");";
                        echo "return false;";
                    echo "} else {";
                        //save value to the corresponding hidden variable
                        //close this div
                        echo "var d = new Date();";
                        echo "var curt = d.getTime();";
                        echo "var tdiff = curt-$(\"#starttime\").val();";
                        echo "document.myForm.".$label6.".value = tdiff;";
                        echo "$(\"#starttime\").val(curt);";
                        echo "$(\"#".$i."\").hide();";
                        //show the next div
                        echo "$(\"#".$n."\").show();";
                        echo "window.scrollTo(0, 0);";
                echo "} }";

              //  echo "function S2".$i."_click(phish){";
              //      echo "var d = new Date();";
              //      echo "document.myForm.".$label5.".value = d.getTime();";
              //      echo "document.myForm.".$label4.".value = phish;";
                   // echo "document.getElementById(\"".$label1."\").disabled=true;";
                    //echo "$(\"#S1_".$i."\").hide();";
                    //show the next div
                    //echo "$(\"#S2_".$i."\").show();";
              //  echo "}";

            echo "</script>";
        }
        else{
            //echo the button for the form
            echo "<script type=\"text/javascript\">";
                echo "function Q".$i."_click(){";
                    echo "if (document.myForm.".$label1.".value == false || document.myForm.".$label2.".value == false || ($('input[name=\"".$label3."[]\"]:checked').length == 0) ) {";
                        echo "alert(\"Please answer the question to proceed\");";
                        echo "return false;";
                    echo "} else {";
                        //save value to the corresponding hidden variable
                        //echo "$(\"#".$label2."\").val(1);";
                        //close this div
                        echo "var d = new Date();";
                        echo "var curt = d.getTime();";
                        echo "var tdiff = curt-$(\"#starttime\").val();";
                        echo "document.myForm.".$label6.".value = tdiff;";
                        echo "$(\"#starttime\").val(curt);";
                        echo "$(\"#".$i."\").hide();";
                        //show the next div
                        echo "$(\"#submit_h3\").show();";
                        echo "$(\"#submit\").show();";
                        echo "window.scrollTo(0, 0);";
                echo "} }";

             //   echo "function S2".$i."_click(phish){";
             //       echo "var d = new Date();";
             //       echo "document.myForm.".$label5.".value = d.getTime();";
             //       echo "document.myForm.".$label4.".value = phish;";
                    //echo "document.getElementById(\"".$label1."\").disabled=true;";
                    //echo "$(\"#S1_".$i."\").hide();";
                    //show the next div
                    //echo "$(\"#S2_".$i."\").show();";
             //   echo "}";
            echo "</script>";
        }
        $i +=1;
    }
} else {
    echo "No results were returned";
}
echo "<br><h3 name=\"submit_h3\" id=\"submit_h3\"  style=\"display:none;\">Click Below to complete the study</h3> <br><input type=\"submit\" name=\"submit\" id=\"submit\" class=\"btn-style\" value=\"Submit\" style=\"display:none;\" />";
$conn->close();
?>

</form>
</body>
</html>