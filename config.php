<?php
// ---- DATABASE SETTINGS ----
// Local (XAMPP) defaults. On InfinityFree, replace with the values from your
// hosting control panel (MySQL Databases). Never commit real passwords to GitHub.
$DB_HOST = 'localhost';        // InfinityFree: e.g. sql123.infinityfree.com
$DB_USER = 'root';             // InfinityFree: e.g. if0_12345678
$DB_PASS = '';                 // InfinityFree: your vPanel/MySQL password
$DB_NAME = 'student_db';       // InfinityFree: e.g. if0_12345678_student_db

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
try {
    $conn = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
    $conn->set_charset('utf8mb4');
} catch (mysqli_sql_exception $ex) {
    die('Could not connect to the database. Check the settings in config.php.');
}

// Escape text before printing it in HTML
function e($value) {
    return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
}
