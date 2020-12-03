<?php
$CSVfp = fopen("puzzle1day3.csv", "r");
if($CSVfp !== FALSE) {
    $i = 0;
    $arrayInput = array();
    while(! feof($CSVfp)) {
        $data = fgetcsv($CSVfp, 1000, ",");
        if(is_array($data)) {
            $line = str_split($data[0]);
            array_push($arrayInput, $line);
        }
    }
    $day3ans1 = getTreeCount(3,1, $arrayInput);
    print_r($day3ans1);

    $slopeArray = [[1,1], [3,1], [5,1], [7,1], [1,2]];
    $day3ans2 = getTreeCountMultiplication($slopeArray, $arrayInput);
    print_r($day3ans2);
}

function getTreeCount($slopeX, $slopeY, $inputForest)
{
    $treeCount = 0;
    $x = 0;
    $y = 0;

    while($y < count($inputForest)) {
        $char = $inputForest[$y][$x];
        if($char == '#')
        {
            $treeCount++;
        }

        $x = ($x + $slopeX) % 31;
        $y += $slopeY;
    }
    return $treeCount;
}

function getTreeCountMultiplication($slopeArray, $inputForest)
{
    $treeCountMultiplication = 0;
    foreach ($slopeArray as $key => $slope)
    {
        $result = getTreeCount($slope[0], $slope[1], $inputForest);
        if ($treeCountMultiplication != 0)
        {
            $treeCountMultiplication = $treeCountMultiplication * $result;
        } else {
            $treeCountMultiplication = $result;
        }
    }
    return $treeCountMultiplication;
}
fclose($CSVfp);
?>