
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
  width: 400px;
  background-color: grey;
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
include('../class/class.database.php');
$db = Database::getInstance();
$conn = $db->getConnection(); 
$sql = "SELECT * FROM Email";
$result = $conn->query($sql);
echo '<form action = "Simulation.php" method = "POST">';
while($row = $result->fetch_assoc()) {
	echo '<div class="tooltip">';
  echo '<input type="text" value = "'.$row['Subject'].'">';
  echo '<input type = "submit" name = TempleteID value = '.$row['id'].'>';
	echo '<span class="tooltiptext">'.$row['Email'].'</span>';
	echo "</div>";
	echo "<br>";
}
echo "</form>";

?>

</body>
</html>





