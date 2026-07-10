<?php

$host = 'localhost';
$database = 'proyectoprogramacionweb';
$user = 'root';
$password = 'Derecktiti12345@';
$port = 3306;

try {

    $pdo = new PDO(
        "mysql:host=$host;dbname=$database;charset=utf8",
        $user,
        $password
    );

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die();
}
