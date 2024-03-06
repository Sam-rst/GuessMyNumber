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
    return Math.floor(Math.random() * 20) + 1;
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
