<?php
include "../frontend/header.php";
$payments = include "../backend/paymentstatusowner_controller.php";
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Payment Status</title>
</head>

<body class="p-10 bg-gray-50">

<div class="max-w-3xl mx-auto"> <!-- Center & reduce width -->

    <h1 class="text-3xl font-bold mb-8 text-center mt-24">Your Payment</h1>
<!-- SEARCH FORM -->
<form method="GET" class="max-w-3xl mx-auto mb-6">
    <div class="flex">
        <input type="text" name="search" placeholder="Search payments..."
               value="<?= isset($_GET['search']) ? $_GET['search'] : '' ?>"
               class="flex-grow p-2 border border-gray-400 rounded-l">
        <button type="submit"
                class="bg-blue-500 hover:bg-blue-600 text-white px-4 rounded-r">
            Search
        </button>
    </div>
</form>
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border shadow-md rounded-lg">
            <thead class="bg-gray-200">
                <tr>
                    <th class="p-3 border">Payment ID</th>
                    <th class="p-3 border">Payment Date</th>
                    <th class="p-3 border">Method</th>
                    <th class="p-3 border">Status</th>
                    <th class="p-3 border">Receipt</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($payments as $pay): ?>
                    <tr class="hover:bg-gray-100">
                        <td class="p-3 border"><?= $pay['paymentID']; ?></td>
                        <td class="p-3 border"><?= $pay['paymentDate']; ?></td>
                        <td class="p-3 border"><?= $pay['paymentMethod'] ?? '-'; ?></td>

                        <td class="p-3 border font-semibold 
                            <?= ($pay['paymentStatus'] === 'paid') ? 'text-green-600' : 'text-red-600'; ?>">
                            <?= $pay['paymentStatus']; ?>
                        </td>

                        <td class="p-3 border text-center">
                            <?php if ($pay['paymentStatus'] === 'pending'): ?>
                                <a href="pay.php?paymentID=<?= $pay['paymentID']; ?>"
                                   class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded">
                                    Pay Now
                                </a>
                            <?php else: ?>
                                <a href="receipt.php?paymentID=<?= $pay['paymentID']; ?>"
                                   class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded">
                                    View 
                                </a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>

        </table>
    </div>

</div> <!-- end centered container -->
<?php include "../frontend/footer.php"; ?>
</body>
</html>
