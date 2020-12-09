<?php
$TXTfp = fopen("InputDay9.txt", "r");
$GLOBALS['accumulator'] = 0;
if($TXTfp !== FALSE) {
    $arrayInput = array();
    while(! feof($TXTfp)) {
        $data = fgets($TXTfp, 1000);
        if (strlen(trim($data)) !== 0) {
            array_push($arrayInput, (int)$data);
        }
    }
    $ans1 = solve1($arrayInput, 25);
    print_r($ans1);
    $ans2 = solve2($arrayInput, $ans1);
    print_r($ans2);

}

function solve1($arraInput, $preamble) {
    foreach ($arraInput as $key => $val) {
        if ($key < $preamble ) {
            continue;
        }
        $found = false;
        $compareArraySet = array_slice($arraInput, $key - $preamble, $key);
        $num = $arraInput[$key];
        for($i = 0; $i < count($compareArraySet); $i++) {
            for($j = $i+1; $j <count($compareArraySet); $j++) {
                if((int)$compareArraySet[$i] + (int)$compareArraySet[$j] !== (int)$num) {
                    continue;
                } else {
                    $found = true;
                    break;
                }
            }
            if($found) {
                break;
            }
        }
        if (!$found) {
            return $num;
            break;
        }
    }
}

function solve2($arraInput, $target) {
    $continue = true;
    for($i = 0; $i < count($arraInput); $i++) {
        $tempTarget = 0;
        $low = $i;
        for($j = $i+1; $j <count($arraInput); $j++) {
            if ($tempTarget === 0) {
                $tempTarget += $arraInput[$i] + $arraInput[$j];
            } else {
                $tempTarget += $arraInput[$j];
            }
            if($tempTarget === $target) {
                $high = $j;
                $continue = false;
                break;
            }
        }
        if(!$continue) {
            $result = array_slice($arraInput,$low, $high-$low);
            sort($result);
            return current($result) + end($result);
            break;
        }
    }
}
fclose($TXTfp);
?>