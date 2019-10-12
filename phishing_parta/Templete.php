
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Templete</title>
</head>
<style type="text/css">
/* Tooltip container */
.tooltip {
  position: relative;
  display: inline-block;
  border-bottom: 1px dotted black; /* If you want dots under the hoverable text */
}

/* Tooltip text */
.tooltip .tooltiptext {
  visibility: hidden;
  width: 120px;
  background-color: black;
  color: #fff;
  text-align: center;
  padding: 5px 0;
  border-radius: 6px;
 
  /* Position the tooltip text - see examples below! */
  position: absolute;
  z-index: 1;
}
/* Show the tooltip text when you mouse over the tooltip container */
.tooltip:hover .tooltiptext {
  visibility: visible;
}
  }
}
</style>
<body>
<h2>Templete Selection</h2>
<h4>Choose a Templete you are willing to use to generate the email</h4>

<?php
$templearray = array('Templete1' => "amazing story",
					'Templete2' => "terrifying",
					'Templete3' => "what a nic story",
					'Templete4' => "cool",
					'Templete5' => "s",
					'Templete6' => "hahah"
);
foreach($templearray as $t => $value){
	echo '<div class="tooltip">';
	echo '<a href="Simulation.php">'.$t.'</a>';
	echo '<span class="tooltiptext">'.$templearray[$t].'</span>';
	echo "</div>";
	echo "<br>";
}
?>

</body>
</html>





