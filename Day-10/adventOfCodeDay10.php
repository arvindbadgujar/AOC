<?php
$TXTfp = fopen("InputDay10.txt", "r");
if($TXTfp !== FALSE) {
    $arrayInput = array();
    while(! feof($TXTfp)) {
        $data = fgets($TXTfp, 1000);
        if (strlen(trim($data)) !== 0) {
            array_push($arrayInput, (int)$data);
        }
    }
    sort($arrayInput);

    $ans1 = solve1($arrayInput);
    print_r($ans1);

    array_unshift($arrayInput , 0);
    array_push($arrayInput, end($arrayInput) + 3);

    $ans2 = solve2($arrayInput);
    print_r($ans2);
}

function solve1($arrayInput) {
    $diff1 = 1;
    $diff3 = 1;

    for ($i = 0; $i < count($arrayInput); $i++) {
        $diff = $arrayInput[$i+1] - $arrayInput[$i];
        if ($diff === 1) {
            $diff1 += 1;
        }
        if ($diff === 3) {
            $diff3 += 1;
        }
    }
    return $diff1 * $diff3;
}

function solve2($arrayInput) {
    $array[0] = 1;
    for( $i = 1; $i < count($arrayInput); $i++) {
        for($j = 0; $j < $i; $j++) {
            if ($arrayInput[$i] - $arrayInput[$j] < 4) {
                $array[$i] += $array[$j];
            }
        }
    }
    return end($array);
}
fclose($TXTfp);
?>