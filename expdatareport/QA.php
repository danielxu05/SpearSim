<?php 
session_start();
include '../class/class.rater.php';

$rater = unserialize(serialize($_SESSION['Rater']));
$info = $rater->getProfile();
?>
<style>
.button{
  background-color: #555555;
  border: none;
  color: white;
  padding: 10px 16px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
}
</style>
<link href="Style.css" rel="stylesheet">

<script type="text/javascript">
var name = '<?php echo($info['Name']);?>';
var bank = '<?php echo($info['Bank']);?>';
var birth = '<?php echo($info['Birth']);?>';
function validateForm()	{
	var goal_array = document.getElementsByName('goal');
	var points_array = document.getElementsByName('points');
	var name_array = document.getElementsByName('name');
	var position_array= document.getElementsByName('position');
	var goal_filled = false;
	var points_filled = false;
	var name_filled = false;
	var position_filled = false;
	if (goal_array[0].checked || goal_array[1].checked || goal_array[2].checked ||goal_array[3].checked){ goal_filled= true } 
	if (points_array[0].checked || points_array[1].checked || points_array[2].checked|| points_array[3].checked){ points_filled= true	}
	if (name_array[0].checked || name_array[1].checked || name_array[2].checked|| name_array[3].checked){ diff_filled= true	}
	if (position_array[0].checked || position_array[1].checked || position_array[2].checked|| position_array[3].checked){ position_filled= true	}
	if (!(goal_filled && points_filled && diff_filled && position_filled)) { 
		alert('Please answer all the questions.');
		return false;
	}
}
function displayQuestion1()	{
	var val = "";
	var val_array = document.getElementsByName('name');
	for (var i=0; i < val_array.length; i++)	{
		if (val_array[i].checked)
			val = val_array[i].value;
	}
	if(val=='1')
		{
		document.getElementById('q1_answer').style.display = "block";
		}
		else
		{
			document.getElementById('q1_answer').style.color = "red";

			document.getElementById('q1_answer').style.display = "block";
		}
	
	if(val_array[0].checked)
	{document.getElementById("name2").disabled=true;
	document.getElementById("name3").disabled=true;
	document.getElementById("name4").disabled=true;}
	
	if(val_array[1].checked)
	{document.getElementById("name1").disabled=true;
	document.getElementById("name3").disabled=true;
	document.getElementById("name4").disabled=true;}
	
	if(val_array[2].checked)
	{document.getElementById("name1").disabled=true;
	document.getElementById("name2").disabled=true;
	document.getElementById("name4").disabled=true;}

	if(val_array[3].checked)
	{document.getElementById("name1").disabled=true;
	document.getElementById("name2").disabled=true;
	document.getElementById("name3").disabled=true;}
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
	if(val==birth)
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
	document.getElementById("points3").disabled=true;
	}
}

