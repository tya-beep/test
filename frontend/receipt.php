<?php
$data = include "../backend/receipt_controller.php";

if ($data["error"]) {
    die($data["error"]);
}

$payment = $data["payment"];
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Receipt</title>
</head>

<body class="p-10">

<div class="max-w-lg mx-auto bg-white shadow p-6 rounded">
    <h1 class="text-2xl font-bold mb-3">Payment Receipt</h1>
    <hr class="mb-4">

    <p><strong>Receipt No:</strong> <?= $payment['paymentID']; ?></p>
    <p><strong>Date:</strong> <?= $payment['paymentDate']; ?></p>
    <p><strong>Payment Method:</strong> <?= $payment['paymentMethod']; ?></p>
    <p><strong>Billing Amount:</strong> RM <?= $payment['billingAmount']; ?></p>
    <p><strong>Net Amount:</strong> RM <?= $payment['netAmount']; ?></p>
    <p><strong>Status:</strong> 
        <span class="text-green-600"><?= $payment['paymentStatus']; ?></span>
    </p>

    <hr class="my-4">

    <a href="paymentstatusowner.php" class="px-4 py-2 bg-blue-600 text-white rounded">
        Back
    </a>
</div>

</body>
</html>
