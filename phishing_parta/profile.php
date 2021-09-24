<?php session_start();?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns="http://www.w3.org/1999/html">
<head>
    <title>Profile</title>
    <link href="Style.css" rel="stylesheet">
    <script src="jquery-3.1.0.min.js"></script>
    <meta charset="UTF-8">
</head>
<title>Profile</title>
<script>
function functionAlert(msg, myYes) {
    var confirmBox = $("#confirm");
    confirmBox.find(".message").text(msg);
    confirmBox.find(".yes").unbind().click(function() {
        confirmBox.hide();
    });
    confirmBox.find(".yes").click(myYes);
    confirmBox.show();
}
    functionAlert('WOW', 'Next');
//alert('You ');
jAlert('Serial number is not submitted', 'Error Message', 'true');

</script>



<body>
<div>
<h2>Target Profile</h2>
</div>
<?php
#print_r($_SESSION);
include('../class/class.attacker.php');
#need unserialize and serialize the object variable from session. 
#var_dump($_SESSION['User']);
$attacker = unserialize (serialize ($_SESSION['User']));
$type = $attacker->getProfileType();
if ($type == '1'){
    echo "Experinment 1";
}elseif ($type=='2') {
    echo "Experinment 2";
}elseif ($type == '3') {
    echo "Experinment 3";
}
$array = array(0,1,2);
shuffle($array);
$_SESSION['goalorder'] = $array;
print_r($array);
shuffle($array);
$_SESSION['targetorder'] =$array;
print_r($array);
$info = $attacker->getTargetprofile(0);
?>
<style>
    table {width:100%;padding: 20px;    border-radius : 3px;}
    td {  padding: 20px;background-color: #f1f1f1;height: 300px; width: 300px;   border-style: solid;
  text-align:center;}
    </style>
<table>
<br>
  <tr>
    <th>Basic Demographics</th>
    <th>Professional</th>
    <th>Family</th>
    <th>Interest</th>
  </tr>
  <tr>
    <td><?php echo($info['Personal']);?></td>
    <td><?php echo($info['Professional']);?></td>
    <td><?php echo($info['Family']);?></td>
    <td><?php echo($info['Interest']);?></td>
  </tr>
</table>
<div>
   <div class ="row">
        <div class="column">
            <article>
            <p>Basic Demographics</p>
                <?php echo($info['Personal']);?>
            </article>
        </div>
        <div class="column">

            <article>
            <p>Professional</p>

            <?php echo($info['Professional']);?>

            </article>
        </div>
    </div>
    <div class='row'>
        <div class="column">
            <article>
            <p>Family</p>

            <?php echo($info['Family']);?>

            </article>
        </div>
        <div class = 'column'>
            <article>
            <p>Interest</p>
            <?php echo($info['Interest']);?>

            </article>
        </div>
    </div>
</div>
<br>
<form method="get" action="ExperimentBlock.php">
<input type="submit" name="submit" class="btn-style" value="Practice"/>
</form>

</body>

</html>




