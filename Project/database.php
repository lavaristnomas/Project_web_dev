<?php
$host = "localhost";
$dbname = "vdflakyl_TGH";
$username = "vdflakyl_TGH";
$password = "Hn3fKu4cDuktdSLU7B5B";

$mysqli = new mysqli($host, $username, $password, $dbname);

if($mysqli->connect_errno) {
    die("Connection error: ".$mysqli->connect_error);
}

return $mysqli;
