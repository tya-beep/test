<?php
include "connection.php";

$response = [
    "success" => false,
    "error" => "",
];

if (!isset($_POST['paymentID']) || !isset($_POST['paymentMethod'])) {
    $response["error"] = "Invalid request.";
    return $response;
}

$paymentID = $_POST['paymentID'];
$method    = $_POST['paymentMethod'];

try {
    $stmt = $connMySQL->prepare("
        UPDATE payment 
        SET paymentStatus = 'Paid',
            paymentMethod = :method,
            paymentDate = NOW()
        WHERE paymentID = :paymentID
    ");
    $stmt->execute([
        ':method'     => $method,
        ':paymentID'  => $paymentID
    ]);

    $response["success"] = true;
    $response["paymentID"] = $paymentID;

} catch (PDOException $e) {
    $response["error"] = "Database error: " . $e->getMessage();
}

return $response;
?>
