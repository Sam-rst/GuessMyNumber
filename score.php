<?php
session_start();

require_once('includes/dbconnect.php');

$stmtGetScores = $pdo->prepare("SELECT * FROM guessmynumber GROUP BY pseudo ORDER BY score DESC");
$stmtGetScores->execute();
$scores = $stmtGetScores->fetchAll(PDO::FETCH_ASSOC);

$score = "????"; // TODO : récupérer la valeur du score venant du fichier précédent

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
    #victoire {
        background: url("img/mario-approves-img.png") no-repeat;
        background-size: cover;
        background-attachment: fixed;
    }
</style>

<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#victoireModal">
    Bouton victoire
</button>

<div class="modal modal-lg fade text-white" id="victoireModal" tabindex="-1" aria-labelledby="victoireModalLabel" aria-hidden="true" data-bs-theme="dark">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title" id="victoireModalLabel">Vous avez gagné !</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card bg-opacity-75" id="victoire">
                    <div class="card-body">
                        <ul class="list-group list-group-flush rounded">
                            <li class="list-group-item">
                                <h3>Voici le top classement :</h3>
                                <?php
                                if (!empty($scores)) { ?>
                                    <table class="table align-middle table-striped table-hover table-primary text-center table-sm">
                                        <thead>
                                            <tr class="table-primary">
                                                <th>Pseudo</th>
                                                <th>Score</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $count = 0;
                                            foreach ($scores as $scoreJoueur) {
                                                if ($count == 10) {
                                                    break;
                                                } // On affiche que les 10 meilleurs joueurs
                                            ?>
                                                <tr>
                                                    <td><?= $scoreJoueur['pseudo'] ?></td>
                                                    <td><?= $scoreJoueur['score'] ?></td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                <?php } else {
                                    echo '<h1 class="text-center"><button class="btn btn-primary"> Aucun joueur en lice !</button></h1>';
                                } ?>
                            </li>
                            <li class="list-group-item">
                                <h3>Voulez-vous sauvegarder votre score ?</h3>
                                <br><br>
                                <form action="code.php" method="post">
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="input-group mb-3">
                                                <span class="input-group-text">Pseudo</span>
                                                <input type="text" name="pseudo" class="form-control" placeholder="Votre pseudo" aria-label="pseudo">
                                            </div>
                                        </div>
                                        <div class="col-1">
                                            <button type="submit" class="btn btn-success" name="insert">Enregistrer</button>
                                        </div>
                                    </div>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>