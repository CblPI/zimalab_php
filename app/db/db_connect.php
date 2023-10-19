<?php
/*
    Файл с функцией установки соединения с БД.
*/
function dbconnect(){
    include("db_env.php");
    $dbroute = $type.":host=".$host.";dbname=".$base;
    $opt = array(
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    );
    return $dbcon = new PDO($dbroute, $user, $pass, $opt);
}

