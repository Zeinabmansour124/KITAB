

<?php

//  Ce fichier extrait toute la logique de traitement PHP, la base de données et le mapping des variables avant l'affichage.


require_once(__DIR__ . '/../../config/autoloader.php');

$bookRepo = new BookRepository();


$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;


$book = $bookRepo->findById($id);


if (!$book) {
    header("Location: marketplace.php");
    exit();
}


$css_mapping = [
    'neuf'   => 'like-new',
    'bon'    => 'good',
    'moyen'  => 'Fair',
    'abimé'  => 'Acceptable'
];

$text_mapping = [
    'neuf'   => 'New',
    'bon'    => 'Good',
    'moyen'  => 'Fair',
    'abimé'  => 'Acceptable'
];

$classe_css = $css_mapping[$book->condition] ?? 'good';
$texte_en   = $text_mapping[$book->condition] ?? 'Good';