<?php
function validateRoom(array $data): array {
    $errors = [];
    if (empty($data['titre']))            $errors[] = "Le titre est requis.";
    if (empty($data['auteur']))           $errors[] = "L'auteur est requis.";
    if (empty($data['total_pages']) || $data['total_pages'] < 1)
                                          $errors[] = "Le nombre de pages est requis.";
    if (empty($data['max_participants'])) $errors[] = "Le nombre de participants est requis.";
    if (empty($data['genre']))            $errors[] = "Le genre est requis.";
    return $errors;
}