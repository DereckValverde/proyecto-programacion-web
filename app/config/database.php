<?php
//app/config/database.php

$host = 'localhost';
$database = 'techdonaciones';
$user = 'root';
$password = 'Derecktiti12345@';

try{

    $pdo = new PDO(
        "mysql:host=$host;dbname=$database;charset=utf8",
        $user,
        $password
    );

}catch(PDOException $e){
    die("Error de conexión: " . $e->getMessage());
}
