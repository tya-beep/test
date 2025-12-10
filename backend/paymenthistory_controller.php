<?php
include "connection.php";

// Fetch all payment history records
$stmt = $connMySQL->prepare("
    SELECT paymentID, paymentDate, paymentMethod, paymentStatus
    FROM payment
    ORDER BY paymentDate DESC
");
$stmt->execute();

$payments = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Return data for use in other files
return $payments;
