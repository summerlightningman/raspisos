<?php
function query($str = '')
{
    $connection = mysqli_connect('127.0.0.1', 'root', '', 'decanat') or die('невозможно подключиться к бд');
    mysqli_query($connection, "SET NAMES 'utf8'");
    mysqli_query($connection, "SET SESSION collation_connection = 'utf8_general_ci'");
    $result = mysqli_query($connection, $str);
    return $result;
}