<!DOCTYPE html>
<html>
<head>
	<title>Reward</title>
	<link href="./expdatareport/Style.css" rel="stylesheet">
</head>
<body>
<form name="myForm" method="post" onsubmit="return validate();" action = 'ShowReward.php'>

	<div id = 'wrapper' style="font-size:25px">

    <p><b>Please enter the following information to collect your reward for the experinment</b></p>
    <p><b>UW email:</b></p><input type ="text" id = "Email" name = 'Email'cols="50" style="border-style: solid; border-width: medium" value = ""><br>
    <p><b>Credencial code in Experinment:</b></p><input type ="text" id = "code" name = 'code' cols="50" style="border-style: solid; border-width: medium" value = ""><br>
    <input type="submit" name="submit" class="btn-style" value="Submit">
    </div>
    
</form>

</body>
<script>
function validate(){

}
</script>
</html>