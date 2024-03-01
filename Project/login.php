<?php
mysqli_report(MYSQLI_REPORT_OFF);
$is_invalid = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mysqli = require __DIR__ ."/database.php";

    $sql = sprintf("SELECT * FROM user WHERE username = '%s'", $mysqli->real_escape_string($_POST["username"]));

    $result = $mysqli->query($sql);

    $user = $result->fetch_assoc();

    if ($user) {

        if (password_verify($_POST["password"], $user["password_hash"])) {

            session_start();

            session_regenerate_id();

            $_SESSION["user_id"] = $user["id"];

            header("Location: website.php");
            exit;
        }
    }

    $is_invalid = true;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./signup.css">
    <title>Log in</title>
</head>
<body>
    <div class="banner">
        <h1>Welcome to Gaming Website</h1>
    </div>
    <div class="container">
        <h1>Log in</h1>
        <form method="post">
            <div>
                <label for="username">Username</label>
                <input type="text" id="username" name="username" value="<?= htmlspecialchars($_POST["username"] ?? "") ?>">
            </div>
            <div>
                <label for="password">Password</label>
                <input type="password" id="password" name="password">
            </div>
            <button>Log in</button>
        </form>
        <p>Don't have an account? <a href="./signup.html" style="font-size: 16px;">Sign up!</a></p>
        <?php if ($is_invalid): ?>
            <p>Invalid login. Please try again.</p>
        <?php endif; ?>
    </div>
    <div class="footer">
        Copyright &copy GW 2024
    </div>
</body>
</html>