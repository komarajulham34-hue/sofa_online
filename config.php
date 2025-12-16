<?php
// config.php - edit credentials for your environment
// Keep this file outside webroot if possible

$DB_HOST = 'localhost';
$DB_USER = 'root';
$DB_PASS = '';
$DB_NAME = 'sofa_online';

// connect
$conn = mysqli_connect($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
if (!$conn) {
    die("DB Connection failed: " . mysqli_connect_error());
}

// helper: escape and simple fetch
function e($s){ return htmlspecialchars($s, ENT_QUOTES); }
?>
