<?php
$host = $_ENV['DB_HOST'];
$db = $_ENV['DB_DATABASE'];
$user = $_ENV['DB_USERNAME'];
$pass = $_ENV['DB_PASSWORD'];
try {
    $connection = new PDO('mysql:host=' . $host . ';' . 'dbname=' . $db, $user, $pass);
} catch (PDOException $e) {
    die('Error de conexión: ' . $e->getMessage());
}
