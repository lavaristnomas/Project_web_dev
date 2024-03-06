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

    $username = $user["username"];
    $posted = array_keys($_POST);

    if (preg_match( "/pong-upvote/i", $posted[1])) {
      $sql = "INSERT INTO reviews (username, game, up_vote) VALUES (?, ?, ?)";
      $stmt = $mysqli->stmt_init();
      $stmt->prepare($sql);

      $game = "pong";

      $vote = 1;

      $stmt->bind_param("sss", $username, $game, $vote);

      if (!$stmt->execute()) {
        $sql = "DELETE FROM reviews WHERE username = '$username' AND game= 'pong' ";
        $mysqli->query($sql);
      }
    }
    if (preg_match( "/snake-upvote/i", $posted[1])) {
      $sql = "INSERT INTO reviews (username, game, up_vote) VALUES (?, ?, ?)";

      $stmt = $mysqli->stmt_init();
      $stmt->prepare($sql);
      $game = "snake";

      $vote = 1;

      $stmt->bind_param("sss", $username, $game, $vote);

      if (!$stmt->execute()) {
        $sql = "DELETE FROM reviews WHERE username = '$username' AND game= 'snake' ";
        $mysqli->query($sql);
      }
    }  
    if (preg_match( "/ttt-upvote/i", $posted[1])) {
      $sql = "INSERT INTO reviews (username, game, up_vote) VALUES (?, ?, ?)";

      $stmt = $mysqli->stmt_init();
      $stmt->prepare($sql);
      $game = "ttt";

      $vote = 1;

      $stmt->bind_param("sss", $username, $game, $vote);

      if (!$stmt->execute()) {
        $sql = "DELETE FROM reviews WHERE username = '$username' AND game= 'ttt' ";
        $mysqli->query($sql);
      }
    } 
    if (preg_match( "/pong-downvote/i", $posted[1])) {
      $sql = "INSERT INTO reviews (username, game, down_vote) VALUES (?, ?, ?)";

      $stmt = $mysqli->stmt_init();
      $stmt->prepare($sql);
      $game = "pong";

      $vote = 1;

      $stmt->bind_param("sss", $username, $game, $vote);

      if (!$stmt->execute()) {
        $sql = "DELETE FROM reviews WHERE username = '$username' AND game= 'pong' ";
        $mysqli->query($sql);
      }
    }
    if (preg_match( "/snake-downvote/i", $posted[1])) {
      $sql = "INSERT INTO reviews (username, game, down_vote) VALUES (?, ?, ?)";

      $stmt = $mysqli->stmt_init();
      $stmt->prepare($sql);
      $game = "snake";

      $vote = 1;

      $stmt->bind_param("sss", $username, $game, $vote);

      if (!$stmt->execute()) {
        $sql = "DELETE FROM reviews WHERE username = '$username' AND game= 'snake' ";
        $mysqli->query($sql);
      }
    }  
    if (preg_match( "/ttt-downvote/i", $posted[1])) {
      $sql = "INSERT INTO reviews (username, game, down_vote) VALUES (?, ?, ?)";

      $stmt = $mysqli->stmt_init();
      $stmt->prepare($sql);
      $game = "ttt";

      $vote = 1;

      $stmt->bind_param("sss", $username, $game, $vote);

      if (!$stmt->execute()) {
        $sql = "DELETE FROM reviews WHERE username = '$username' AND game = 'ttt' ";
        $mysqli->query($sql);
      }
    } 
   
  }
  header("Location: ".$_SERVER['HTTP_REFERER']);
  exit;
}