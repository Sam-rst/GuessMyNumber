'use strict';

document.addEventListener('DOMContentLoaded', (event) => {

    const guessInput = document.querySelector('.guess');
    guessInput.value = '';
    guessInput.addEventListener('input', enforceIntegerRange);

    function enforceIntegerRange() {
        let value = parseInt(this.value, 10);

        if (isNaN(value)|| value === 0) {
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