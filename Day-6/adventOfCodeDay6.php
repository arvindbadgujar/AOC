<?php
$TXTfp = fopen("InputDay6.txt", "r");

if($TXTfp !== FALSE) {
    $arrayInput = array();
    $boardingPassSeatArray = array();
    $passportData = '';
    $x = 0;
    $tempArray = array();
    $temp1Array = array();
    $str = '';
    $sumCount = 0;
    while(! feof($TXTfp)) {
        $data = fgets($TXTfp, 1000);
        if (strlen(trim($data)) !== 0) {
            $data1 = str_split(trim($data));

            if (count($temp1Array) === 0 && count($data1) > 1) {
                $temp1Array = $data1;
            } elseif(count($data1) > 1) {
                $temp1Array = array_intersect($data1, $temp1Array);
            }

            foreach ($data1 as $key => $value) {
                $str .= $value;

                $pos = strpos($str, $value);
                if ($pos === 0) {
                    $str .= $value;
                }
                array_push( $tempArray, $value);
                if(count($temp1Array) === 0) {
                    $str .= $value;
                    array_push( $temp1Array, $value);
                } elseif(!in_array($value, $temp1Array)) {
                    $str .= $value;
                    array_push( $temp1Array, $value);
                }
            }
            $x++;
        } elseif (strlen(trim($data)) === 0) {
           $result = count_chars( $str, 3);
           $sumCount += strlen($result);
           $str = '';
           $temp1Array = array();
        }
    }
    echo 'Answer ==> ';
    print_r($sumCount);

}

fclose($TXTfp);
?>