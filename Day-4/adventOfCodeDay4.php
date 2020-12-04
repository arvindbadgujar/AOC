<?php
$TXTfp = fopen("InputDay4.txt", "r");

if($TXTfp !== FALSE) {
    $arrayInput = array();
    $passportData = '';
    while(! feof($TXTfp)) {
        $data = fgets($TXTfp, 1000);
        if (strlen(trim($data)) !== 0) {
            $passportData = $passportData.' '.trim($data);
        } else {
            array_push($arrayInput, trim($passportData));
            $passportData = '';
        }
    }

    $validCount = getValidPassport($arrayInput, false);
    print_r($validCount);

    $validCount = getValidPassport($arrayInput, true);
    print_r($validCount);
}

function getValidPassport($passportData, $validation)
{
    $validPassport = 0;
    $standardArray = ['byr'=>'', 'iyr'=> '', 'eyr'=> '', 'hgt'=>'', 'hcl'=>'', 'ecl'=> '', 'pid'=>'', 'cid'=>''];
    foreach ($passportData as $key => $value) {
        $arr = array();
        $string = explode(' ', $value);
        foreach ($string as $k => $v) {
            $str = explode(':', $v);
            $arr[$str[0]] = $str[1];
        }
        $missingKeys = array_diff_key($standardArray, $arr);
        if (count($missingKeys) === 0) {
            if ($validation && isValidPassportData($arr)) {
                $validPassport++;
            } elseif(!$validation) {
                $validPassport++;
            }
        } elseif(count($missingKeys) === 1 && array_key_exists('cid', $missingKeys)) {
            if ($validation && isValidPassportData($arr)) {
                $validPassport++;
            } elseif(!$validation) {
                $validPassport++;
            }
        }
    }
    return $validPassport;
}

function isValidPassportData($data)
{
    $validationPassed = 0;
    if (isset($data['byr']) && strlen($data['byr']) === 4 && (int)$data['byr'] >= 1920 && (int)$data['byr'] <= 2002) {
        $validationPassed++;
    }

    if (isset($data['iyr']) && strlen($data['iyr']) === 4 && (int)$data['iyr'] >= 2010 && (int)$data['iyr'] <= 2020) {
        $validationPassed++;
    }

    if (isset($data['eyr']) && strlen($data['eyr']) === 4 && (int)$data['eyr'] >= 2020 && (int)$data['eyr'] <= 2030) {
        $validationPassed++;
    }

    if (isset($data['hgt'])) {
        $hgtFormat = preg_replace("/[^a-zA-Z]+/", "", $data['hgt']);
        $hgtValue = preg_replace("/[^0-9]+/", "", $data['hgt']);

        if ($hgtFormat === 'cm' && $hgtValue <= 193 && $hgtValue >= 150 ) {
            $validationPassed++;
        } elseif ($hgtFormat === 'in' && $hgtValue <= 76 && $hgtValue >= 59) {
            $validationPassed++;
        }
    }

    if (isset($data['hcl']) && preg_match("/^#+[a-f0-9]{6}/", $data['hcl']) && strlen($data['hcl']) === 7) {
        $validationPassed++;
    }

    if (isset($data['ecl']) && strlen($data['ecl']) === 3 && in_array($data['ecl'], array("amb", "blu", "brn", "gry", "grn", "hzl", "oth"))) {
        $validationPassed++;
    }

    if (isset($data['pid']) && strlen($data['pid']) === 9) {
        $validationPassed++;
    }
    return $validationPassed === 7 ? true : false;
}
fclose($TXTfp);
?>