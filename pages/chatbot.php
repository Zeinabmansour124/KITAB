<?php


header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');

require_once __DIR__ . '/../config/ConnexionDB.php';
require_once __DIR__ . '/../config/Repository.php';
require_once __DIR__ . '/../config/models/repositories/BookRepository.php';


if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Méthode non autorisée']);
    exit;
}


$input   = json_decode(file_get_contents('php://input'), true);
$message = trim($input['message'] ?? '');

if ($message === '') {
    echo json_encode(['error' => 'Message vide']);
    exit;
}

$db = ConnexionDB::getInstance();


function extractBudget(string $text): ?float {
    
    if (preg_match('/(?:sous|moins\s+de|max\.?\s*|maximum\s*|<\s*)(\d+(?:[.,]\d+)?)\s*(?:dt|dinar|tnd)?/iu', $text, $m))
        return (float) str_replace(',', '.', $m[1]);

    if (preg_match('/(\d+(?:[.,]\d+)?)\s*(?:dt|dinar|tnd)/iu', $text, $m))
        return (float) str_replace(',', '.', $m[1]);
    return null;
}


function extractGenres(string $text): array {
    $map = [
        'fiction'           => 'Fiction',
        'fantasy'           => 'Fantasy',
        'fantastique'       => 'Fantasy',
        'romance'           => 'Romance',
        'amour'             => 'Romance',
        'mystery'           => 'Mystery',
        'mystère'           => 'Mystery',
        'polar'             => 'Mystery',
        'thriller'          => 'Thriller',
        'histoire'          => 'History',
        'history'           => 'History',
        'biographie'        => 'Biography',
        'biography'         => 'Biography',
        'science.fiction'   => 'Science Fiction',
        'sci-fi'            => 'Science Fiction',
        'sf'                => 'Science Fiction',
        'classique'         => 'Classic Literature',
        'classic'           => 'Classic Literature',
    ];
    $found = [];
    $lower = mb_strtolower($text);
    foreach ($map as $keyword => $genre) {
        if (preg_match('/' . $keyword . '/u', $lower)) {
            $found[$genre] = true;
        }
    }
    return array_keys($found);
}


function formatBook(object $book): array {
    return [
        'id'           => $book->id,
        'titre'        => $book->titre,
        'auteur'       => $book->auteur ?? 'Inconnu',
        'prix'         => number_format((float)$book->prix, 2) . ' DT',
        'genre'        => $book->genre ?? '',
        'condition'    => $book->condition ?? '',
        'image'        => $book->image ?? '',
        'for_exchange' => (bool)$book->for_exchange,
    ];
}


function searchBooks(PDO $db, array $opts): array {
    $where  = [];
    $params = [];

    if (!empty($opts['genres'])) {
        $placeholders = implode(',', array_fill(0, count($opts['genres']), '?'));
        $where[]  = "b.genre IN ($placeholders)";
        $params   = array_merge($params, $opts['genres']);
    }
    if (!empty($opts['budget'])) {
        $where[]    = "b.prix <= ?";
        $params[]   = $opts['budget'];
    }
    if (!empty($opts['condition'])) {
        $where[]    = "b.condition = ?";
        $params[]   = $opts['condition'];
    }
    if (!empty($opts['exchange'])) {
        $where[]    = "b.for_exchange = 1";
    }
    if (!empty($opts['search'])) {
        $where[]    = "(b.titre LIKE ? OR b.auteur LIKE ?)";
        $like       = '%' . $opts['search'] . '%';
        $params[]   = $like;
        $params[]   = $like;
    }

    $sql  = "SELECT b.*, u.nom AS owner_nom, u.prenom AS owner_prenom, u.image AS owner_img
             FROM books b
             LEFT JOIN users u ON b.user_id = u.id";

    if ($where) {
        $sql .= " WHERE " . implode(' AND ', $where);
    }

    $order = $opts['order'] ?? 'b.created_at DESC';
    $limit = $opts['limit'] ?? 4;
    $sql  .= " ORDER BY $order LIMIT $limit";

    $stmt = $db->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchAll(PDO::FETCH_OBJ);
}



$lower   = mb_strtolower($message);
$budget  = extractBudget($message);
$genres  = extractGenres($message);


