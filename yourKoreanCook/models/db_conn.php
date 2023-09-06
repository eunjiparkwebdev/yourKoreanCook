<?php

$dsn = 'mysql:host=localhost;dbname=yourkoreancook';
$dbname='yourkoreancook';
$host='localhost';
$username='cookAdmin';
$password='12341234';
// $con = mysqli_connect($host, $username, $password,$dbname);

try {
    $db = new PDO($dsn, $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e){
    $error_message = $e->getMessage();
    include('models/db_error.php');
    exit();
}

?>