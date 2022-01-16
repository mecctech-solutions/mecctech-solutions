import Typed from 'typed.js'
import $ from "jquery"

$(document).ready(function() {
    // Typing animation script
    var typed = new Typed(".typing", {
        strings: ['full-stack web developer.', 'software engineer.'],
        typeSpeed: 100,
        backSpeed: 60,
        loop: true
    })

    const canvas = document.getElementById('matrix');
    const context = canvas.getContext('2d');

    canvas.width = window.innerWidth;
    canvas.height = window.innerHeight;

    const alphabet = '01';
    const fontSize = 20;
    const columns = canvas.width / fontSize;

    const rainDrops = [];

    for( let x = 0; x < columns; x++ ) {
        rainDrops[x] = Math.random() * 100;
    }

    const draw = () => {
        context.fillStyle = 'rgba(0, 0, 0, 0.05)';
        context.fillRect(0, 0, canvas.width, canvas.height);

        context.fillStyle = '#0F0';
        context.font = fontSize + 'px monospace';

        for(let i = 0; i < rainDrops.length; i++)
        {
            const text = alphabet.charAt(Math.floor(Math.random() * alphabet.length));
            context.fillText(text, i*fontSize, rainDrops[i]*fontSize);

            if(rainDrops[i]*fontSize > canvas.height && Math.random() > 0.975){
                rainDrops[i] = 0;
            }
            rainDrops[i]++;
        }
    };

    setInterval(draw, 100);
});
