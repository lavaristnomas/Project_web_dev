// scripts.js
document.addEventListener('DOMContentLoaded', function() {
  const gameContainer = document.getElementById('game-container');

  // Function to load games into the game container
  function loadGame(game) {
      fetch(`games/${game}.html`)
          .then(response => response.text())
          .then(data => {
              gameContainer.innerHTML = data;
              if (game === 'tic-tac-toe') {
                  // Load Tic Tac Toe game logic here
              } else if (game === 'connect-4') {
                  // Load Connect 4 game logic here
              } else if (game === 'snake') {
                  // Load Snake game logic here
              } else if (game === 'pong') {
                  // Load Pong game logic here
              }
          })
          .catch(error => console.error('Error loading game:', error));
  }

  // Event listeners for game links
  document.getElementById('tic-tac-toe').addEventListener('click', function(event) {
      event.preventDefault();
      loadGame('tic-tac-toe');
  });

  document.getElementById('connect-4').addEventListener('click', function(event) {
      event.preventDefault();
      loadGame('connect-4');
  });

  document.getElementById('snake').addEventListener('click', function(event) {
      event.preventDefault();
      loadGame('snake');
  });

  document.getElementById('pong').addEventListener('click', function(event) {
      event.preventDefault();
      loadGame('pong');
  });
});
