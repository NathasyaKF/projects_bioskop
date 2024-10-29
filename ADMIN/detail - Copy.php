<?php
include "include/config.php";

// Ambil kode_movie dari URL
$kode_movie = isset($_GET['kode_movie']) ? $_GET['kode_movie'] : '';

// Query untuk mengambil data film berdasarkan kode_movie
$query = mysqli_query($connection, "SELECT * FROM movie WHERE kode_movie = '$kode_movie'");

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
        margin-left: 50px;
        width: 700px;
    }

    .foto {
        margin-top: 90px;
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
            <div class="atas">
                <?php if ($movie) { ?>
                    <h4 class="judul"><?php echo $movie['judul']; ?></h4>
                    <p class="genre"><?php echo $movie['genre']; ?></p>
                    <hr>
                <?php } else { ?>
                    <p>No movie data available</p>
                <?php } ?>
            </div>

            <div class="foto">
                <div class="kiri">
                    <?php if ($movie && isset($movie['movie_img']) && is_file("images/" . $movie['movie_img'])) { ?>
                        <img src="images/<?php echo $movie['movie_img']; ?>" alt="Movie Image">
                    <?php } else { ?>
                        <img src="images/noimage.png" alt="No Image">
                    <?php } ?>
                </div>

                <div class="kanan">
                    <?php if ($movie) { ?>
                        <h5 class="durasi"><?php echo $movie['durasi']; ?></h5>
                        <button type="button" class="btn btn-secondary btn-lg" disabled><?php echo $movie['jenis_bioskop']; ?></button>
                        <button type="button" class="btn btn-secondary btn-lg" disabled><?php echo $movie['usia']; ?></button>
                        <div class="button-container">
                            <a href="ticketbuy.php?kode_movie=<?php echo $movie['kode_movie']; ?>" class="btn-custom">Buy Ticket</a>
                            <a href="index.php" class="btn-custom">Trailer</a>
                        </div>
                    <?php } else { ?>
                        <p>No movie data available</p>
                    <?php } ?>
                </div>
            </div>

            <div class="deskripsi">
                <?php if ($movie) { ?>
                    <p class="sinopsis"><?php echo $movie['sinopsis']; ?></p>
                    <h4>Producer:</h4>
                    <p class="sinopsis"><?php echo $movie['producer']; ?></p>
                    <h4>Director:</h4>
                    <p class="sinopsis"><?php echo $movie['director']; ?></p>
                    <h4>Writer:</h4>
                    <p class="sinopsis"><?php echo $movie['writer']; ?></p>
                    <h4>Cast:</h4>
                    <p class="sinopsis"><?php echo $movie['cast']; ?></p>
                    <h4>Distributor:</h4>
                    <p class="sinopsis"><?php echo $movie['distributor']; ?></p>
                <?php } else { ?>
                    <p>No movie data available</p>
                <?php } ?>
            </div>
        </div>

    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>

</html>
