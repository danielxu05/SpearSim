<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title></title>
    <link rel="stylesheet" type="text/css" href="Style.css">
    <script src="jquery-3.1.0.min.js"></script>
    <script src="jquery.countdown.js"></script>
    <meta charset="UTF-8">
    <meta name="description" content="Attacker Experiment">
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
<?php
session_start();
#echo $_SESSION['workerid'];
print_r($_SESSION);


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
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO Demographics (UserID, Age, Gender, NativeEnglish, EnglishProf, NativeLanguage) VALUES('" . $_SESSION["UserID"] . "','" . $_GET['age'] . "','" . $_GET['Gender'] . "'," . $_GET['English'] . "," . $_GET['Prof'] . ",'" . $_GET['Native'] . "')";
echo $sql;
if ($conn->query($sql) === TRUE) {
    # "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();

?>
<body>
<div id="main">
    <IMG BORDER="1" SRC="wood.png",height="80" width="130" />
    <h1>List as many alternative uses for a <i>"plank of wood"</i> as you can think of in two minutes</h1>
    <h3>Think creatively. Your performance in this task is crucial to your overall performance in the experiment.</h3>
    <h3>Repeating uses will affect your performance</h3>
    <h4> (Note: After two minutes, you won't be able to make any changes in this screen) </h4>
    <span style="font-weight: bold; font-size: large; color: darkgoldenrod;"> Click <i>"Add Another Use"</i> to add more uses</span>
<br>   
    Time Remaining:
    <span id="clock"></span>
    <script type="text/javascript">
        var fiveSeconds = new Date().getTime() + 10;
        $('#clock').countdown(fiveSeconds, function(event) {
            $(this).html(event.strftime('%M:%S'));
        }).on('finish.countdown', function(event) {
            $('input[type="text"]').prop("readonly", true);
            $('input[type="submit"]').prop("disabled", false);
            $('input[type="submit"]').prop("hidden", false);
            $('a').prop("hidden", true);
        });
    </script>
    <div class="my-form">
        <form name="myform" role="form" method="get" action="Intro.php" onsubmit="return onsubmitform();">
            <p class="text-box">
                <label for="box1">Use <span class="box-number">1</span></label>
                <input type="text" name="boxes[]" value="" id="box1" />
            </p>
            <a class="add-box" href="#">Add Another Use</a>
            <br />
            <br />
            <p><input type="submit" value="Submit" disabled="True" hidden="True" /></p>
            <br />
            <br />
        </form>
    </div>
</div>
<script type="text/javascript"> 
    jQuery(document).ready(function($){
        $('.my-form .add-box').click(function(){
            var n = $('.text-box').length + 1;
            var box_html = $('<p class="text-box"><label for="box' + n + '">Use <span class="box-number">' + n + '</span></label> <input type="text" name="boxes[]" value="" id="box' + n + '" /> <a href="#" class="remove-box">Remove</a></p>');
            box_html.hide();
            $('.my-form p.text-box:last').after(box_html);
            box_html.fadeIn('slow');
            return false;
        });
        $('.my-form').on('click', '.remove-box', function(){
            $(this).parent().css( 'background-color', '#FF6C6C' );
            $(this).parent().fadeOut("slow", function() {
                $(this).remove();
                $('.box-number').each(function(index){
                    $(this).text( index + 1 );
                });
            });
            return false;
        });
    });
</script>
</body>
</html>