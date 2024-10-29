<?php
include "include/config.php";

// Inisialisasi variabel
$showContinueButton = false;
$username = '';

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query untuk memeriksa apakah username dan password cocok
    $check_query = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($connection, $check_query);

    if (mysqli_num_rows($result) > 0) {
        // Jika username dan password cocok, tampilkan tombol "Continue your book?"
        $success_message = "Anda berhasil login.";
        $showContinueButton = true;
    } else {
        // Jika username dan password tidak cocok, tampilkan pesan error
        $error_message = "Silahkan coba lagi.";
    }

    mysqli_close($connection);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        .navbar {
            height: 100px;
            background-color: #26355D;
        }

        .depan {
			background-color: #F8F4E1;
			padding: 10px;
			margin-bottom: 10px;
			padding-top: 230px;
			padding-bottom: 310px;
		}
		.bawah {
			width: 1000px;
			margin: auto;
			background-color: #F8F4E1;
			padding: 15px;
			margin-top: 15px;
			border-radius: 10px;
			box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);

        .masuk {
            width: 900px;
            margin: auto;
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
                        <a class="nav-link" href="f-daftartransportasi">Theaters</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Up Coming</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="loginuser.php">Login</a>
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
        </div>
    </nav>
    <!--membuat akhir menu-->
	<div class="depan">
    <div class="bawah">
        <h1>Selamat Datang</h1>
        <hr>
        <div class="masuk">
            <h5>Masukan Username</h5>
            <form method="POST" action="signup.php">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
                    <label for="username">Username</label>
                </div>

                <h5>Masukan Password</h5>
                <div class="form-floating">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                    <label for="password">Password</label>
                </div>
				<div class="button-container">
					<button class="btn btn-primary mt-3" type="submit" name="submit">Login</button>
					<a href="loginuser.php" class="btn btn-primary mt-3">Don't have an account?</a>
                </div>
            </form>
        </div>
        <div class="masuk">
            <?php if (isset($error_message)) { ?>
                <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                    <?php echo $error_message; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php } ?>

            <?php if (isset($success_message)) { ?>
                <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                    <?php echo $success_message; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php } ?>

            <?php if ($showContinueButton) { ?>
                <a href="indexUser.php?username=<?php echo $username; ?>" class="btn btn-success mt-3">Continue your book?</a>
            <?php } ?>
        </div>
    </div>
	</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
