<?php 
include_once("includes/dbconnect.php");

if (isset($_POST['insert'])) {
    $pseudo = htmlspecialchars($_POST['pseudo']);

    $stmtInsertPseudo = $pdo->prepare("INSERT INTO guessmynumber (pseudo) VALUES (:pseudo)");
    $stmtInsertPseudo->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);
    $success = $stmtInsertPseudo->execute();
    if ($success) {
        $_SESSION['message'] = "Le pseudo a bien été inséré";
        $_SESSION['messageColor'] = "success";
        header( 'Location: score.php' );
        exit();
    } else {
        $_SESSION['message'] = "Le pseudo n'a pas bien été inséré";
        $_SESSION['messageColor'] = "danger";
        header( 'Location: score.php' );
        exit();
    }
}