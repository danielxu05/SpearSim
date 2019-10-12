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
<style type="text/css">
    .vertical-menu {
  width: 2000px; /* Set a width if you like */
}

.vertical-menu a {
  background-color: #eee; /* Grey background color */
  color: black; /* Black text color */
  display: block; /* Make the links appear below each other */
  padding: 20px; /* Add some padding */
  text-decoration: none; /* Remove underline from links */
}

.vertical-menu a:hover {
  background-color: #ccc; /* Dark grey background on mouse-over */
}

.vertical-menu a.active {
  background-color: #4CAF50; /* Add a green color to the "active/current" link */
  color: white;
}
</style>>
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
$_SESSION["MTurkID"]=$_GET["MTId"];
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
$username = trim($pieces[0]);
$password = trim($pieces[1]);
$dbname = trim($pieces[2]);
$conn = new mysqli($servername, $username, $password, $dbname);
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
var_dump($result1)
?>
<h2>Email Management</h2></div>
<div class="vertical-menu">
  <a href="#" class="active">Home</a>
  <a href="#">Email 1</a>
  <a href="#">Email 2</a>
  <a href="#">Email 3</a>
  <a href="#">Email 4</a>
</div>
</body>
</html>