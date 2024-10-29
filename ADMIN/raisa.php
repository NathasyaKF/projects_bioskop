<?php
include "include/config.php";

// Ambil movie_id dari URL
$movie_id = isset($_GET['movie_id']) ? $_GET['movie_id'] : '';

// Query untuk mengambil data film berdasarkan movie_id
$query = mysqli_query($connection, "SELECT * FROM movie WHERE movie_id = '$movie_id'");
// Mengambil data film
$movie = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html lang="en">


<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Info</title>

    <style>
    .navbar {
        height: 80px;
        background-color: #254336;
    }

    .bawah {
        width: 1000px;
        margin: auto;
        background-color: #eeeeee;
        padding: 15px;
        margin-top: 15px;
    }

    .navbar-nav .nav-link {
        font-size: 16px;
        font-family: Arial, sans-serif;
        font-weight: bold;
        color: white;
        margin-right: 20px;
        transition: background-color 0.3s, color 0.3s;
    }

    .navbar-nav .nav-link:hover {
        background-color: #f8f9fa;
        color: black;
    }

    .kiri {
        width: 300px;
		margin-bottom: 15px;
    }

    .kanan {
        margin-left: 30px;
        width: 700px;
    }

    .foto {
        margin-top: 15px;
        display: flex;
        align-items: flex-start;
    }

    .button-container {
        display: flex;
        flex-direction: column;
        gap: 10px;
        margin-top: 30px;
    }

    .btn-custom {
        display: block;
        width: 400px;
        height: 50px;
        background-color: #007bff;
        color: #fff;
        text-decoration: none;
        border: none;
        border-radius: 5px;
        font-size: 20px;
        text-align: center;
        line-height: 50px;
        transition: background-color 0.3s;
    }

    .btn-custom:hover {
        background-color: #0056b3;
    }
    </style>

</head>

<body>
    <div class="container-fluid">
        <!--membuat menu-->
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="UAS-SOFTDEV.php">Now Playing</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="ADMIN/f-daftartransportasi">Theaters</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Up Coming</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Playing in - </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!--membuat akhir menu-->

        <div class="bawah">
            
			<iframe width="970" height="600" src="https://youtu.be/PRuv0CBNGvw?si=heVOW3-pHgMQVxEN" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
            
        </div>

    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>

</html>
