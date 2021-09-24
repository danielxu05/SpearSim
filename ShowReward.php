<?php
session_start();
include('./class/class.database.php');
$db = Database::getInstance();
$conn = $db->getConnection(); 
$sql = "SELECT * from attacker WHERE UserID = '".$_POST['Email']."'";
$sql2 = "SELECT * from rater WHERE UserID ='". $_POST["Email"]."'";
$resultattackertable = $conn->query($sql);#->fetch_assoc();
$resultratertable = $conn->query($sql2);#->fetch_assoc();
$status = 1;
if ($resultattackertable){
    $result = $resultattackertable->fetch_assoc();
    $result['Role'] = 'Attacker';
}elseif($resultratertable){
    $result = $resultratertable->fetch_assoc();
    $result['Role'] = 'Rater';
}else{
    $status = 0;#not right id or not right user id 
}

function calReward($result){
    $base = 3;
    $wait = 1;
    $TrainBonus = 2;
    $CompletionBonus = 2;
    $pay = 0;
    $pay = $pay + $base + $wait * floatval($result['Waittime'])/300;
        #the user not left
    if ($result['Status'] == '1'){#user complete the experinment
        $pay =$pay + $CompletionBonus;
        if ($result['Role']=='Attacker'){
            $prefBonus = intval($result['Earn'])/1000;
            return  $pay + $prefBonus;
        }
        else{#end user
            $prefBonus = intval($result['Earn'])/100*9/120;
            $pay = $pay+ $prefBonus;
            return round($pay,2);
        }
    }elseif($result['Status'] == '2'){#user end because others left
        return round($pay,2) ;
    }
}
$payment = calReward($result);
var_dump($payment);

function minCoins($coins, $m, $V) { 
      
// base case 
if ($V == 0) return 0; 
  
// Initialize result 
$res = PHP_INT_MAX; 
  
// Try every coin that has 
// smaller value than V 
for ($i = 0; $i < $m; $i++) 
{ 
    if ($coins[$i] <= $V) 
    { 
        $sub_res = minCoins($coins, $m, $V - $coins[$i]); 
        // Check for INT_MAX to  
        // avoid overflow and see 
        // if result can minimized 
        if ($sub_res != PHP_INT_MAX &&  
            $sub_res + 1 < $res) 
            $res = $sub_res + 1; 
    } 
} 
return $res; 
} 
$coins = array(10, 5, 2, 1); 
$m = sizeof($coins); 
$Cardsneed = minCoins($coins,$m,$payment);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Reward</title>
    <script src="jquery-3.1.0.min.js"></script>

	<link href="./expdatareport/Style.css" rel="stylesheet">
</head>
<body>
	<div id = 'wrapper' style="font-size:25px">
    <div id ='Reward' name = 'Reward'>
    <p><b>Your Reward</b></p>
    <p>You will be paid $ <?php echo($payment);?></p>
    <table>
        <tr>
            <th>Amount</th><th>Tango Card URL</th>        
        </tr>
        <tr><td>$15</td><td>www.google.com</td></tr>
        <tr><td>$1</td><td>www.google.comdeded</td></tr>

        </table>
</div>
<!--

<div id = 'sorry' name = 'sorry'>
    <p><b>Cases in not founding the user ID</b></p>
    <p>Sorry, we cannot find your record for participated our experinment. If you think this is a mistake, please email brics@uw.edu</p>
</div>
-->
</div>

</body>
<script>
$(document).ready(function(){

})
</script>
</html>