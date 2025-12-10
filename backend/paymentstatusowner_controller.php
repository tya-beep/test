<?php
include "connection.php";
session_start();

// Get search input from URL (GET)
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Base SQL query
$sql = "
    SELECT paymentID, paymentDate, paymentMethod, paymentStatus
    FROM payment
    WHERE 1
";

// If search is not empty, add filtering
if ($search !== "") {
    $sql .= " AND (
                paymentID LIKE :search OR
                paymentDate LIKE :search OR
                paymentMethod LIKE :search OR
                paymentStatus LIKE :search
             )";
}

// Order by date descending
$sql .= " ORDER BY paymentDate DESC";

// Prepare statement
$stmt = $connMySQL->prepare($sql);

// Bind search value safely
if ($search !== "") {
    $stmt->bindValue(':search', "%$search%");
}

// Execute query
$stmt->execute();

// Fetch all results
$payments = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Return to frontend
return $payments;
?>
