<?php 

ini_set('display_errors', '1');

$host="mysql-yoboiturq.alwaysdata.net";
$user="yoboiturq";
$password="3008812t";
$dbname="yoboiturq_hw";

$link = new mysqli($host,$user,$password,$dbname);
$link->set_charset("utf8");


if($link->connect_errno){
    echo "Error: code" .$link->connect_errno.", Msg ".$link->connect_error;
    exit();
}

mysqli_set_charset($link,"utf8");

 ?>