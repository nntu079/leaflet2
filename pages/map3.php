<!DOCTYPE html>
<html lang="en">

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
            <a class="navbar-brand" href="/index.php">HOAISON </a>
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
                        <a href="./map3.php" id="nav3" class="nav-link active">Major Towns and Cities</a>
                    </li>


                    <a class="nav-link" href="./map3_details.php" role="button" aria-expanded="false">
                        View details
                    </a>

                    <liv class="nav-item">
                        <select id="change_view" class="custom-select">
                            <option value="1">OMS</option>
                            <option value="2">Google Sreet</option>
                            <option value="3">WaterColor</option>
                        </select>
                    </liv>

                </ul>
                <form class="d-flex" role="search" id="formSearch">
                    <input name="keywords" class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>
    <div id="spinner">
        <div class="spinner-grow text-primary" role="status">
            <span class="sr-only">Loading...</span>
        </div>
        <div class="spinner-grow text-secondary" role="status">
            <span class="sr-only">Loading...</span>
        </div>
        <div class="spinner-grow text-success" role="status">
            <span class="sr-only">Loading...</span>
        </div>
        <div class="spinner-grow text-danger" role="status">
            <span class="sr-only">Loading...</span>
        </div>
        <div class="spinner-grow text-warning" role="status">
            <span class="sr-only">Loading...</span>
        </div>
        <div class="spinner-grow text-info" role="status">
            <span class="sr-only">Loading...</span>
        </div>
        <div class="spinner-grow text-light" role="status">
            <span class="sr-only">Loading...</span>
        </div>
        <div class="spinner-grow text-dark" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>


    <div id="map">

    </div>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../mylibs/index.js"> </script>
    <script src="../scripts/map3.js"> </script>

</body>



</html>