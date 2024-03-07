'use strict';

$(document).ready(function() {
    // Réinitialisation du jeu au chargement de la page
    resetGame();

    // Bouton de vérification de la supposition
    $('#btncheck').click(function() {
        sendData();
    });

    // Bouton pour recommencer une partie
    $('.again').click(function() {
        resetGame();
    });

    // Enforce input range
    $('.guess').on('input', function() {
        enforceIntegerRange(this);
    });

    function enforceIntegerRange(input) {
        let value = parseInt($(input).val(), 10);
        if (isNaN(value) || value === 0) {
            $(input).val('');
        } else if (value < 1) {
            $(input).val(1);
        } else if (value > 20) {
            $(input).val(20);
        }
    }

    // Envoi de la supposition au serveur
    function sendData() {
        var guess = $('#check').val();
        var formData = new FormData();
        formData.append('guess', guess);

        $.ajax({
            type: "POST",
            url: "backend.php",
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json', // Attend une réponse en JSON
            success: function(response) {
                $('#message').text(response.message);

                if (response.type === 'success') {
                    document.body.style.backgroundColor = '#60b347';
                    $('.number').text(guess);
                    updatehighscore();
                } else if (response.type === 'hint') {
                    updatescore();
                }
            },
            error: function(xhr, status, error) {
                $('#message').text("Erreur lors de l'envoi de la supposition.");
            }
        });
    }

    // Mettre à jour le score
    function updatescore() {
        let currentScore = parseInt($('#score').text(), 10);
        if (!isNaN(currentScore)) {
            currentScore--;
            $('#score').text(currentScore);
        }
    }

    // Mettre à jour le meilleur score
    function updatehighscore() {
        let currentScore = parseInt($('#score').text(), 10);
        let currentHighscore = parseInt($('#highscore').text(), 10);
        if (!isNaN(currentScore) && currentScore > currentHighscore) {
            $('#highscore').text(currentScore);
        }
    }

    // Réinitialisation du jeu
    function resetGame() {
        document.body.style.backgroundColor = '#222';
        $('.number').text('?');
        $('#score').text('20');
        $('#check').val('');
        $('#message').text('Start guessing...');

        // Envoie une requête pour réinitialiser le nombre à deviner côté serveur
        // Note: Vous devez gérer cette logique côté serveur dans backend.php
        $.ajax({
            type: "POST",
            url: "backend.php",
            data: { action: 'reset' }, // Ajoutez le traitement de cette action côté serveur
            success: function() {
                console.log('Game has been reset.');
            },
            error: function() {
                console.log('Error resetting the game.');
            }
        });
    }
});
