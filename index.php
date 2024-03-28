<?php
session_start();
if (isset($_SESSION['alert'])) {
  $alert = $_SESSION['alert'];
  AlertManager::displayAlert($alert['type'], $alert['message']);
  unset($_SESSION['alert']);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <link rel="stylesheet" href="style.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <title>Guess My Number!</title>
</head>

<body>
  <header>
    <h1 id="msgvictory">Guess My Number!</h1>
    <div class="d-flex justify-content-center">
      <button type="button" class="btn btn-primary d-none" id="btnModal" data-bs-toggle="modal" data-bs-target="#victoireModal">
        Save my score
      </button>

      <div class="modal modal-lg fade text-white" id="victoireModal" tabindex="-1" aria-labelledby="victoireModalLabel" data-bs-theme="dark">
        <div class="modal-dialog modal-dialog-centered" style="margin-left: auto; margin-right: auto;">
          <div class="modal-content">
            <div class="modal-header">
              <h2 class="modal-title fs-3" id="victoireModalLabel">Vous avez gagné !</h2>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <h3 class="fs-5 mb-3">Voici le top classement :</h3>
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
                        <td><?= htmlspecialchars($scoreJoueur['pseudo']) ?></td>
                        <td><?= htmlspecialchars($scoreJoueur['score']) ?></td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
              <?php } else { ?>
                <!-- Affichez ce message si aucun score n'est présent -->
                <div class="text-center my-4" style="background-color:white;color:black">
                  <h3>Aucun joueur en lice !</h3>
                </div>
              <?php } ?>
              </li>
              <li class="list-group-item">
                <h3 class="mt-4">Voulez-vous sauvegarder votre score ?</h3>
                <br><br>
                <form action="code.php" method="post">
                  <p class="mb-3">Votre meilleur score : <strong id="scoreHighScore">16</strong></p>
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
    </div>
    <p class="between">(Between 1 and 20)</p>
    <button class="btn again">Again!</button>
    <div class="number">?</div>
  </header>
  <main>
    <section class="left">
      <input id="check" type="number" class="guess" min="0" max="20">
      <button id="btncheck" class="btn check">Check!</button>
    </section>
    <section class="right">
      <p id="message" class="message">Start guessing...</p>
      <p class="label-score">💯 Score: <span id="score" class="score">20</span></p>
      <p class="label-highscore">
        🥇 Highscore: <span id="highscore">0</span>
      </p>
    </section>
  </main>
  <script src="script.js"></script>
</body>

</html>