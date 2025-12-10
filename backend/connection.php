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

// PostgreSQL connection (for login accounts)
$pg_host = '10.48.74.199';
$pg_db   = 'postgres';     // your PostgreSQL DB name
$pg_user = 'postgres';      // or your PG user
$pg_pass = 'password';

try {
    $connPG = new PDO("pgsql:host=$pg_host;dbname=$pg_db", $pg_user, $pg_pass);
    $connPG->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("PostgreSQL Connection failed: " . $e->getMessage());
}

?>
