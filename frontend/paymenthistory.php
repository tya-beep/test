<?php
include "../frontend/header.php";
// Include backend to fetch data
$payments = include "../backend/paymenthistory_controller.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Payment History</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="p-10 bg-gray-50">

<h1 class="text-3xl font-bold mb-6 text-center mt-24">Payment History</h1>

<div class="max-w-3xl mx-auto">
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow-md">
            <thead class="bg-blue-200">
                <tr>
                    <th class="p-3 border">Payment ID</th>
                    <th class="p-3 border">Date</th>
                    <th class="p-3 border">Method</th>
                    <th class="p-3 border">Status</th>
                    <th class="p-3 border">Receipt</th> <!-- NEW COLUMN -->
                </tr>
            </thead>

            <tbody>
                <?php if (empty($payments)): ?>
                    <tr>
                        <td colspan="5" class="p-3 text-center border">No payment history found.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($payments as $p): ?>
                        <tr class="hover:bg-gray-100">
                            <td class="p-3 border"><?= $p['paymentID']; ?></td>
                            <td class="p-3 border"><?= $p['paymentDate']; ?></td>
                            <td class="p-3 border"><?= $p['paymentMethod']; ?></td>
                            <td class="p-3 border font-semibold
                                <?= ($p['paymentStatus'] === 'Paid') ? 'text-green-600' : 'text-red-600'; ?>">
                                <?= $p['paymentStatus']; ?>
                            </td>

                            <!-- NEW RECEIPT BUTTON -->
                            <td class="p-3 border text-center">
                                <a href="receiptadmin.php?paymentID=<?= $p['paymentID']; ?>" 
                                    class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded">
                                    View
                                    </a>
                            </td>

                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
