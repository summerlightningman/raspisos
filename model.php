<?php
/**
 * Created by PhpStorm.
 * User: stive
 * Date: 14.11.2018
 * Time: 23:28
 */
function drawTheTable($a = array())
{
    echo '<tr>';
    echo "<td style='font-size: 1.5rem; border-right: 1px solid black;vertical-align: middle' rowspan='2'>8:00 - 8:30</td>"; // Время
    echo "<td></td><td>{$a[22][10]}</td><td>{$a[34][10]}</td><td></td><td></td></tr>";                                       // числитель
    echo "<tr><td>{$a[10][9]}</td><td></td><td>{$a[34][10]}</td><td></td><td></td></tr>";                                                // знаменатель
    echo "<tr><td style='font-size: 1.5rem; border-right: 1px solid black;vertical-align: middle' rowspan='2'>8:45 - 9:30</td>"; //
    echo "<td></td><td>{$a[22][10]}</td><td>{$a[36][10]}</td><td></td><td>{$a[60][2]}</td></tr>";
    echo "<tr><td>{$a[10][9]}</td><td></td><td>{$a[37][10]}</td><td></td><td>{$a[61][2]}</td></tr>";
    echo '<tr>';
    echo "<td style='font-size: 1.5rem; border-right: 1px solid black;vertical-align: middle' rowspan='2'>9:45 - 11:15</td>"; // Время
    echo "<td>{$a[14][8]}</td><td></td><td>{$a[38][8]}</td><td></td><td>{$a[62][10]}</td></tr>";                                       // числитель
    echo "<tr><td>{$a[15][8]}</td><td></td><td>{$a[38][8]}</td><td>{$a[49][10]}</td><td></td></tr>";                                   // знаменатель

    echo "<td style='font-size: 1.5rem; border-right: 1px solid black;vertical-align: middle' rowspan='2'>11:30 - 13:00</td>"; // Время
    echo "<td>{$a[16][8]}</td><td></td><td>{$a[40][10]}</td><td>{$a[50][10]}</td><td></td></tr>";                                       // числитель
    echo "<tr><td>{$a[17][10]}</td><td></td><td></td><td>{$a[51][10]}</td><td></td></tr>";                                              // знаменатель

    echo "<td style='font-size: 1.5rem; border-right: 1px solid black;vertical-align: middle' rowspan='2'>13:30 - 15:00</td>"; // Время
    echo "<td></td><td></td><td></td><td>{$a[52][8]}</td><td></td></tr>";                                       // числитель
    echo "<tr><td></td><td></td><td></td><td>{$a[52][8]}</td><td></td></tr>";                                              // знаменатель
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
    $excel->setActiveSheetIndex(1);
    $sheet = $excel->getActiveSheet()->toArray(null);
    return $sheet;
}