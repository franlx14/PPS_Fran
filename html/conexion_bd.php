<?php

// Load environment variables from .env file
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Retrieve database credentials from environment variables
$db_hostname = getenv('DB_HOSTNAME');
$db_database = getenv('DB_DATABASE');
$db_username = getenv('DB_USERNAME');
$db_password = getenv('DB_PASSWORD');

// Create connection
$conn = new mysqli($db_hostname, $db_username, $db_password, $db_database);
?>
