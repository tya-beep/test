<?php
include "connection.php";

if (!isset($_GET['paymentID'])) {
    return [
        "error" => "Payment ID is required."
    ];
}

$paymentID = $_GET['paymentID'];

$stmt = $connMySQL->prepare("
    SELECT * FROM payment WHERE paymentID = :paymentID
");
$stmt->execute([':paymentID' => $paymentID]);
$payment = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$payment) {
    return [
        "error" => "Payment not found."
    ];
}

return [
    "payment" => $payment,
    "error"   => null
];
?>
