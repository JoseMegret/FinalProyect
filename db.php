<?php
$host = "localhost";
$username = "jose.megret";
$password = "801217986";
$dbname = "jose.megret";

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
