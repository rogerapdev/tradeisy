<?php

function formatDate($timestamp, $format = "")
{
    if (empty($timestamp)) {
        return null;
    }

    if (is_string($timestamp)) {

        $timestamp = str_replace('/', '-', $timestamp);
        if (($timestamp = strtotime($timestamp)) === false) {
            return "Invalid Date";
        }
    }
    if (!is_numeric($timestamp)) {
        $timestamp = time();
    }

    if (!$format) {
        $format = 'Y-m-d';
    }

    return date($format, $timestamp);
}

// $cnpj = preg_replace('/[^0-9]/is', '', $cnpj);
// $cnpj = str_pad($cnpj, 14, "0", STR_PAD_LEFT);
// $cnpj = mask($cnpj, '##.###.###/####-##');
function mask($val, $mask)
{
    $maskared = '';
    $k = 0;
    for ($i = 0; $i <= strlen($mask) - 1; $i++) {
        if ($mask[$i] == '#') {
            if (isset($val[$k])) {
                $maskared .= $val[$k++];
            }
        } else {
            if (isset($mask[$i])) {
                $maskared .= $mask[$i];
            }
        }
    }
    return $maskared;
}

function unFormatMoney($money)
{

    // finds the position of the first occurrence
    // of a non-numeric character in a string.
    preg_match("/\D/is", $money, $match_list, PREG_OFFSET_CAPTURE);

    $cleanString = preg_replace('/([^0-9\.,])/i', '', $money);
    $onlyNumbersString = preg_replace('/([^0-9])/i', '', $money);

    $separatorsCountToBeErased = strlen($cleanString) - strlen($onlyNumbersString) - 1;

    $stringWithCommaOrDot = preg_replace('/([,\.])/', '', $cleanString, $separatorsCountToBeErased);
    $removedThousendSeparator = preg_replace('/(\.|,)(?=[0-9]{8,}$)/', '', $stringWithCommaOrDot);

    return floatval(str_replace(',', '.', $removedThousendSeparator));

}

function formatMoney($money, $decimal_places = 2, $prefix = 'R$ ')
{
    return $prefix . number_format($money, $decimal_places, ',', '.');
}

function formatDecimal($decimal, $decimal_places = 2)
{
    return formatMoney($decimal, $decimal_places, '');
}

function unFormatDecimal($decimal)
{
    $var2 = str_replace(".", "", $decimal); //Retirou todos os pontos
    return str_replace(",", ".", $var2); //Substitui vírgulas por pontos
}

function percentage($percentage, $value)
{
    return ($percentage / 100) * $value;
}

function ceiling($number, $significance = 1)
{
    return (is_numeric($number) && is_numeric($significance)) ? (ceil($number / $significance) * $significance) : false;
}

function get_months($date1, $date2)
{

    $time1 = strtotime($date1);
    $time2 = strtotime($date2);

    $my = date('mY', $time2);
    $months = array(date('Y-m-t', $time1));
    $f = '';

    while ($time1 < $time2) {
        $time1 = strtotime((date('Y-m-d', $time1) . ' +15days'));

        if (date('F', $time1) != $f) {
            $f = date('F', $time1);

            if (date('mY', $time1) != $my && ($time1 < $time2)) {
                $months[] = date('Y-m-t', $time1);
            }

        }

    }

    $months[] = date('Y-m-d', $time2);
    return $months;
}

function get_months_by_range($start, $end)
{
    $months = [];
    $start = date('Y-m-01', strtotime($start));
    $start_time = strtotime($start);
    $end_time = strtotime($end);

    while ($start_time < $end_time) {
        $months[] = date('Y-m', $start_time);
        $start_time = strtotime("+1 month", $start_time);
    }

    return $months;

}

function holidays_sp($year = null)
{
    if (empty($year)) {
        $year = intval(date('Y'));
    }
    $easter = easter_date($year); // Limite de 1970 ou após 2037 da easter_date PHP consulta http://www.php.net/manual/pt_BR/function.easter-date.php
    $day_easter = date('j', $easter);
    $month_easter = date('n', $easter);
    $year_easter = date('Y', $easter);

    $holidays = array(
        // Tatas Fixas dos feriados Nacionail Basileiras
        mktime(0, 0, 0, 1, 1, $year), // Confraternização Universal - Lei nº 662, de 06/04/49
        mktime(0, 0, 0, 4, 21, $year), // Tiradentes - Lei nº 662, de 06/04/49
        mktime(0, 0, 0, 5, 1, $year), // Dia do Trabalhador - Lei nº 662, de 06/04/49
        mktime(0, 0, 0, 9, 7, $year), // Dia da Independência - Lei nº 662, de 06/04/49
        mktime(0, 0, 0, 10, 12, $year), // N. S. Aparecida - Lei nº 6802, de 30/06/80
        mktime(0, 0, 0, 11, 2, $year), // Todos os santos - Lei nº 662, de 06/04/49
        mktime(0, 0, 0, 11, 15, $year), // Proclamação da republica - Lei nº 662, de 06/04/49
        mktime(0, 0, 0, 12, 25, $year), // Natal - Lei nº 662, de 06/04/49
        // Essas Datas depem diretamente da data de Pascoa
        // mktime(0, 0, 0, $month_easter, $day_easter - 48, $year_easter), //2ºferia Carnaval
        mktime(0, 0, 0, $month_easter, $day_easter - 47, $year_easter), //3ºferia Carnaval
        mktime(0, 0, 0, $month_easter, $day_easter - 2, $year_easter), //6ºfeira Santa
        mktime(0, 0, 0, $month_easter, $day_easter, $year_easter), //Pascoa
        mktime(0, 0, 0, $month_easter, $day_easter + 60, $year_easter), //Corpus Cirist
    );

    sort($holidays);

    foreach ($holidays as $key => $value) {
        $holidays[$key] = date('Y-m-d', $value);
    }

    return $holidays;
}

// https://api.calendario.com.br/?json=true&ano=2017&estado=SP&cidade=SAO_PAULO&token=ZWl1c19yYXNAaG90bWFpbC5jb20maGFzaD0xNzM3NjA4NjI=
