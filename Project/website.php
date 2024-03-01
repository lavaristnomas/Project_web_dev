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
    <title>Gaming Website</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #ADD8E6; 
        }
        h2 {
            color: #333;
            text-align: center;
            margin-top: 20px;
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
            background-color: #ddd; 
            color: #333; 
        }

        /* Active/current tablinks. */
        .tab button.active {
            background-color: #007bff; 
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
<h2>Gaming Website</h2>
<div class="tab">
  <button class="tablinks" onclick="openTab(event, 'Games')">Games</button>
  <button class="tablinks" onclick="openTab(event, 'Ratings')">Reviews</button>
  <button class="tablinks" onclick="openTab(event, 'ComingSoon')">Coming Soon</button>
  <button class="tablinks" style="float: right; text-decoration: none;"><a href="./logout.php">Logout</a></button>
  <button class="tablinks" style="float: right;"><?= htmlspecialchars($user["username"])?></button>
</div>

<div id="Games" class="tabcontent">
 <h3>Games</h3>
  <p>Discover the latest and greatest games here.</p>
<a href="snake.html">
    <img src="Images/Snake.png" alt="Snake Game" style="width: 100px; height: auto;">
  </a>
  <p>Click on the image to play the Snake game.</p>
<a href="pong.html">
    <img src="Images/Pong.png" alt="Pong Game" style="width: 100px; height: auto;">
  </a>
  <p>Click on the image to play the Pong game.</p>
  <a href="tic-tac-toe.html">
    <img src="Images/TTT.png" alt="Tic Tac Toe Game" style="width: 100px; height: auto;">
  </a>
  <p>Click on the image to play the Tic Tac Toe game.</p>
</div>

<div id="Reviews" class="tabcontent">
  <h3>Reviews</h3>
  <p>Read our expert reviews on the latest video games.</p>
</div>

<div id="ComingSoon" class="tabcontent">
  <h3>Coming Soon</h3>
  <p>Get excited for the upcoming game releases.</p>
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
