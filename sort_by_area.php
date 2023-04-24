<?php
include 'db_conn.php';


$sql = "select * from national_parks_august_2016_full_clipped_boundaries_in_great_bri order by st_areasha desc";

$result = pg_query($conn, $sql);
?>

<table>
    <tr>
        <td>id</td>
        <td>Name</td>
        <td>Area</td>
    </tr>

    <?php
    if (pg_num_rows($result) > 0) {
        while ($results = pg_fetch_array($result)) {
            echo "<tr><td>" . $results['objectid'] . "</td>";
            echo "<td>" . $results['npark16nm'] . "</td>";
            echo "<td>" . $results['st_areasha'] . "</td>";
        }
    }
    ?>
</table>