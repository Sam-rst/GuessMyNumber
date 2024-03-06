<?php
session_start();

require_once('includes/dbconnect.php');

$stmtGetScores = $pdo->prepare("SELECT * FROM guessmynumber ORDER BY score ASC");
$stmtGetScores->execute();
$scores = $stmtGetScores->fetchAll(PDO::FETCH_ASSOC);

$score = "????"; // TO DO : récupérer la valeur du score venant du fichier précédent

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Vous avez gagné !</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<style>
    body {
        background: url("img/mario-approves-img.png") no-repeat;
        background-size: cover;
        background-attachment: fixed;
    }
</style>

<body>
    <div class="container mt-5 mb-5">
        <?php include_once 'includes/messages.php'; ?>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header text-bg-dark">
                        <h1 class="text-center">Vous avez gagné, bravo !</h1>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <h3>Score : <b>x</b></h3>
                            </li>
                            <li class="list-group-item">
                                <h3>Nombre de tours : <b>x</b> tours !</h3>
                            </li>
                            <li class="list-group-item">
                                <h3>Essayez de faire mieux !</h3>
                            </li>
                            <li class="list-group-item">
                                <h3>Voici le top classement :</h3>
                                <?php
                                if (!empty($scores)) { ?>
                                    <table class="table align-middle table-striped table-hover table-info text-center table-sm">
                                        <thead>
                                            <tr class="table-dark">
                                                <th>Pseudo</th>
                                                <th>Score</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($scores as $scoreJoueur) { ?>
                                                <tr>
                                                    <td><?= $scoreJoueur['pseudo'] ?></td>
                                                    <td><?= $scoreJoueur['score'] ?></td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                <?php } else {
                                    echo '<h1 class="text-center"><button class="btn btn-primary"> Ancun joueur en lice !</button></h1>';
                                } ?>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>