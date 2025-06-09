<?php

$envPath = getenv('ENV_FILE');
$env = $envPath ? parse_ini_file($envPath) : parse_ini_file(__DIR__ . '/.env');


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
