<?php
$data = include "../backend/receipt_controller.php";

if (!isset($data["receipt"])) {
    die($data["error"] ?? "Receipt not found.");
}

$receipt = $data["receipt"];
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Receipt</title>
</head>

<body class="p-10 bg-gray-50">

<div class="max-w-lg mx-auto bg-white shadow p-6 rounded">
    <h1 class="text-2xl font-bold mb-3">Payment Receipt</h1>
    <hr class="mb-4">

    <p><strong>Receipt No:</strong> <?= htmlspecialchars($receipt['receiptID']); ?></p>
    <p><strong>Payment No:</strong> <?= htmlspecialchars($receipt['paymentID']); ?></p>
    <p><strong>Date:</strong> <?= htmlspecialchars($receipt['billingDate'] . ' ' . $receipt['billingTime']); ?></p>
    <p><strong>Payment Method:</strong> <?= htmlspecialchars($receipt['paymentMethod']); ?></p>
    <p><strong>Billing Amount:</strong> RM <?= number_format($receipt['billingAmount'], 2); ?></p>
    <p><strong>Net Amount:</strong> RM <?= number_format($receipt['netAmount'], 2); ?></p>
    <p><strong>Status:</strong> 
        <span class="<?= $receipt['paymentStatus'] === 'Paid' ? 'text-green-600' : 'text-red-600' ?>">
            <?= htmlspecialchars($receipt['paymentStatus']); ?>
        </span>
    </p>

    <hr class="my-4">

    <a href="paymentstatusowner.php" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
        Back
    </a>
</div>

</body>
</html>
