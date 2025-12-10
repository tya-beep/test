<?php
$data = include "../backend/paymentprocess_controller.php";

if ($data["success"]) {
    // Redirect using receiptID
    header("Location: receipt.php?receiptID=" . $data["receiptID"]);
    exit();
}

$error = $data["error"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Process Payment</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="p-10 bg-gray-50">

<h1 class="text-2xl font-bold mb-4">Payment Processing</h1>

<?php if ($error): ?>
    <div class="p-4 bg-red-200 text-red-700 rounded mb-4">
        <?= $error ?>
    </div>
<?php endif; ?>

<a href="viewpaymentstatusowner.php" class="px-4 py-2 bg-blue-600 text-white rounded">
    Go Back
</a>

</body>
</html>
