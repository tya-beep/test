<?php
// Load backend logic & data
$data = include "../backend/pay_controller.php";

$payment = $data["payment"];
$paymentID = $data["paymentID"];
$error = $data["error"];
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Pay Now</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        function toggleCashAmount() {
            const method = document.getElementById('paymentMethod').value;
            const cashInput = document.getElementById('cashAmountDiv');
            cashInput.style.display = (method === 'Cash') ? 'block' : 'none';
        }
    </script>
</head>

<body class="p-10">

<h1 class="text-2xl font-bold mb-4">Pay Payment ID: <?= $paymentID ?></h1>

<?php if ($error): ?>
    <p class="text-red-600 mb-4"><?= $error ?></p>
<?php endif; ?>

<form method="POST" class="max-w-md bg-white p-6 rounded shadow">

    <label class="block mb-2 font-semibold">Select Payment Method:</label>
    <select name="paymentMethod" id="paymentMethod" onchange="toggleCashAmount()" required class="w-full p-2 border mb-4">
        <option value="">--Choose--</option>
        <option value="Cash">Cash</option>
        <option value="Card">Card</option>
        <option value="Online Banking">Online Banking</option>
    </select>

    <div id="cashAmountDiv" style="display:none;">
        <label class="block mb-2 font-semibold">Amount Paid:</label>
        <input 
            type="number" 
            step="0.01" 
            min="<?= $payment['paymentAmount']; ?>" 
            name="amountPaid" 
            class="w-full p-2 border mb-4"
        >
        <p>Payment Amount: <?= number_format($payment['paymentAmount'], 2); ?></p>
    </div>

    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">
        Pay Now
    </button>

</form>

</body>
</html>
