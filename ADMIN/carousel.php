<?php
include "include/config.php";

// Ambil username dari URL
$username = isset($_GET['username']) ? $_GET['username'] : '';

// Query untuk mengambil data pengguna berdasarkan username
$query = mysqli_query($connection, "SELECT * FROM user WHERE username = '$username'");

// Mengambil data pengguna
$user = mysqli_fetch_assoc($query);
?>


<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" 
integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<meta charset="UTF-8">
 <meta name="viewport" content="width=device-width,
 initial-scale1.0">
 <title> BO.Tix.id </title>

 <style>
  .navbar{
    height: 100px;
	background-color: #26355D; 
  }
</style>
 <style>
  .bawah{
	margin: auto;
	background-color: #F8F4E1; 
  }
  .html{
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
                <style>
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
                </style>
            </div>
            <form class="d-flex" method="GET">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search_query">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>
    </nav>
    <!-- konten halaman Anda di sini -->
</div>

    <!--membuat akhir menu-->
<div class="bawah">
<!--membuat slide-->
<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
    <!--src buat masukin foto-->
      <img src="imageslider/icon.jpg" class="d-block w-100" alt="Gambar tidak ada">
      <div class="carousel-caption d-none d-md-block">
        <h5> </h5>
        <p> </p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="imageslider/menu.jpg" class="d-block w-100" alt="Gambar Tidak ada">
      <div class="carousel-caption d-none d-md-block">
        <h5> </h5>
        <p> </p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="imageslider/imax.jpg" class="d-block w-100" alt="Gambar tidak ada">
      <div class="carousel-caption d-none d-md-block">
        <h5> </h5>
        <p> </p>
      </div>
    </div>
	<style>
  .carousel-item img {
    max-height: 340px;
	padding-top: 20px;
	margin: auto;
	max-width: 1300px;
  }
</style>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
  
  
</div>

<!--membuat berita-->

<div
  id="carouselMultiItemExample"
  class="carousel slide carousel-dark text-center"
  data-mdb-ride="carousel"
>
  <!-- Controls -->
  
  <!-- Inner -->
  <div class="carousel-inner py-4">
    <!-- Single item -->
      <div class="container">
		
		<div class="row">
          <?php
          // Fetch data for hotels from the database
          $movieQuery = mysqli_query($connection, "SELECT * FROM movie"); // Ambil tiga data pertama

          while ($movieRow = mysqli_fetch_array($movieQuery)) {
          ?>
            <div class="col-lg-3 d-flex align-items-stretch">
              <div class="card">
                <a class="card-link" href="detailUser.php?movie_id=<?php echo $movieRow['movie_id']; ?>&username=<?php echo $username; ?>">
                  <?php
                  // Check if movie_img exists and is a file
                  if (isset($movieRow['movie_img']) && is_file("images/" . $movieRow['movie_img'])) {
                  ?>
                    <img src="images/<?php echo $movieRow['movie_img']; ?>" class="card-img-top" alt="Movie Image">
                  <?php
                  } else {
                  ?>
                    <img src="images/noimage.png" class="card-img-top" alt="No Image">
                  <?php
                  }
                  ?>
                  <div class="card-body">
                    <h6 class="card-title"><?php echo $movieRow['judul']; ?></h6>
                    <p class="card-text"><?php echo $movieRow['usia']; ?></p>
                  </div>
                </a>
              </div>
            </div>
          <?php
          }
          ?>
        </div>

<!-- End Video Section with Border -->


</div>
    <!-- Single item -->

  <!-- Inner -->
  
  <style>
        .card {
            position: relative;
            overflow: hidden;
            border-radius: 10px;
            transition: transform 0.3s ease;
			margin-bottom: 15px;
        }

        .card:hover {
            transform: translateY(-10px); /* Menggeser card ke atas saat hover */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Bayangan yang muncul saat hover */
        }

        .card-link {
            text-decoration: none; /* Menghapus dekorasi link */
            color: inherit; /* Mewarisi warna teks dari parent */
        }

        .card-img-top {
            width: 100%;
            height: auto;
        }

        .card-body {
            padding: 10px;
        }

        .card-title {
            font-size: 1rem;
            margin-bottom: 5px;
        }

        .card-text {
            font-size: 0.875rem;
            color: #6c757d;
        }
    </style>

  

</div>
<!-- Carousel wrapper -->

<!--membuat akhir galeri-->

</div>
</div> <!--penutup container-fluid-->

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" 
integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</html>