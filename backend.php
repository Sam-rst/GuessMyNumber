<?php
session_start();
header('Content-Type: application/json');

class NumberGuessingGame {
    private $numberToGuess;

    public function __construct() {
        if (!isset($_SESSION['numberToGuess'])) {
            $_SESSION['numberToGuess'] = rand(1, 20);
        }
        $this->numberToGuess = $_SESSION['numberToGuess'];
    }

    public function guess($userGuess) {
        if ($userGuess === null) {
            return ['type' => 'error', 'message' => 'Supposition invalide.'];
        } elseif ($userGuess === $this->numberToGuess) {
            unset($_SESSION['numberToGuess']); // Réinitialiser après un succès
            return ['type' => 'success', 'message' => 'Bravo ! Vous avez deviné le nombre.'];
        } elseif ($userGuess > $this->numberToGuess) {
            return ['type' => 'hint', 'message' => 'Votre supposition est trop haute.'];
        } else {
            return ['type' => 'hint', 'message' => 'Votre supposition est trop basse.'];
        }
    }
}

$game = new NumberGuessingGame();
$userGuess = isset($_POST['guess']) ? (int)$_POST['guess'] : null;
$response = $game->guess($userGuess);

echo json_encode($response);
?>
