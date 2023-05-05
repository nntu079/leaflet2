<?php
include '../db_conn.php';

header('Content-Type: application/json');


$sql = "select * from national_parks_august_2016_full_clipped_boundaries_in_great_bri";

$result = pg_query($conn, $sql);

echo json_encode(pg_fetch_all($result));
