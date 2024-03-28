<?php
session_start(); // Commencez la session en haut de votre fichier PHP.

require_once 'includes/dbconnect.php'; 
require_once 'includes/scoreManager.php'; // Ce fichier contient la classe ScoreManager.

// Vérifiez si le formulaire a été soumis.
if (isset($_POST['insert'])) {
    // Assainissez les entrées et prévenez les injections SQL.
    $pseudo = filter_input(INPUT_POST, 'pseudo', FILTER_SANITIZE_SPECIAL_CHARS);
    $score = filter_input(INPUT_POST, 'score', FILTER_SANITIZE_NUMBER_INT);

    try {
        // Obtenez l'instance de PDO et créez une instance de ScoreManager.
        $pdo = Dbconnect::getInstance();
        $scoreManager = new ScoreManager($pdo);
        
        // Essayez d'insérer le score.
        if ($scoreManager->insertScore($pseudo, $score)) {
            // Définissez un message de succès dans la session.
            $_SESSION['message'] = "Le score a bien été enregistré.";
            $_SESSION['messageColor'] = "success";
        } else {
            // Définissez un message d'échec dans la session.
            $_SESSION['message'] = "Une erreur est survenue lors de l'enregistrement du score.";
            $_SESSION['messageColor'] = "danger";
        }
    } catch (Exception $e) {
        // Définissez un message d'échec dans la session si une exception est attrapée.
        $_SESSION['message'] = "Une erreur est survenue : " . $e->getMessage();
        $_SESSION['messageColor'] = "danger";
    }

    // Redirection vers la page principale avec le message de session.
    header('Location: index.php');
    exit();
}

// S'il n'y a pas d'action 'insert', redirigez vers la page d'accueil ou affichez une erreur.
header('Location: index.php');
exit();
