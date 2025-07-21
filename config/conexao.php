<?php

$host = "localhost";
$dbname = "contatos_db";
$username = "root";
$password = "Erick@2023";

$sqlFile = __DIR__ . '/../database/contatos.sql';
try {
    $conn = new PDO("mysql:host=$host", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->exec("CREATE DATABASE IF NOT EXISTS $dbname");
    
    $conn->exec("USE $dbname");
    $conn->exec(file_get_contents($sqlFile));
    
    return $conn;

} catch(PDOException $e) {
    echo "Erro de conexão: " . $e->getMessage();
    exit;
}

?>