<?php
header('Content-Type: application/json');

require_once(__DIR__ . '/../../../config/ConnexionDB.php');

try {
    $db = ConnexionDB::getInstance();
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Connexion: ' . $e->getMessage()]);
    exit;
}

if (!isset($_POST['book_id']) || empty($_POST['book_id'])) {
    echo json_encode(['success' => false, 'message' => 'book_id manquant.']);
    exit;
}

$book_id = intval($_POST['book_id']);
$user_id = 1;

try {
    $check = $db->prepare("SELECT COUNT(*) FROM favorites WHERE user_id = :user_id AND book_id = :book_id");
    $check->execute([':user_id' => $user_id, ':book_id' => $book_id]);
    $exists = $check->fetchColumn() > 0;

    if ($exists) {
        $delete = $db->prepare("DELETE FROM favorites WHERE user_id = :user_id AND book_id = :book_id");
        $delete->execute([':user_id' => $user_id, ':book_id' => $book_id]);
        echo json_encode(['success' => true, 'action' => 'removed']);
    } else {
        $insert = $db->prepare("INSERT INTO favorites (user_id, book_id) VALUES (:user_id, :book_id)");
        $insert->execute([':user_id' => $user_id, ':book_id' => $book_id]);
        echo json_encode(['success' => true, 'action' => 'added']);
    }

} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'SQL: ' . $e->getMessage()]);
}
?>