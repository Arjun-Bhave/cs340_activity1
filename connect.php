<?php
// Update the following with your ONID-based credentials.
// DB_PASSWORD is the last 4 digits of your student ID.
define('DB_SERVER', 'classmysql.engr.oregonstate.edu');
define('DB_USERNAME', 'cs340_XXXXX'); // ← your ONID-based CS340 username
define('DB_PASSWORD', '1234');        // ← last 4 digits of your student ID
define('DB_NAME', 'cs340_XXXXX');     // ← same as DB_USERNAME

// Attempt to connect to MySQL database
$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>