
//Object to keep track of votes.
const votes = {
  Pong: { up: 0, down: 0 },
  Snake: { up: 0, down: 0 },
  TTT: { up: 0, down: 0 }
};

// Function to handle upvotes.
function upvote(game) {
  votes[game].up += 1;
  document.getElementById(game + '-upvote').innerText = votes[game].up;
}

// Function to handle downvotes.
function downvote(game) {
  votes[game].down += 1;
  document.getElementById(game + '-downvote').innerText = votes[game].down;
}
