<?php
session_start(); // Commence ou reprend une session PHP
header('Content-Type: application/json');

// Génère et stocke le nombre à deviner dans la session si ce n'est pas déjà fait
if (!isset($_SESSION['numberToGuess'])) {
    $_SESSION['numberToGuess'] = rand(1, 20);
}

$userGuess = isset($_POST['guess']) ? (int)$_POST['guess'] : null;
$numberToGuess = $_SESSION['numberToGuess']; // Utilise la valeur stockée en session
$response = [];

if ($userGuess !== null) {
    if ($userGuess === $numberToGuess) {
        $response = ['type' => 'success', 'message' => 'Bravo ! Vous avez deviné le nombre.'];
        unset($_SESSION['numberToGuess']); // Optionnel : Réinitialiser après un succès
    } elseif ($userGuess > $numberToGuess) {
        $response = ['type' => 'hint', 'message' => 'Votre supposition est trop haute.'];
    } elseif ($userGuess < $numberToGuess) {
        $response = ['type' => 'hint', 'message' => 'Votre supposition est trop basse.'];
    }
} else {
    $response = ['type' => 'error', 'message' => 'Supposition invalide.'];
}

echo json_encode($response);
