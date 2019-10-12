<?php
session_start();
?>
<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="Style.css">
    <script src="jquery-3.1.0.min.js"></script>
</head>
<script type="text/javascript">
    $(document).ready(function(){
        $(window).bind("beforeunload", function(){ return(false); });
    });
</script>
<body>
<script type="text/javascript">
    function validate()
    {
        var txt = "";
        if( document.myForm.age.value == false  )
        {
            alert( "Please provide your age" );
            return false;
        }

        if( document.myForm.Gender.value == false  )
        {
            alert( "Please answer the question on gender" );
            return false;
        }

        if( document.myForm.English.value == false )
        {
            alert( "Please answer the question on english nativity" );
            return false;
        }

        var val = document.myForm.Native.value;

        if(val==null || val.trim()==""){
            alert( "Please provide your native language " );
            return false;
        }
        if( document.myForm.Prof.value == false )
        {
            alert( "Please rate your english writing proficiency" );
            return false;
        }
        for (i = 0; i < document.myForm.age.length; i++) {
            if (document.myForm.age[i].checked) {
                txt = document.myForm.age[i].value;
            }
        }
        if ( txt === "lt18"){ //exclusion criteria
            $(window).unbind('beforeunload');
            document.getElementById('start').style.display = "none";
            document.getElementById('catnum12').innerHTML = "We are sorry to hear that you don't qualify to participate in our experiment (Underage). \nThank You for your interest";
            return false;
        }
        $(window).unbind('beforeunload');
    }
</script>

<?php
$MTId= $_GET["MTId"];
$_SESSION["workerId"] = $MTId;
echo $_SESSION['workerId'];
print_r($_SESSION);

$_SESSION["Manipulation"]=0;

$rand = mt_rand(1,10000)/10000;
$result = "Intro.php";
$rand = 0.8; //making creativity test for everyone
//Based on the random number, choose the next step
if($rand<0.51) {
    $result = "CreativityTest.php";
    $_SESSION["Manipulation"]=1;
}
else {
    $result = "Intro.php";
    $_SESSION["Manipulation"]=0;
}

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
#echo $line;

$pieces = explode("+",$line);
$servername = "localhost";
$username = trim( $pieces[0]);
$password = trim($pieces[1]);
$dbname = trim($pieces[2]);
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$type = array('Facebook','Twitter','LinkedIn');
$sql = "SELECT profile_type,COUNT(profile_type)AS Frequency 
        FROM AttackerType 
        GROUP BY profile_type
        ORDER BY 
        COUNT(profile_type)";
$result2 = $conn->query($sql);
if ($result2->num_rows<=2){
    $attack_type = $type[mt_rand(0,2)];
    echo(1);
}else {
    $attack_type = $result2->fetch_assoc()['profile_type'];
}
var_dump($result2);
##When a new attack start, it will generate the profile type based on the exsisting number of profile type to 
##keep the uniform distribution for prfile type
$sql = "INSERT INTO AttackerType (UserID, profile_type) VALUES ('".$_SESSION['workerId']."', '".$attack_type."');";
echo $sql;
if ($conn->query($sql) === TRUE) {
     "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}


$sql = "SELECT UserID FROM Participant Where UserId='".$_SESSION["workerId"]."'";
$result1 = $conn->query($sql);
if ($result1->num_rows > 0) {
    header('Location: Error.html');
}
$conn->close();
?>
<label id="catnum12" style="font-size:x-large; color:black; font-style:italic;" ></label>
<div id="start">
<form name="myForm" method="get" onsubmit="return validate();" action=<?php echo $result;?>>
    <h3>What is your age?</h3>
    <label style="font-size: medium;"><input type="radio" name="age" value="lt18"/> Less than 18<br/></label>
    <label style="font-size: medium;"><input type="radio" name="age" value="18-25"/> 18-25<br/></label>
    <label style="font-size: medium;"><input type="radio" name="age" value="26-35"/> 26-35<br/></label>
    <label style="font-size: medium;"><input type="radio" name="age" value="36-45"/> 36-45<br/></label>
    <label style="font-size: medium;"><input type="radio" name="age" value="46-55"/> 46-55<br/></label>
    <label style="font-size: medium;"><input type="radio" name="age" value="56-65"/> 56-65<br/></label>
    <label style="font-size: medium;"><input type="radio" name="age" value="66-75"/> 66-75<br/></label>
    <label style="font-size: medium;"><input type="radio" name="age" value="75+"/> 76 and above<br/></label>
    <hr>

    <h3>Which of the following describes how you think of yourself?</h3>
    <label style="font-size: medium;"><input type="radio" name="Gender" value="F"/> Female<br/></label>
    <label style="font-size: medium;"><input type="radio" name="Gender" value="M"/> Male<br/></label>
    <label style="font-size: medium;"><input type="radio" name="Gender" value="I"/> Other<br/></label>
    <label style="font-size: medium;"><input type="radio" name="Gender" value="N"/> Prefer not to say<br/></label>
    <hr>

    <h3>Are you a native English speaker?</h3>
    <label style="font-size: medium;"><input type="radio" name="English" value=1 /> Yes<br/></label>
    <label style="font-size: medium;"><input type="radio" name="English" value=2 /> No<br/></label>
    <hr>

    <h3>If you answered <i>no</i> to the previous question, Please provide your native language (mother tongue). If you answered <i>yes</i>, please write "English"</h3>
    <input type="text" name="Native" id="Native" cols="50" style="border-style: solid; border-width: medium" value=""><br>
    <hr>

    <h3>Please rate your English writing proficiency using the below scale</h3>
    <label style="font-size: medium;"><input type="radio" name="Prof" value=6 /><b>Very Advanced:</b> I can write with perfect grammar, and always convey my thoughts clearly <br/></label>
        <label style="font-size: medium;"><input type="radio" name="Prof" value=5 /><b>Advanced:</b> I can write very well using appropriate grammar but may still make mistakes and fail to convey my thoughts occasionally.	<br/></label>
            <label style="font-size: medium;"><input type="radio" name="Prof" value=4 /><b>Intermediate:</b> I can write reasonably well and can use basic tenses but have problems with more complex grammar and vocabulary.	<br/></label>
                <label style="font-size: medium;"><input type="radio" name="Prof" value=3 /><b>Low Intermediate:</b> I can make simple sentences and can convey the main points of a conversation but need much more vocabulary.	<br/></label>
                    <label style="font-size: medium;"><input type="radio" name="Prof" value=2 /><b>Elementary:</b> I can write simple and short sentences only <br/></label>
                        <label style="font-size: medium;"><input type="radio" name="Prof" value=1 /><b>Beginner:</b> I can write a few words and partial sentences in English.<br/></label>

    <br/><br/>
    <input type="submit" name="submit" class="btn-style" value="Submit">
</form>
</div>
</body>
</html>