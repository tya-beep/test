<?php
// pay_backend.php
include "connection.php";
session_start();

if (!isset($_GET['paymentID'])) {
    die("Payment ID not provided.");
}

$paymentID = $_GET['paymentID'];

// Fetch payment info
$stmt = $connMySQL->prepare("
    SELECT paymentID, paymentAmount, paymentStatus 
    FROM payment 
    WHERE paymentID=?
");
$stmt->execute([$paymentID]);
$payment = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$payment) {
    die("Payment not found.");
}

if ($payment['paymentStatus'] === 'paid') {
    die("This payment is already paid.");
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $method = $_POST['paymentMethod'];
    $amountPaid = isset($_POST['amountPaid']) ? floatval($_POST['amountPaid']) : 0;
    $changeAmount = 0;

    if ($method === 'Cash') {
        if ($amountPaid < $payment['paymentAmount']) {
            $error = "Amount paid is less than the payment amount!";
        } else {
            $changeAmount = $amountPaid - $payment['paymentAmount'];
        }
    }

    if (!isset($error)) {
        // Update record
        $update = $connMySQL->prepare("
            UPDATE payment 
            SET paymentStatus='paid', paymentMethod=?, changeAmount=? 
            WHERE paymentID=?
        ");
        $update->execute([$method, $changeAmount, $paymentID]);

        header("Location: receipt.php?paymentID=$paymentID");
        exit();
    }
}

// Make data available to frontend
return [
    "payment" => $payment,
    "paymentID" => $paymentID,
    "error" => $error ?? null
];
