<?php
$TXTfp = fopen("InputDay8.txt", "r");
$GLOBALS['accumulator'] = 0;
if($TXTfp !== FALSE) {
    $arrayInput = array();
    while(! feof($TXTfp)) {
        $data = fgets($TXTfp, 1000);
        if (strlen(trim($data)) !== 0) {
            array_push($arrayInput, $data);
        }
    }
    solve($arrayInput);
}

function solve($arraInput) {
    $visited = array();
    $accumulator = 0;
    $pc = 0;
    $run = true;
    while ($run) {
        $data = explode(" ", trim($arraInput[$pc]));
        array_push($visited, $pc);
        switch ($data[0]) {
            case "nop":
                $pc++;
                break;
            case "acc":
                $accumulator += (int)$data[1];
                $pc++;
                break;
            case "jmp":
                $pc += (int)$data[1];
                break;
        }
        if (in_array($pc, $visited)) {
            $run = false;
            $infinite = true;
        }
    }
    return $accumulator;
}


// Not giving correct result :-( partially done.
function solve1($arraInput) {
    $visited = array();
    $accumulator = 0;
    $pc = 0;
    $run = true;
    $infinite = false;
    do {
        $data = explode(" ", trim($arraInput[$pc]));
        switch ($data[0]) {
            case "nop":
                $pc++;
                break;
            case "acc":
                $accumulator += (int)$data[1];
                $pc++;
                break;
            case "jmp":
                $pc += (int)$data[1];
                break;
        }
        if (in_array($pc, $visited)) {
            if ($data[0] === 'nop') {
                $data[0] = 'jmp';
            } elseif ($data[0] === 'jmp') {
                $data[0] = 'nop';
            }
        }
    } while ($run);

    return $accumulator;
}
fclose($TXTfp);
?>