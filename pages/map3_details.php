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

    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">HOAISON </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                    <li class="nav-item">
                        <a href="./map1.php" id="nav1" class="nav-link " aria-current="page">National Parks</a>
                    </li>

                    <li class="nav-item">
                        <a href="./map2.php" id="nav2" class="nav-link" aria-current="page">Builtup Areas</a>
                    </li>

                    <li class="nav-item">
                        <a href="./map3.php" id="nav3" class="nav-link active">Major Towns and Cities</a>
                    </li>



                </ul>

            </div>
        </div>
    </nav>

    <div class="mb-3">
        <label class="form-label">Area</label>
        <input id="filter" class="form-control bootstrap-table-filter-control-price"></input>
    </div>

    <table class="table" id="table">
        <thead>
            <tr>
                <th scope="col">gid</th>
                <th scope="col">objectid</th>
                <th scope="col">tcity15cd</th>
                <th scope="col" onclick="SortByName()" style="cursor:pointer">tcity15nm</th>
                <th scope="col" onclick="SortByArea()" style="cursor:pointer">st_areasha</th>
                <th scope="col">st_lengths</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>

    <script>
        var table = document.getElementById("table");
        var countArea = 0
        var countName = 0

        function getData(sql) {
            for (var i = 1; i < table.rows.length;) {
                table.deleteRow(i);
            }

            $.ajax({
                type: "POST",
                url: '../db/db_query.php',
                dataType: 'json',
                data: {
                    sql
                },
                success: function(obj, textstatus) {
                    obj.forEach(element => {
                        var row = table.insertRow(-1);

                        var cell1 = row.insertCell(0);
                        var cell2 = row.insertCell(1);
                        var cell3 = row.insertCell(2);
                        var cell4 = row.insertCell(3);
                        var cell5 = row.insertCell(4);
                        var cell6 = row.insertCell(5);

                        cell1.innerHTML = element.gid;
                        cell2.innerHTML = element.objectid;
                        cell3.innerHTML = element.tcity15cd;
                        cell4.innerHTML = element.tcity15nm;
                        cell5.innerHTML = element.st_areasha;
                        cell6.innerHTML = element.st_lengths;
                    });
                }
            });
        }

        getData("select * from major_towns_and_cities_december_2015_boundaries")

        function SortByArea() {
            countArea = countArea + 1;
            if (countArea % 2 == 0) {
                getData(`select * 
                from major_towns_and_cities_december_2015_boundaries
                order by st_areasha ASC 
                `)
            } else {
                getData(`select * 
                from major_towns_and_cities_december_2015_boundaries
                order by st_areasha DESC 
                `)
            }
        }

        function SortByName() {
            countName = countName + 1;
            if (countName % 2 == 0) {
                getData(`select * 
                from major_towns_and_cities_december_2015_boundaries
                order by tcity15nm ASC 
                `)
            } else {
                getData(`select * 
                from major_towns_and_cities_december_2015_boundaries
                order by tcity15nm DESC 
                `)
            }
        }

        filter.addEventListener("change", (e) => {
            value = e.target.value
            if (value) {
                getData(`select * 
                        from national_parks_august_2016_full_clipped_boundaries_in_great_bri
                        where st_areasha >= ${value}
                `)
            } else {
                getData("select * from national_parks_august_2016_full_clipped_boundaries_in_great_bri")
            }
        })
    </script>
</body>