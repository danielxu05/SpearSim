<?php
session_start();
?>
<head>
<link rel="stylesheet" type="text/css" href="Style.css">
</head>

<script type="text/javascript">

function validateForm()	{
	var goal_array = document.getElementsByName('goal');
	var points_array = document.getElementsByName('points');
	var diff_array = document.getElementsByName('diff');
	var goal_filled = false;
	var points_filled = false;
	var diff_filled = false;
	if (goal_array[0].checked || goal_array[1].checked|| goal_array[2].checked|| goal_array[3].checked){ goal_filled= true } 
	if (points_array[0].checked || points_array[1].checked || points_array[2].checked|| points_array[3].checked){ points_filled= true	}
	if (diff_array[0].checked || diff_array[1].checked){ diff_filled= true	}
	if (!(goal_filled && points_filled && diff_filled)) { 
		alert('Please answer all the questions.');
		return false;
	}
	
		
}
</script>

<script>
function displayQuestion1()	{
	var val = "";
	var val_array = document.getElementsByName('diff');
	for (var i=0; i < val_array.length; i++)	{
		if (val_array[i].checked)
			val = val_array[i].value;
	}
	if(val_array[1].checked)
		{
		document.getElementById('q1_answer').style.color = "red";
		document.getElementById('q1_answer').style.display = "block";
		}
		else
		{
			document.getElementById('q1_answer').style.display = "block";
		}
	
	if(val_array[0].checked)
	{document.getElementById("diff2").disabled=true;}
	
	if(val_array[1].checked)
	{document.getElementById("diff1").disabled=true;}

}
				
</script>

<script>

function displayQuestion2()	{
	var val = "";
	
	var val_array = document.getElementsByName('points');
	
	for (var i=0; i < val_array.length; i++)	{
		if (val_array[i].checked)
			val = val_array[i].value;
	}
	if(val_array[2].checked)
		{

		document.getElementById('q2_answer').style.display = "block";
		}
		else
		{
			document.getElementById('q2_answer').style.color = "red";
			document.getElementById('q2_answer').style.display = "block";
		}
	
	if(val_array[0].checked)
	{document.getElementById("points2").disabled=true;
	document.getElementById("points3").disabled=true;
	document.getElementById("points4").disabled=true;}
	
	if(val_array[1].checked)
	{document.getElementById("points1").disabled=true;
	document.getElementById("points3").disabled=true;
	document.getElementById("points4").disabled=true;}
	
	if(val_array[2].checked)
	{document.getElementById("points1").disabled=true;
	document.getElementById("points2").disabled=true;
	document.getElementById("points4").disabled=true;}
	 
	if(val_array[3].checked)
	{document.getElementById("points1").disabled=true;
	document.getElementById("points2").disabled=true;
	document.getElementById("points3").disabled=true;}
}
				
</script>

<script>
function displayQuestion3()	{
	var val = "";
	var val_array = document.getElementsByName('goal');
	for (var i=0; i < val_array.length; i++)	{
		if (val_array[i].checked)
			val = val_array[i].value;
	}
	if(val_array[0].checked ||val_array[1].checked || val_array[3].checked)
		{
		document.getElementById('q3_answer').style.color = "red";
		document.getElementById('q3_answer').style.display = "block";
		}
		else
		{
			document.getElementById('q3_answer').style.display = "block";
		}
		if(val_array[0].checked)
	{document.getElementById("goal2").disabled=true;
    document.getElementById("goal3").disabled=true;
    document.getElementById("goal4").disabled=true;}
	
	if(val_array[1].checked)
	{document.getElementById("goal1").disabled=true;
    document.getElementById("goal3").disabled=true;
    document.getElementById("goal4").disabled=true;}
	
	if(val_array[2].checked)
	{document.getElementById("goal1").disabled=true;
    document.getElementById("goal2").disabled=true;
    document.getElementById("goal4").disabled=true;}

    if(val_array[3].checked)
	{document.getElementById("goal1").disabled=true;
    document.getElementById("goal2").disabled=true;
    document.getElementById("goal3").disabled=true;}
}
				
</script>


<html>
<body>



<form action="ExperimentBlock.php" method="post" onsubmit="return validateForm()">
	
	<table border="1" cellpadding="10" cellspacing="0" style="width: 810px;" align="center">
		<tr>
		<td>
		<div align="center">
		<h2>Questionnaire about instructions</h2>
	</div>
			<div align="justify">	
				
				<b><label style="color:#444499;">Q1. You will target <u>one</u> end-user in each trial?</label></b><br>
				<input type="radio" id="diff1" name="diff" value="1" onclick="displayQuestion1()"> True
				<br>
				<input type="radio" id="diff2" name="diff" value="2" onclick="displayQuestion1()"> False
				<br>
				<div id="q1_answer" style="color:green;display:none">You will only target <u>one</u> end-user in each trial.</div>
				<br> <br>
				

				<b><label style="color:#444499;">Q2. What of the following <u>will not be available</u> to you in each trial?</label></b><br>
				<input type="radio" id= "points1" name="points" value="1" onclick="displayQuestion2()">	Personal Information about the target
				<br>
				<input type="radio"  id= "points2" name="points" value="2" onclick="displayQuestion2()">	Phishing objective to achieve in that trial
				<br>
                <input type="radio"  id= "points3" name="points" value="3" onclick="displayQuestion2()">  Video of target’s current activities<br>
                <input type="radio"  id= "points4" name="points" value="4" onclick="displayQuestion2()">	Sample phishing email or email from the previous attempt

				<div id="q2_answer" style="color:green;display:none">Video of target’s current activities will not be provided to you</div>
				
				<br><br>			

			
				<b><label style="color:#444499;">Q3. Which of the following is <u>not a good strategy</u> to maximize your chance of success? </label></b><br>
				<input type="radio" id="goal1" name="goal" value="1" onclick="displayQuestion3()">	Use information about the target to personalize the attack
				<br>
				<input type="radio" id="goal2" name="goal" value="2" onclick="displayQuestion3()">	Being creative with your phishing story
				<br>
				<input type="radio" id="goal3" name="goal" value="3" onclick="displayQuestion3()">	Use the sample phishing email as it is
                <br>
                <input type="radio" id="goal4" name="goal" value="4" onclick="displayQuestion3()">	Change your phishing email content in each trial

                <div id="q3_answer" style="color:green;display:none">You should not use the sample phishing email as it is </div>
				
				<br><br>
			</div>
			<div align="center">
				<center><button name="submit"  class="btn-style" type="submit" onclick="validateForm()" >Submit</button> </center>
			</div>
	

		</td>
		</tr>
		</table>
</form>
<br><br><br><br>

</body>
</html>
