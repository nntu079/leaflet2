<?php
include '.././db/db_conn.php';

header('Content-Type: application/json');

$sql = $_POST['sql'];
$result = pg_query($conn, $sql);

echo json_encode(pg_fetch_all($result));
