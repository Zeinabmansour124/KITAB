<?php
header('Content-Type: application/json');

require_once(__DIR__ . '/../../../config/ConnexionDB.php');

$user_id = 1;

try {
    $db = ConnexionDB::getInstance();
    $stmt = $db->prepare("SELECT book_id FROM favorites WHERE user_id = :user_id");
    $stmt->execute([':user_id' => $user_id]);
    $rows = $stmt->fetchAll(PDO::FETCH_COLUMN);
    
    echo json_encode(['success' => true, 'favorites' => $rows]);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'favorites' => []]);
}
?>