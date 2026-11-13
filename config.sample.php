<?php
// Database settings - change DB_PASS to the password of the MySQL user you create
$DB_HOST = 'localhost';
$DB_USER = 'terence';
$DB_PASS = 'CHANGE_ME';
$DB_NAME = 'CAT2';

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
try {
    $conn = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
    $conn->set_charset('utf8mb4');
} catch (mysqli_sql_exception $e) {
    die('Database connection failed: ' . htmlspecialchars($e->getMessage()));
}
session_start();
