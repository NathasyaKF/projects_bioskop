<?php
include "include/config.php";

// Ambil movie_id dan showtime_id dari URL
$movie_id = isset($_GET['movie_id']) ? $_GET['movie_id'] : '';
$showtime_id = isset($_GET['showtime_id']) ? $_GET['showtime_id'] : '';
$username = isset($_GET['username']) ? $_GET['username'] : '';

// Query untuk mengambil data pengguna berdasarkan username
$query = mysqli_query($connection, "SELECT * FROM user WHERE username = '$username'");


// Query untuk mengambil data film berdasarkan movie_id
$query_movie = mysqli_query($connection, "SELECT * FROM movie WHERE movie_id = '$movie_id'");
// Mengambil data film
$movie = mysqli_fetch_assoc($query_movie);

// Query untuk mengambil data jadwal tayang
$query_showtimes = mysqli_query($connection, "
    SELECT s.showtime_id, s.theater, s.show_time, s.price, s.show_date, c.name as cinema_name, c.address, c.kode_kota, m.judul, m.durasi, m.jenis_bioskop, m.usia, m.movie_img, t.username
    FROM showtimes s 
    JOIN cinema c ON s.cinema_id = c.cinema_id 
    JOIN movie m ON s.movie_id = m.movie_id
    LEFT JOIN ticket t ON s.showtime_id = t.showtime_id AND t.username = '$username'
    WHERE s.showtime_id = '$showtime_id'
");

// Initialize $showtimes as an empty array
$showtimes = [];

// Check if there are results from the query
if ($query_showtimes && mysqli_num_rows($query_showtimes) > 0) {
    $showtimes = mysqli_fetch_assoc($query_showtimes);
}

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
            margin-left: 30px;
            width: 700px;
        }
        .foto {
            margin-top: 15px;
            display: flex;
            align-items: flex-start;
        }
		.kiri img {
			width: 100%;
			border-radius: 10px;
			box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
		}
		.btn-primary {
			margin-right: 8px;  /* Add margin for spacing */
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
                        <a class="nav-link" href="indexUser.php?username=<?php echo $username; ?>">Now Playing</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="f-daftartransportasi">Theaters</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Up Coming</a>
                    </li>
                    <?php if (!empty($username)): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Welcome, <?php echo htmlspecialchars($username); ?>!</a>
                            </li>
                        <?php endif; ?>
						<li class="nav-item">
                        <a class="nav-link" href="../index.php">Log Out?</a>
                    </li>
                </ul>
                </div>
            </div>
        </nav>
        <!--membuat akhir menu-->
		<div class="depan">
        <div class="bawah">
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
                        <h4 class="judul"><?php echo $movie['judul']; ?></h4>
                        <h5 class="durasi"><?php echo $movie['durasi']; ?></h5>
                        <button type="button" class="btn btn-secondary btn-lg" disabled><?php echo $movie['jenis_bioskop']; ?></button>
                        <button type="button" class="btn btn-secondary btn-lg" disabled><?php echo $movie['usia']; ?></button>
                    <?php } else { ?>
                        <p>No movie data available</p>
                    <?php } ?>
                </div>
            </div>

            <div class="row mt-4">
                <?php
                // Query untuk mengambil data cinema dan showtimes yang terkait
                $query = mysqli_query($connection, "
                    SELECT c.name as cinema_name, s.show_time, s.show_date, c.cinema_id, s.showtime_id
                    FROM showtimes s
                    JOIN cinema c ON s.cinema_id = c.cinema_id
                    WHERE s.movie_id = '$movie_id'
                    ORDER BY c.cinema_id, s.show_date, s.show_time
                ");

                // Mengecek jika ada kesalahan pada query
                if (!$query) {
                    die('Query Error: ' . mysqli_error($connection));
                }

                // Initialize variables to track changes in cinema_id and show_date
                $current_cinema_id = null;
                $current_show_date = null;

                // Mulai loop untuk setiap data showtimes
                while ($showtime = mysqli_fetch_assoc($query)) {
                    // Jika cinema_id berubah, akhiri card sebelumnya dan mulai card baru
                    if ($current_cinema_id !== $showtime['cinema_id']) {
                        // Akhiri card sebelumnya (jika ada)
                        if ($current_cinema_id !== null) {
                            echo '</div>'; // Akhiri div card-body
                            echo '</div><hr>'; // Akhiri card dan tambahkan garis horizontal
                        }

                        // Mulai card baru dengan cinema_name sebagai header
                        echo '<div class="card">';
                        echo '<div class="card-header">' . $showtime['cinema_name'] . '</div>';
                        echo '<div class="card-body">';

                        // Perbarui current_cinema_id dan reset current_show_date
                        $current_cinema_id = $showtime['cinema_id'];
                        $current_show_date = null;
                    }

                    // Jika show_date berubah, tampilkan show_date dan mulai div baru untuk kumpulan show_time
                    if ($current_show_date !== $showtime['show_date']) {
                        // Akhiri div kumpulan show_time sebelumnya (jika ada)
                        if ($current_show_date !== null) {
                            echo '</div>'; // Akhiri div kumpulan button show_time
                        }

                        // Tampilkan show_date
                        echo '<p class="card-text">' . $showtime['show_date'] . '</p>';
                        echo '<div class="btn-group" role="group">'; // Mulai div kumpulan button show_time

                        // Perbarui current_show_date
                        $current_show_date = $showtime['show_date'];
                    }

                    // Tampilkan button show_time
                    echo '<a href="ticketUser.php?showtime_id=' . $showtime['showtime_id'] . '&username=' . $username . '" class="btn btn-primary">' . $showtime['show_time'] . '</a>';
                }

                // Akhiri div terakhir (jika ada)
                if ($current_cinema_id !== null) {
                    echo '</div>'; // Akhiri div kumpulan button show_time terakhir
                    echo '</div>'; // Akhiri div card-body terakhir
                }

                // Handle jika tidak ada data
                if (mysqli_num_rows($query) === 0) {
                    echo '<p>No showtimes data available</p>';
                }
                ?>
            </div>

        </div>

    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>

</html>
