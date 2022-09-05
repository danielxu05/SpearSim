<?php
include '../class/class.database.php';
$db = Database::getInstance();
$conn = $db->getConnection(); 
echo("data base connection is working!")
?>