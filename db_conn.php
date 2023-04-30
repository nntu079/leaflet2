<?php


$host = 'ces-gis';
$port = '5432';
$dbname = 's20';
$user = 's20';
$password = 'password';

$conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");
if (!$conn) {
    echo "Not connected: ";
    exit;
}
