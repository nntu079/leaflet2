<?php
include '../db_conn.php';


$sql = "select * from national_parks_august_2016_full_clipped_boundaries_in_great_bri";

$result = pg_query($conn, $sql);
?>




<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

    <!-- leaflet -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js" integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>

    <!-- jiquery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <style>
        #map {
            height: 100vh;
            width: 100%;
        }
    </style>

</head>

<body>

    <script>
        $.ajax({
            type: "POST",
            url: 'map1_db.php',
            dataType: 'json',
            data: {
                test: "test"
            },

            success: function(obj, textstatus) {

                console.log({
                    obj,
                    a: "a"
                })

            }
        });
    </script>

    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">HOAISON 1</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                    <li class="nav-item">
                        <a href="./map1.php" id="nav1" class="nav-link active" aria-current="page">National Parks</a>
                    </li>

                    <li class="nav-item">
                        <a href="./map2.php" id="nav2" class="nav-link" aria-current="page">Builtup Areas</a>
                    </li>

                    <li class="nav-item">
                        <a href="./map3.php" id="nav3" class="nav-link">Major Towns and Cities</a>
                    </li>



                </ul>

            </div>
        </div>
    </nav>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">objectid</th>
                <th scope="col">npark16cd</th>
                <th scope="col">npark16nm</th>
                <th scope="col">npark16nmw</th>
                <th scope="col">st_areasha</th>
                <th scope="col">st_lengths</th>
            </tr>
        </thead>
        <tbody>

            <?php
            if (pg_num_rows($result) > 0) {
                while ($results = pg_fetch_array($result)) {
                    echo '<tr>
                    <td scope="row">' . $results["objectid"] . '</td>
                    <td>' . $results["npark16cd"] . '</td>
                    <td> ' . $results["npark16nm"] . '</td>
                    <td> ' . $results["npark16nmw"] . '</td>
                    <td> ' . $results["st_areasha"] . '</td>
                    <td> ' . $results["st_lengths"] . '</td>
                 
                  </tr>';
                }
            }
            ?>
        </tbody>
    </table>
</body>