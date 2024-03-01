<?php 
session_start();

if (isset($_SESSION["user_id"])) {

  $mysqli = require __DIR__ ."/database.php";

  $sql = "SELECT * FROM user WHERE id = {$_SESSION["user_id"]}";

  $result = $mysqli->query($sql);

  $user = $result->fetch_assoc();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Game Hub</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #75db48; 
        }
        h1 {
            color: #333;
            text-align: center;
            margin-top: 20px;
        }
	h2 {
	border-bottom: 1px;
	border-bottom-style: solid;
	}
        /* Styles for the tabs. */
        .tab {
            overflow: hidden;
            border: 1px solid #333;
            background-color: #333; 
        }

        /* Styles for the buttons inside the tab. */
        .tab button {
            background-color: inherit;
            float: left;
            border: none;
            outline: none;
            cursor: pointer;
            padding: 14px 16px;
            transition: 0.3s;
            font-size: 17px;
            color: white;
        }

        /* Changes background color of buttons on hover. */
        .tab button:hover {
            background-color: #b6d7a8; 
            color: #333; 
        }

        /* Active/current tablinks. */
        .tab button.active {
            background-color: #24550e; 
            color: white; 
        }

        /* Styles for tab content. */
        .tabcontent {
            display: none;
            padding: 20px;
            border: 1px solid #333;
            border-top: none;
            background-color: white;
            color: #333;
        }

        a {
          text-decoration: none;
          color: white;
        }
        a:hover {
          background-color: #ddd; 
          color: #333; 
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
<style>
  .image-container {
    margin-bottom: 20px;
  }
  .reaction-button {
    cursor: pointer;
    margin-right: 10px;
  }
  .reaction-count {
    display: inline-block;
    min-width: 20px;
    margin-right: 20px;
  }
</style>
<body>
<div class="image-container">
  <h3>Pong</h3>
  <img src="Images/Pong_resized.png" alt="Pong" style="width: 150px; height: 150px;"/><br>
  <img src="Images/Thumbs up.png" alt="Thumbs Up" class="reaction-button" onclick="upvote('Pong')" />
  <span id="Pong-upvote" class="reaction-count">0</span>
  <img src="Images/Thumbs down.png" alt="Thumbs Down" class="reaction-button" onclick="downvote('Pong')" />
  <span id="Pong-downvote" class="reaction-count">0</span>
</div>
<div class="image-container">
  <h3>Snake</h3>
  <img src="Images/Snake_resized.png" alt="Snake" style="width: 150px; height: 150px;"/><br>
  <img src="Images/Thumbs up.png" alt="Thumbs Up" class="reaction-button" onclick="upvote('Snake')" />
  <span id="Snake-upvote" class="reaction-count">0</span>
  <img src="Images/Thumbs down.png" alt="Thumbs Down" class="reaction-button" onclick="downvote('Snake')" />
  <span id="Snake-downvote" class="reaction-count">0</span>
</div>
<div class="image-container">
  <h3>Tic Tac Toe</h3>
  <img src="Images/TTT_resized.png" alt="Tic Tac Toe" style="width: 150px; height: 150px;"/><br>
  <img src="Images/Thumbs up.png" alt="Thumbs Up" class="reaction-button" onclick="upvote('TTT')" />
  <span id="TTT-upvote" class="reaction-count">0</span>
  <img src="Images/Thumbs down.png" alt="Thumbs Down" class="reaction-button" onclick="downvote('TTT')" />
  <span id="TTT-downvote" class="reaction-count">0</span>
</div>
</div>

<div id="ComingSoon" class="tabcontent">
  <h2>Coming Soon</h2>
  <p>Get excited for these upcoming game releases!</p>
<img src="Images/Gears of War 6.webp" alt="Gears of War 6" style="width: 150px; height: 150px;">
<img src="Images/halo-wars-3.avif" alt="Halo Wars 3" style="width: 150px; height: 150px;">
<img src="Images/Halo 7.jpg" alt="Halo 7" style="width: 150px; height: 150px;">
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
