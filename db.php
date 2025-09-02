<?php
$host = "localhost";
$user = "root";   // default for Laragon
$pass = "";       // default blank password
$db   = "myapp";  // your database name

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("❌ Database connection failed: " . $conn->connect_error);
}
?>
