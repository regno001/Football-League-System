<?php
// Start session only if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Define constants safely
if (!defined('SITEURL')) {
    define('SITEURL', 'http://localhost:8080/football/');
}
if (!defined('LOCALHOST')) {
    define('LOCALHOST', 'localhost');
}
if (!defined('DB_USERNAME')) {
    define('DB_USERNAME', 'root');
}
if (!defined('DB_PASSWORD')) {
    define('DB_PASSWORD', '');
}
if (!defined('DB_NAME')) {
    define('DB_NAME', 'football');
}

// Establish database connection (with DB selected directly)
$conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check for connection errors
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