function displayQuestion3()	{
	var val = "";
	var val_array = document.getElementsByName('goal');
	for (var i=0; i < val_array.length; i++)	{
		if (val_array[i].checked)
			val = val_array[i].value;
	}
	if(val==bank)
		{
		document.getElementById('q3_answer').style.display = "block";
		}
		else
		{
			document.getElementById('q3_answer').style.color = "red";
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


function displayQuestion4()	{
	var val_array = document.getElementsByName('position');
	if(val_array[3].checked)
		{
		document.getElementById('q4_answer').style.display = "block";
		}
		else
		{
			document.getElementById('q4_answer').style.color = "red";
			document.getElementById('q4_answer').style.display = "block";
		}
		if(val_array[0].checked)
	{document.getElementById("p3").disabled=true;
    document.getElementById("p2").disabled=true;
    document.getElementById("p4").disabled=true;}
	
	if(val_array[1].checked)
	{document.getElementById("p1").disabled=true;
    document.getElementById("p3").disabled=true;
    document.getElementById("p4").disabled=true;}
	
	if(val_array[2].checked)
	{document.getElementById("p1").disabled=true;
    document.getElementById("p2").disabled=true;
    document.getElementById("p4").disabled=true;}

    if(val_array[3].checked)
	{document.getElementById("p1").disabled=true;
    document.getElementById("p2").disabled=true;
    document.getElementById("p3").disabled=true;}
}
				
</script>


<html>
<body>



<form action="ExperinmentBlock.php" method="post" onsubmit="return validateForm()">
	
	<table border="1" cellpadding="10" cellspacing="0" style="width: 810px;" align="center">
		<tr>
		<td>
		<div align="center">
		<h2>Questionnaire about instructions</h2>
	</div>
			<div align="justify">	
				
				<b><label style="color:#444499;">Q1. What is your primary task in this study?</label></b><br>
				<input type="radio" id="name1" name="name" value="1" onclick="displayQuestion1()"> Process emails on behalf of <?php echo($info['Name']);?>
				<br>
				<input type="radio" id="name2" name="name" value="2" onclick="displayQuestion1()">Watching video on behalf of <?php echo($info['Name']);?>
				<br>
				<input type="radio" id="name3" name="name" value="3" onclick="displayQuestion1()">Writing emails on behalf of <?php echo($info['Name']);?>
				<br>
				<input type="radio" id="name4" name="name" value="4" onclick="displayQuestion1()">Process bank statement on behalf of <?php echo($info['Name']);?>
				<br>
				<div id="q1_answer" style="color:green;display:none">The correct answer is: You will be reading <?php echo($info['Name']);?>'s email and make decision on that</div>
				<br> <br>
				

				<b><label style="color:#444499;">Q2. What is <?php echo($info['Name']);?> Brithday?</label></b><br>
				<input type="radio" id= "points1" name="points" value="March 1976" onclick="displayQuestion2()">	In March 1976
				<br>
				<input type="radio"  id= "points2" name="points" value="June 1978" onclick="displayQuestion2()">	In June 1978
				<br>
                <input type="radio"  id= "points3" name="points" value="September 1975" onclick="displayQuestion2()"> In September 1975
				<br>
                <input type="radio"  id= "points4" name="points" value="January 1977" onclick="displayQuestion2()">	In January 1977

				<div id="q2_answer" style="color:green;display:none"><?php echo($info['Name'].'\'s birthday is in '.$info['Birth']);?></div>
				
				<br><br>			

			
				<b><label style="color:#444499;">Q3. Where does <?php echo($info['Name']);?> have all his bank accounts? </label></b><br>
				<input type="radio" id="goal1" name="goal" value="Chase" onclick="displayQuestion3()">	Chase Bank
				<br>
				<input type="radio" id="goal2" name="goal" value="Wells Forgo" onclick="displayQuestion3()">	Wells Forgo
				<br>
				<input type="radio" id="goal3" name="goal" value="Bank of Amercia" onclick="displayQuestion3()">	Bank of Amercia
                <br>
                <input type="radio" id="goal4" name="goal" value="Citi Bank" onclick="displayQuestion3()">	Citi Bank

				<br>
                <div id="q3_answer" style="color:green;display:none"><?php echo($info['Name'].'\'s bank accounts are in '.$info['Bank']);?></div>
				<br>

				<b><label style="color:#444499;">Q4. Where does <?php echo($info['Name']);?> work and in what position? </label></b><br>
				<input type="radio" id="p1" name="position" value="1" onclick="displayQuestion4()">	Software Engineer at Enron
				<br>
				<input type="radio" id="p2" name="position" value="2" onclick="displayQuestion4()">	Senior Analyst at Exxon
				<br>
				<input type="radio" id="p3" name="position" value="3" onclick="displayQuestion4()">	Junior Analyst at Enron
                <br>
                <input type="radio" id="p4" name="position" value="4" onclick="displayQuestion4()">	Senior Analyst at Enron

                <div id="q4_answer" style="color:green;display:none"><?php echo($info['Name'].' works in Enron as Senior Analyst.');?> </div>				
				<br><br>
			</div>
			<div align="center">
			<center><button name="submit"  class="btn-style" type="submit" >Submit</button> </center>
			</div>
	

		</td>
		</tr>
		</table>
</form>
<br><br><br><br>

</body>
</html>
