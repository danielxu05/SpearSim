<?php

echo('hello');
$command = escapeshellcmd('./test.py');
$output = shell_exec($command);
echo $output;

?>
