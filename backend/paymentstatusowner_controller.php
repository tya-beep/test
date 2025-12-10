<?php
include "connection.php";
session_start();

// Fetch all payment records
$stmt = $connMySQL->prepare("
    SELECT paymentID, paymentDate, paymentMethod, paymentStatus
    FROM payment
");
$stmt->execute();

$payments = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Return data to frontend
return $payments;
