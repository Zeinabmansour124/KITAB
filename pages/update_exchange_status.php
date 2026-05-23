<?php
session_start();
require_once __DIR__ . '/../config/ConnexionDB.php';

header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'error' => 'Non connecté']);
    exit();
}

$data = json_decode(file_get_contents('php://input'), true);

if (!isset($data['exchangeId'], $data['status'])) {
    echo json_encode(['success' => false, 'error' => 'Données manquantes']);
    exit();
}

$exchangeId = (int) $data['exchangeId'];
$newStatus  = $data['status'];

// Statuts autorisés
$allowed = ['accepted', 'refused', 'in_progress', 'completed', 'pending'];
if (!in_array($newStatus, $allowed)) {
    echo json_encode(['success' => false, 'error' => 'Statut invalide']);
    exit();
}

$conn = ConnexionDB::getInstance();
$stmt = $conn->prepare("UPDATE exchanges SET status = :status WHERE id = :id");
$success = $stmt->execute(['status' => $newStatus, 'id' => $exchangeId]);

echo json_encode(['success' => $success]);