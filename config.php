<?php
$DB_HOST = 'sql110.infinityfree.com';
$DB_USER = 'if0_43057700';
$DB_PASS = 'your account password';
$DB_NAME = 'if0_43057700_students_db';

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
