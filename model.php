<?php
/**
 * Created by PhpStorm.
 * User: stive
 * Date: 14.11.2018
 * Time: 23:28
 */
function drawTheTable($a = array())
{
    foreach ($a as $row) {
        echo '<tr>';
        for ($i = 0; $i <= 5; $i++) {
            if ($i == 0 && $row[$i] != null)
                echo "<td 
style='font-size: 1.5rem;border-right: 1px solid black;vertical-align: middle' rowspan='2'; 
>$row[$i]</td>";
            elseif ($row[$i] == null && $i == 0)
                continue;
            else
                echo "<td>$row[$i]</td>";
        }
        echo '</tr>';
    }
}

function openTheFile()
{
    $path = 'assets/raspisos.xlsx';

    //downloading

    $ch = curl_init( "http://cchgeu.ru/upload/iblock/e46/fitkb-osenniy-semestr-2018.xls" );
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
    $response = curl_exec($ch);

    if( $response === false )
    {
        trigger_error(curl_error($ch), E_WARNING);
    }
    else
    {
        file_put_contents($path, $response);
    }

    curl_close($ch);

    $file = fopen($path, 'r')
    or die('Файл расписоса отсутствует');
    require_once 'imports/PHPExcel/IOFactory.php';
    $excel = PHPExcel_IOFactory::load($path) or die('Не открылось(');
    $sheet = $excel->getActiveSheet()->toArray(null);
    return $sheet;
}