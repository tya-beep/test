<?php
include "connection.php"; // MUST provide $connMySQL (PDO connection)

// Read search input
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Base query
$sql = "
    SELECT paymentID, paymentDate, paymentMethod, paymentStatus
    FROM payment
    WHERE 1
";

// If search is entered, add conditions
if ($search !== "") {
    $sql .= " AND (
                paymentID LIKE :search OR
                paymentDate LIKE :search OR
                paymentMethod LIKE :search OR
                paymentStatus LIKE :search
             )";
}

$sql .= " ORDER BY paymentDate DESC";  // Sort by latest date

// Prepare statement
$stmt = $connMySQL->prepare($sql);

// Bind search if needed
if ($search !== "") {
    $stmt->bindValue(':search', "%$search%");
}

$stmt->execute();

// Fetch results
$payments = $stmt->fetchAll(PDO::FETCH_ASSOC);

return $payments;
?>
