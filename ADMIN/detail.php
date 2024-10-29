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
        height: 100px;
        background-color: #26355D;
    }
	.depan {
        background-color: #F8F4E1;
		padding: 10px;
		margin-bottom: 10px;
	}
    .bawah {
        width: 1000px;
        margin: auto;
        background-color: #F8F4E1;
        padding: 15px;
        margin-top: 15px;
		border-radius: 10px;
		box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .navbar-nav .nav-link {
        font-size: 20px;
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
	.kiri img {
		width: 100%;
		border-radius: 10px;
		box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
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
		box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .btn-custom:hover {
        background-color: #92C7CF;
    }
    </style>

</head>

<body>
    <div class="container-fluid">
        <!--membuat menu-->
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
				<a class="navbar-brand" href="#">
				<img src="images/botix.png" alt="Logo">
			  </a>
				<style>
				.navbar-brand img {
					height: 250px; /* Adjust the height as needed */
					width: auto;
				}
				</style>
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="../index.php">Now Playing</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="ADMIN/f-daftartransportasi">Theaters</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Up Coming</a>
                        </li>
                        <li class="nav-item">
							<a class="nav-link" href="loginuser.php">Login</a>
						</li>
                    </ul>
                </div>
            </div>
        </nav>
        <!--membuat akhir menu-->
	<div class="depan">
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
                            <a href="ticketbuy.php?movie_id=<?php echo $movie['movie_id']; ?>" class="btn-custom">Buy Ticket</a>
                            <a href="<?php echo $movie['trailer']; ?>" class="btn-custom">Trailer</a>
                        </div>
                    <?php } else { ?>
                        <p>No movie data available</p>
                    <?php } ?>
                </div>
            </div>

            <div class="deskripsi">
                <?php if ($movie) { ?>
                    <p class="sinopsis"><?php echo $movie['sinopsis']; ?></p>
                    <h5>Producer:</h5>
                    <p class="sinopsis"><?php echo $movie['producer']; ?></p>
                    <h5>Director:</h5>
                    <p class="sinopsis"><?php echo $movie['director']; ?></p>
                    <h5>Writer:</h5>
                    <p class="sinopsis"><?php echo $movie['writer']; ?></p>
                    <h5>Cast:</h5>
                    <p class="sinopsis"><?php echo $movie['cast']; ?></p>
                    <h5>Distributor:</h5>
                    <p class="sinopsis"><?php echo $movie['distributor']; ?></p>
                <?php } else { ?>
                    <p>No movie data available</p>
                <?php } ?>
            </div>
        </div>
	</div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>
<footer style="background-color: #26355D; ">
    <div class="container" style="background-color:#26355D; padding: 10px;">
        <div class="row" >
            <div class="col-md-2">
			</div>
			<div class="col-md-5">
                <h4 style="color: white;">Kelompok 6: </h4>
                <p style="color: white;">Nathasya Kristianti Ferdiana - 825220102</p>
				<p style="color: white;">Valencia - 825220108</p>
				<p style="color: white;">Putri Dewi Zabita - 825220135</p>
				<p style="color: white;">Novia Syahfitri - 825220156</p>
            </div>
            <div class="col-md-3">
                <h4 style="color: white;">Email</h4>
				<p style="color: white;">nathasya.825220102@stu.untar.ac.id</p>
				<p style="color: white;">valencia.825220108@stu.untar.ac.id</p>
                <p style="color: white;">putri.825220135@stu.untar.ac.id</p>
				<p style="color: white;">novia.825220156@stu.untar.ac.id</p>
            </div>
        </div>
    </div>
    <div class="bg-secondary text-center py-2">
        <p class="mb-0">&copy; 2024 BO.Tix All rights reserved.</p>
    </div
</footer>
</html>