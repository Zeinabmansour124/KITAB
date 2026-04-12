<?php
session_start();
require_once 'config/ConnexionDB.php';

header('Content-Type: application/json');

// Récupération des données JSON
$data = json_decode(file_get_contents('php://input'), true);

// Extraction des valeurs (attention: JS envoie 'exchangeId' pas 'exchange_id')
$exchangeId = $data['exchangeId'];     // Changé : exchangeId (sans underscore)
$newStatus = $data['status'];

// Obtenir la connexion PDO
$conn = ConnexionDB::getInstance();

// Construire la requête selon le statut
if ($newStatus == 'accepted') {
    $sql = "UPDATE exchange SET accepted = 1 WHERE id = :id";
} else {
    $sql = "UPDATE exchange SET accepted = 0 WHERE id = :id";
}

// Exécuter la requête
$stmt = $conn->prepare($sql);
$success = $stmt->execute(['id' => $exchangeId]);  // Seul :id est utilisé

// Retourner la réponse
$response = ['success' => $success];
echo json_encode($response);
