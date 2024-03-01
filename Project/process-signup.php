<?php
mysqli_report(MYSQLI_REPORT_OFF);

if (empty($_POST["username"])) {
    die("Username is required");
}

if (! filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    die("Valid email is required");
}

if (strlen($_POST["password"] < 8)) {
    die("Password must be at least 8 characters");
}

if (! preg_match("/[a-z]/i", $_POST["password"])) {
    die("Password must contain at least one letter");
}

if (! preg_match("/[0-9]/", $_POST["password"])) {
    die("Password must contain at least one number");
}

if ($_POST["password"] !== $_POST["verify-password"]) {
    die("Passwords must match");
}

$password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

$mysqli = require __DIR__ . "/database.php";

$sql = "INSERT INTO user (username, email, password_hash) VALUES (?, ?, ?)";

$stmt = $mysqli->stmt_init();

if (! $stmt->prepare($sql)) {
    die("SQL error: ".$mysqli->error);
}

$stmt->bind_param("sss", $_POST["username"], $_POST["email"], $password_hash);

if ($stmt->execute()) {
        header("Location: signup-success.html");
        exit;
} else {

    if ($mysqli->errno == 1062 && preg_match("/username/i", $mysqli->error)) {
        echo "The requested username is taken.";
    } else if ($mysqli->errno == 1062 && preg_match("/email/i", $mysqli->error)) {
        echo "This email is already assigned to an existing account.";
    } else {
        die($mysqli->error." ".$mysqli->errno);
    }
}