if (preg_match('/\b(bonjour|salut|hello|salam|hi|bonsoir)\b/iu', $lower)) {
    echo json_encode([
        'type'    => 'text',
        'message' => "Bonjour ! 👋 Je suis l'assistant KITAB.\nJe peux vous aider à :\n• Trouver un livre par genre ou auteur\n• Filtrer par budget\n• Chercher des livres à échanger\n\nQue cherchez-vous ?",
        'chips'   => ['Fiction', 'Fantasy', 'Romance', 'Sous 50 DT', 'Livres à échanger'],
    ]);
    exit;
}


if (preg_match('/\b(merci|thanks|شكرا)\b/iu', $lower)) {
    echo json_encode([
        'type'    => 'text',
        'message' => "Avec plaisir ! N'hésitez pas si vous cherchez autre chose 😊",
    ]);
    exit;
}


if (preg_match('/échange|echang|swap|troquer/iu', $lower)) {
    $books = searchBooks($db, ['exchange' => true, 'genres' => $genres, 'budget' => $budget, 'limit' => 4]);
    echo json_encode([
        'type'    => 'books',
        'message' => count($books)
            ? "Voici les livres disponibles à l'échange :"
            : "Aucun livre à l'échange pour le moment.",
        'books'   => array_map('formatBook', $books),
        'chips'   => ['Voir plus', 'Filtrer par genre', 'Sous 30 DT'],
    ]);
    exit;
}


if ($budget !== null || preg_match('/budget|prix|combien|pas\s+cher|économique/iu', $lower)) {
    $opts = ['budget' => $budget, 'genres' => $genres, 'order' => 'b.prix ASC', 'limit' => 4];
    $books = searchBooks($db, $opts);
    $msg   = $budget
        ? "Livres disponibles sous " . number_format($budget, 2) . " DT :"
        : "Voici les livres les moins chers en ce moment :";
    echo json_encode([
        'type'    => 'books',
        'message' => count($books) ? $msg : "Aucun livre trouvé dans ce budget.",
        'books'   => array_map('formatBook', $books),
        'chips'   => ['Sous 30 DT', 'Sous 50 DT', 'Sous 80 DT'],
    ]);
    exit;
}


if (!empty($genres)) {
    $books = searchBooks($db, ['genres' => $genres, 'budget' => $budget, 'limit' => 4]);
    echo json_encode([
        'type'    => 'books',
        'message' => count($books)
            ? "Voici les livres " . implode(', ', $genres) . " disponibles :"
            : "Aucun livre " . implode(', ', $genres) . " trouvé pour l'instant.",
        'books'   => array_map('formatBook', $books),
        'chips'   => ['Sous 40 DT', 'Livres à échanger', 'Voir tout'],
    ]);
    exit;
}


if (preg_match('/neuf|comme\s+neuf/iu', $lower)) {
    $books = searchBooks($db, ['condition' => 'neuf', 'limit' => 4]);
    echo json_encode([
        'type' => 'books', 'message' => 'Livres en état neuf :',
        'books' => array_map('formatBook', $books),
    ]);
    exit;
}
if (preg_match('/\bbon\b/iu', $lower)) {
    $books = searchBooks($db, ['condition' => 'bon', 'limit' => 4]);
    echo json_encode([
        'type' => 'books', 'message' => 'Livres en bon état :',
        'books' => array_map('formatBook', $books),
    ]);
    exit;
}


if (preg_match('/cherche|trouve|recherche|looking\s+for|auteur|écrit\s+par/iu', $lower)
    || mb_strlen($message) > 3) {
   
    $keywords = preg_replace('/\b(je|cherche|trouve|un|une|le|la|les|du|de|des|livre|livres|par|auteur)\b/iu', '', $lower);
    $keywords = trim(preg_replace('/\s+/', ' ', $keywords));

    if ($keywords !== '') {
        $books = searchBooks($db, ['search' => $keywords, 'limit' => 4]);
        if (count($books)) {
            echo json_encode([
                'type'    => 'books',
                'message' => "Résultats pour « $keywords » :",
                'books'   => array_map('formatBook', $books),
            ]);
            exit;
        }
    }
}


$books = searchBooks($db, ['order' => 'b.created_at DESC', 'limit' => 4]);
echo json_encode([
    'type'    => 'books',
    'message' => "Je n'ai pas bien compris, mais voici nos dernières arrivées 📚",
    'books'   => array_map('formatBook', $books),
    'chips'   => ['Fiction', 'Fantasy', 'Sous 50 DT', 'Livres à échanger'],
]);