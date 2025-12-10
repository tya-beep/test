<?php
include "connection.php";

// Check if either receiptID or paymentID is provided
if (!isset($_GET['receiptID']) && !isset($_GET['paymentID'])) {
    return ["error" => "Receipt ID or Payment ID is required."];
}

$receipt = null;

if (isset($_GET['receiptID'])) {
    $receiptID = $_GET['receiptID'];

    $stmt = $connMySQL->prepare("
        SELECT r.*, p.paymentMethod, p.paymentStatus
        FROM receipt r
        JOIN payment p ON r.paymentID = p.paymentID
        WHERE r.receiptID = :id
    ");
    $stmt->execute([':id' => $receiptID]);
    $receipt = $stmt->fetch(PDO::FETCH_ASSOC);
} elseif (isset($_GET['paymentID'])) {
    $paymentID = $_GET['paymentID'];

    $stmt = $connMySQL->prepare("
        SELECT r.*, p.paymentMethod, p.paymentStatus
        FROM receipt r
        JOIN payment p ON r.paymentID = p.paymentID
        WHERE r.paymentID = :id
    ");
    $stmt->execute([':id' => $paymentID]);
    $receipt = $stmt->fetch(PDO::FETCH_ASSOC);
}

if (!$receipt) {
    return ["error" => "Receipt not found."];
}

return ["receipt" => $receipt, "error" => null];
