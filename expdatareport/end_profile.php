<?php 
session_start();

include '../class/class.rater.php';
$rater = unserialize(serialize($_SESSION['Rater']));
$info = $rater->getProfile();
$infolist = array('Personal','Professional','Family','Interest');
$profile_type=4;
#var_dump($info);
?>
<!DOCTYPE html>
  <html lang = 'en'>
  <link href="Style.css" rel="stylesheet">

  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <head>

  	<title>Profile</title>
  </head>
  <body>

    <!--Title and score part of the page -->     
    <div id = "wrapper">
    <h1><u>Your Profile in this experiment </u></h1>
<p><b><u>Please carefully read and memorize</u></b> the information to the best of your ability. If it helps, you can note down the profile details for referencing during experiment&nbsp;</p>
<p>Note: It is important you remember the information presented here to maximize your success: making correct judgments on the emails presented to you. For e.g., the information below could help you to understand whether an email could be important and relevant to your profile.</p>
    
<div id = "targetinfo" name = "targetinfo"  style="margin:0px;">
        <h2>Profile Information:</h2>
        <table>
                <tr>
                <?php 
                for ($i = 0;$i<$profile_type;++$i){
                    echo('<th>');
                    echo($infolist[$i]);
                    echo('</th>');
                }
                echo('</tr><tr>');
                for ($i = 0;$i<$profile_type;++$i){
                    echo('<td>');
                    echo($info[$infolist[$i]]);
                    echo('</td>');
                }
                ?>
                </tr>
        </table>
        </div>
                <br>
        <form action="QA.php">
        <input type="submit" name="submit" id="submit" class="btn-style" value="Continue"/>
        </form>

    </div>


</body>
</html>