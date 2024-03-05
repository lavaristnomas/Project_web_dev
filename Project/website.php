<?php 
mysqli_report(MYSQLI_REPORT_OFF);
session_start();

if (isset($_SESSION["user_id"])) {

  $mysqli = require __DIR__ ."/database.php";

  $sql = "SELECT * FROM user WHERE id = {$_SESSION["user_id"]}";

  $result = $mysqli->query($sql);

  $user = $result->fetch_assoc();

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mysqli = require __DIR__ ."/database.php";
    $sql = "INSERT INTO reviews (username, game, up_vote) VALUES (?, ?, ?)";

    $stmt = $mysqli->stmt_init();

    if (! $stmt->prepare($sql)) {
        die("SQL error: ".$mysqli->error);
    }

    $username = $user["username"];
    
    if ($_POST["pong-upvote"] == "pong-upvote"){
      $game = "pong";

      $vote = 1;

      $stmt->bind_param("sss", $username, $game, $vote);
      
      $stmt->execute();
    }
  
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Game Hub</title>
<link rel="stylesheet" href="website.css">
<style>
	/* Table Styles for Coming Soon Tab */
	table {
    	width: 100%;
    	border-collapse: collapse;
    	margin-top: 20px;
	color: #000000;
	}

	table, th, td {
    	border: 5px solid #000000;
	}

	td {
    	text-align: center;
    	padding: 10px;
	}
</style>
</head>
<body>
<?php if (isset($user)): ?>
<h1>Game Hub</h1>
<div class="tab">
  <button class="tablinks" onclick="openTab(event, 'Games')">Games</button>
  <button class="tablinks" onclick="openTab(event, 'Ratings')">Ratings</button>
  <button class="tablinks" onclick="openTab(event, 'ComingSoon')">Coming Soon</button>
  <button class="tablinks" style="float: right; text-decoration: none;"><a href="./logout.php">Logout</a></button>
  <button class="tablinks" style="float: right;"><?= htmlspecialchars($user["username"])?></button>
</div>

<div id="Games" class="tabcontent">
 <h2>Games</h2>
  <p>Discover the latest and greatest games here!</p>
<h3>Snake</h3>
<a href="snake.html">
<img src="Images/Snake_resized.png" alt="Snake Game" style="width: 150px; height: 150px;"></a>
<h3>Pong</h3> 
<a href="pong.html">
    <img src="Images/Pong_resized.png" alt="Pong Game" style="width: 150px; height: 150px;"></a>
<h3>Tic Tac Toe</h3>
<a href="tic-tac-toe.html">
    <img src="Images/TTT_resized.png" alt="Tic Tac Toe Game" style="width: 150px; height: 150px;"></a>
</div>

<div id="Ratings" class="tabcontent">
  <h2>Ratings</h2>
  <p>Read our expert reviews on the latest video games.</p>
<script src="rating.js" defer></script>
<div class="image-container">
  <h3>Pong</h3>
  <img src="Images/Pong_resized.png" alt="Pong" style="width: 150px; height: 150px;"/><br>
  <form method="post">
  <input type="image" id="pong-upvote" name="pong-upvote" img src="Images/Thumbs up.png" alt="Thumbs Up" class="reaction-button" style="width: 50px; height: 50px;"/>
  <span id="pong-upvote" class="reaction-count">0</span>
  <input type="image" id="pong-downvote" name="pong-downvote" img src="Images/Thumbs down.png" alt="Thumbs Down" class="reaction-button" style="width: 50px; height: 50px;"/>
  <span id="pong-downvote" class="reaction-count">0</span>
  </form>
</div>
<div class="image-container">
  <h3>Snake</h3>
  <img src="Images/Snake_resized.png" alt="Snake" style="width: 150px; height: 150px;"/><br>
  <form method="post">
  <input type="image" id="snake-upvote" name="snake-upvote" img src="Images/Thumbs up.png" alt="Thumbs Up" class="reaction-button" style="width: 50px; height: 50px;"/>
  <span id="snake-upvote" class="reaction-count">0</span>
  <input type="image" id="snake-downvote" name="snake-downvote" img src="Images/Thumbs down.png" alt="Thumbs Down" class="reaction-button" style="width: 50px; height: 50px;"/>
  <span id="snake-downvote" class="reaction-count">0</span>
  </form>
</div>
<div class="image-container">
  <h3>Tic Tac Toe</h3>
  <img src="Images/TTT_resized.png" alt="Tic Tac Toe" style="width: 150px; height: 150px;"/><br>
  <form method="post">
  <input type="image" id="ttt-upvote" name="ttt-upvote" img src="Images/Thumbs up.png" alt="Thumbs Up" class="reaction-button" style="width: 50px; height: 50px;"/>
  <span id="ttt-upvote" class="reaction-count">0</span>
  <input type="image" id="ttt-downvote" name="ttt-downvote" img src="Images/Thumbs down.png" alt="Thumbs Down" class="reaction-button" style="width: 50px; height: 50px;"/>
  <span id="ttt-downvote" class="reaction-count">0</span>
  </form>
</div>
</div>

<div id="ComingSoon" class="tabcontent">
  <h2>Coming Soon</h2>
  <p>Get excited for these upcoming game releases!</p>
  <table>
    <tr>
      <td><img src="Images/Gears of War 6.webp" alt="Gears of War 6" style="width: 150px; height: 150px;"></td>
      <td><img src="Images/halo-wars-3.avif" alt="Halo Wars 3" style="width: 150px; height: 150px;"></td>
      <td><img src="Images/Halo 7.jpg" alt="Halo 7" style="width: 150px; height: 150px;"></td>
    </tr>
  </table>
</div>


<script>
function openTab(evt, sectionName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(sectionName).style.display = "block";
  evt.currentTarget.className += " active";
}

document.addEventListener("DOMContentLoaded", function() {
  document.getElementsByClassName("tablinks")[0].click();
});
</script>
<?php else: header("Location: login.php") ?>
<?php endif; ?>
</body>
</html>
