<?php
    $pwd = getcwd();
    $command = 'cd ' . dirname($pwd) . ' && sudo git pull ';
    $output = shell_exec($command);
    print $output;
?>
