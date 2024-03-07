<?php
header('Content-Type: application/json');

$userGuess = isset($_POST['guess']) ? (int)$_POST['guess'] : null;
$numberToGuess = isset($_POST['check']) ? (int)$_POST['check'] : null;
$response = [];

if ($userGuess !== null) {
    if ($userGuess === $numberToGuess) {
        $response = ['type' => 'success', 'message' => 'Bravo ! Vous avez deviné le nombre.'];
    } elseif ($userGuess > $numberToGuess) {
        $response = ['type' => 'hint', 'message' => 'Votre supposition est trop haute.'];
    } elseif ($userGuess < $numberToGuess) {
        $response = ['type' => 'hint', 'message' => 'Votre supposition est trop basse.'];
    }
} else {
    $response = ['type' => 'error', 'message' => 'Supposition invalide.'];
}

echo json_encode($response);
