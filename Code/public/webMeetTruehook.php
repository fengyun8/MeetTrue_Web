<?php
    $pwd = getcwd();
    $command = 'cd ' . dirname($pwd) . ' && sudo git pull && npm install && gulp';
    $output = shell_exec($command);
    print $output;
?>
