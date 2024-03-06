<?php

require_once("config.php");

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);

} catch (PDOException $e) {
    $_SESSION['message'] = "La connexion à la base de données a échouée : $e";
    $_SESSION['messageColor'] = "danger";
}
