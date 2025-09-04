<?php

$serverName     = 'localhost';
$username       = 'root';
$pass           = '';
$dbName         = 'test';

$conn = mysqli_connect($serverName, $username, $pass, $dbName);

if(!$conn){
        echo "Something wrong";
}

?>
