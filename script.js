'use strict';

let nbr_guess;
const check = document.getElementById("check");
const message = document.getElementById("message");
const score = document.getElementById("score");
const msgvictory = document.getElementById("msgvictory");
const numberDisplay = document.querySelector('.number');
const highscore = document.getElementById("highscore");
const btnAgain = document.querySelector('.again');

function generateRandomNumber() {
    nbrGuess = Math.floor(Math.random() * 20) + 1;
    return nbrGuess;
}

function resetGame() {
    document.body.style.backgroundColor = '#222';
    numberDisplay.style.width = '15rem';
    updateMessageV('Guess My Number!');
    nbr_guess = generateRandomNumber();  // Appeler la fonction correctement
    check.value = '';
    updateMessage('Start guessing...');
    score.textContent = '20';
}

check.addEventListener("input", (e) => {
    console.log(check.value);
});

const btncheck = document.getElementById("btncheck");

function guessmynumber() {
    const userGuess = parseInt(check.value, 10);

    if (isNaN(userGuess)) {
        updateMessage('Veuillez entrer un nombre valide.');
    } else if (userGuess < 1 || userGuess > 20) {
        updateMessage('Veuillez entrer un nombre entre 1 et 20.');
    } else if (userGuess < nbr_guess) {
        updateMessage('Trop bas !');
        updatescore();
    } else if (userGuess > nbr_guess) {
        updateMessage('Trop haut !');
        updatescore();
    } else {
        updateMessage('Bravo, vous avez deviné le nombre !');
        document.body.style.backgroundColor = '#60b347';
        numberDisplay.style.width = '30rem';
        updateMessageV('VICTOIRE');
        updatehighscore();
    }
}

btncheck.addEventListener("click", guessmynumber);

function updateMessage(msg) {
    message.textContent = msg;
}

function updateMessageV(msg) {
    msgvictory.textContent = msg;
}

function updatescore() {
    let currentScore = parseInt(score.textContent, 10);

    if (!isNaN(currentScore)) {
        currentScore--;
        score.textContent = currentScore;
    }
}

function updatehighscore() {
    let currentScore = parseInt(score.textContent, 10);
    let currentHighscore = parseInt(highscore.textContent, 10);

    if (!isNaN(currentScore) && !isNaN(currentHighscore)) {
        if (currentScore > currentHighscore) {
            highscore.textContent = currentScore;
        }
    }
}

btnAgain.addEventListener("click", resetGame);

resetGame();  // Appeler resetGame pour initialiser nbr_guess au début

const nbrGuess = Math.floor(Math.random() * 20) + 1;

function sendData() {
    var guess = $('.guess').val();
    var formData = new FormData();
    formData.append('guess', guess);
    formData.append('check', nbrGuess);

    $.ajax({
        type: "POST",
        url: "backend.php",
        data: formData,
        processData: false,
        contentType: false,
        dataType: 'json', // S'attend à recevoir du JSON en réponse
        success: function (response) {
            // Met à jour le contenu de l'élément avec la classe 'message' selon la réponse
            $('.message').text(response.message);

            // Optionnel : Ajoutez des actions supplémentaires 
            if (response.type === 'success') {
                // supposition correcte
            } else if (response.type === 'hint') {
                // supposition trop haute ou trop basse
            } else if (response.type === 'error') {
                // supposition invalide
            }
        },
        error: function (xhr, status, error) {
            $('.message').text("Erreur lors de l'envoi de la supposition.");
        }
    });
}

document.addEventListener('DOMContentLoaded', (event) => {


    const guessInput = document.querySelector('.guess');
    guessInput.value = '';
    guessInput.addEventListener('input', enforceIntegerRange);

    function enforceIntegerRange() {
        let value = parseInt(this.value, 10);

        if (isNaN(value) || value === 0) {
            this.value = '';
        } else if (value < 1) {
            this.value = 1;
        } else if (value > 20) {
            this.value = 20;
        } else {
            this.value = value;
        }
    }

});