<?php
// connection.php

// MySQL connection (for existing data)
$mysql_host = 'localhost';
$mysql_db   = 'vetclinic';
$mysql_user = 'tya';
$mysql_pass = '1234';

try {
    $connMySQL = new PDO("mysql:host=$mysql_host;dbname=$mysql_db", $mysql_user, $mysql_pass);
    $connMySQL->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("MySQL Connection failed: " . $e->getMessage());
}

?>
