<?php 
include_once("includes/dbconnect.php");

if (isset($_POST['insert'])) {
    $pseudo = htmlspecialchars($_POST['pseudo']);
    $score = htmlspecialchars($_POST['score']);

    $stmtInsertPseudo = $pdo->prepare("INSERT INTO guessmynumber (pseudo, score) VALUES (:pseudo, :score)");
    $stmtInsertPseudo->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);
    $stmtInsertPseudo->bindParam(':score', $score, PDO::PARAM_INT);
    $success = $stmtInsertPseudo->execute();
    if ($success) {
        $_SESSION['message'] = "Le pseudo a bien été inséré";
        $_SESSION['messageColor'] = "success";
        header( 'Location: ./' );
        exit();
    } else {
        $_SESSION['message'] = "Le pseudo n'a pas bien été inséré";
        $_SESSION['messageColor'] = "danger";
        header( 'Location: ./' );
        exit();
    }
}