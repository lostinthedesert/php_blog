<?php

if (file_exists(__DIR__ . '/.env')) {
    $env = parse_ini_file(__DIR__ . '/.env');
} else {
    die("Error: .env file not found.");
}

// Database connection using environment variables
$host = $env['MARIADB_HOSTNAME'];
$user = $env['MARIADB_USER'];
$password = $env['MARIADB_PASS'];
$dbname = $env['MARIADB_NAME'];

$conn = new mysqli($host, $user, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
