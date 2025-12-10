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
    // Start transaction
    $connMySQL->beginTransaction();

    // 1. Update payment
    $stmt = $connMySQL->prepare("
        UPDATE payment
        SET paymentStatus = 'Paid',
            paymentMethod = :method,
            paymentDate = NOW()
        WHERE paymentID = :paymentID
    ");
    $stmt->execute([
        ':method'    => $method,
        ':paymentID' => $paymentID
    ]);

    // 2. Fetch updated payment details
    $stmt = $connMySQL->prepare("SELECT * FROM payment WHERE paymentID = :paymentID");
    $stmt->execute([':paymentID' => $paymentID]);
    $payment = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$payment) {
        throw new Exception("Payment not found.");
    }

    // 3. Insert receipt and get receiptID
    $stmt = $connMySQL->prepare("
        INSERT INTO receipt (paymentID, receiptDate, billingAmount, netAmount)
        VALUES (:paymentID, NOW(), :billingAmount, :netAmount)
    ");
    $stmt->execute([
        ':paymentID'     => $paymentID,
        ':billingAmount' => $payment['billingAmount'],
        ':netAmount'     => $payment['netAmount']
    ]);

    // Get the last inserted receipt ID
    $receiptID = $connMySQL->lastInsertId();

    $connMySQL->commit();

    $response["success"] = true;
    $response["paymentID"] = $paymentID;
    $response["receiptID"] = $receiptID;

} catch (Exception $e) {
    $connMySQL->rollBack();
    $response["error"] = "Error: " . $e->getMessage();
}

return $response;
?>
