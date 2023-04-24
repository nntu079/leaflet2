<?php


$host = 'localhost';
$port = '5432';
$dbname = 'geo2';
$user = 'postgres';
$password = 'password';

// Kết nối database tintuc
$conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");
if (!$conn) {
    echo "Not connected: ";
    exit;
}
