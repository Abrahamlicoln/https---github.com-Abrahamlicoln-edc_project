<?php
function number_unformat($number, $force_number = true, $dec_point = '.', $thousands_sep = ',')
{
    if ($force_number) {
        $number = preg_replace('/^[^\d]+/', '', $number);
    } else if (preg_match('/^[^\d]+/', $number)) {
        return false;
    }
    $type = (strpos($number, $dec_point) === false) ? 'int' : 'float';
    $number = str_replace(array($dec_point, $thousands_sep), array('.', ''), $number);
    settype($number, $type);
    return $number;
}
