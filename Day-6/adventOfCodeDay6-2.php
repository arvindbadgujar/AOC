<?php
$TXTfp = fopen("InputDay6.txt", "r");

if($TXTfp !== FALSE) {
    $arrayInput = array();
    $arrayInput1 = array();
    $finalCount = 0;
    while(! feof($TXTfp)) {
        $data = fgets($TXTfp, 1000);
        if (strlen(trim($data)) !== 0) {
            array_push($arrayInput, str_split(trim($data)));
        } elseif (strlen(trim($data)) === 0) {
            array_push($arrayInput1, $arrayInput);
            $arrayInput = array();
        }
    }

    foreach ($arrayInput1 as $key => $value) {
        if(count($value) === 1) {
            $finalCount += count(current($value));
        } else {
            $result = call_user_func_array("array_intersect", $value);
            $finalCount += count($result);
        }

    }
    print_r($finalCount);

}

fclose($TXTfp);
?>