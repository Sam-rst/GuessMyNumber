'use strict';

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
            if(response.type === 'success') {
                // supposition correcte
            } else if(response.type === 'hint') {
                // supposition trop haute ou trop basse
            } else if(response.type === 'error') {
                // supposition invalide
            }
        },
        error: function(xhr, status, error) {
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