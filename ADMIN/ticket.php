<?php
include "include/config.php";

// Ambil showtime_id dari URL
$showtime_id = isset($_GET['showtime_id']) ? $_GET['showtime_id'] : '';

// Query untuk mengambil data showtime berdasarkan showtime_id
$query = mysqli_query($connection, "
    SELECT s.showtime_id, s.theater, s.show_time, s.price, s.show_date, c.name as cinema_name, c.address, c.kode_kota, m.judul, m.durasi, m.jenis_bioskop, m.usia, m.movie_img
    FROM showtimes s 
    JOIN cinema c ON s.cinema_id = c.cinema_id 
    JOIN movie m ON s.movie_id = m.movie_id
    WHERE s.showtime_id = '$showtime_id'
");

// Mengambil data showtime
$showtime = mysqli_fetch_assoc($query);

// Fungsi untuk generate ticket_id yang unik
function generateTicketID($connection) {
    $unique = false;
    while (!$unique) {
        $ticket_id = mt_rand(100000, 999999); // Generate random 6-digit number
        $check_query = "SELECT * FROM ticket WHERE ticket_id = '$ticket_id'";
        $result = mysqli_query($connection, $check_query);
        if (mysqli_num_rows($result) == 0) {
            $unique = true;
        }
    }
    return $ticket_id;
}

// Proses jika form untuk pembelian tiket dikirimkan
if (isset($_POST['submit'])) {
    $username = 'username_example'; // Ganti dengan username yang sesuai dari sistem login Anda
    $num_tickets = $_POST['num_tickets'];
    $payment_method = $_POST['payment_method'];
    $selected_seats = $_POST['selected_seats'];

    // Generate unique ticket_id
    $ticket_id = generateTicketID($connection);

    // Query untuk menyimpan data tiket ke dalam database
    $insert_query = "INSERT INTO ticket (ticket_id, username, showtime_id, payment, seats) 
                    VALUES ('$ticket_id', '$username', '$showtime_id', '$payment_method', '$selected_seats')";

    if (mysqli_query($connection, $insert_query)) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                  Tiket berhasil dibeli dan data berhasil disimpan ke dalam database.
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
    } else {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                  Error: ' . mysqli_error($connection) . '
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Showtime Info</title>
    <style>
        .navbar {
            height: 100px;
            background-color: #26355D;
        }
        .depan {
			background-color: #F8F4E1;
			padding: 10px;
			margin-bottom: 10px;
			padding-bottom: 200px;
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
        .btn {
            margin-bottom: 10px;
        }
        .form-group {
            margin-bottom: 10px;
            display: flex;
        }
        .form-control {
            width: 150px;
            margin-left: 10px;
        }
        .seat {
            width: 40px;
            height: 40px;
            margin: 5px;
            background-color: #f0f0f0;
            border: 2px solid #17a2b8;
            text-align: center;
            line-height: 40px;
            cursor: pointer;
		}
		.seats {
			margin-left: 15px;
			width: 500px;
		}
        .seat.selected {
            background-color: #17a2b8;
            color: white;
        }
        .seat.booked {
            background-color: #999;
            cursor: not-allowed;
        }
        .row {
            display: flex;
            justify-content: center;
        }
        .screen {
            background-color: #ccc;
            height: 50px;
            margin: 20px 0;
            text-align: center;
            line-height: 50px;
            font-weight: bold;
        }
			.btn-custom {
			display: block;
			width: 500px;
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
			margin-left: 15px;
			margin-top: 15px;
			margin-bottom: 20px;
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
            <div class="foto">
                <div class="kiri">
                    <?php if ($showtime && isset($showtime['movie_img']) && is_file("images/" . $showtime['movie_img'])) { ?>
                        <img src="images/<?php echo $showtime['movie_img']; ?>" alt="Movie Image">
                    <?php } else { ?>
                        <img src="images/noimage.png" alt="No Image">
                    <?php } ?>
                </div>

                <div class="kanan">
                    <?php if ($showtime) { ?>
                        <h4 class="judul"><?php echo $showtime['judul']; ?></h4>
                        <h6 class="durasi"><?php echo $showtime['durasi']; ?></h6>
                        <button type="button" class="btn btn-secondary btn-lg" disabled><?php echo $showtime['jenis_bioskop']; ?></button>
                        <button type="button" class="btn btn-secondary btn-lg" disabled><?php echo $showtime['usia']; ?></button>
                        <h5 class="cinema"><?php echo $showtime['cinema_name']; ?></h5>
                        <p class="address"><?php echo $showtime['address']; ?></p>
                        <p class="showtime"><?php echo $showtime['show_date'] . ' | ' . $showtime['show_time']. ' | Theater: ' . $showtime['theater']; ?></p>
                    <?php } else { ?>
                        <p>No showtime data available</p>
                    <?php } ?>
                    <div class="down">
                        <p>Total Price: <span id="totalPrice"><?php echo $showtime['price']; ?></span></p>
                        <form method="POST">
                            <div class="form-group">
                                <label for="ticketSelect">Jumlah Tiket: </label>
                                <select class="form-control" id="ticketSelect" name="num_tickets" onchange="calculateTotal()">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                    <option>6</option>
                                    <option>7</option>
                                    <option>8</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="paymentSelect">Metode Pembayaran: </label>
                                <select class="form-control" id="paymentSelect" name="payment_method">
                                    <option value="Bank Transfer">Bank Transfer</option>
                                    <option value="Credit Card">Credit Card</option>
                                    <option value="Dana">Dana</option>
                                    <option value="OVO">OVO</option>
                                </select>
                            </div>
                            <div class="seats">
                                <div class="screen">Screen</div>
								<div class="seats">
                                <div class="row">
											<div class="seat" onclick="selectSeat(this)" data-seat="1">1</div>
											<div class="seat" onclick="selectSeat(this)" data-seat="2">2</div>
											<div class="seat" onclick="selectSeat(this)" data-seat="3">3</div>
											<div class="seat" onclick="selectSeat(this)" data-seat="4">4</div>
											<div class="seat" onclick="selectSeat(this)" data-seat="5">5</div>
											<div class="seat" onclick="selectSeat(this)" data-seat="6">6</div>
											<div class="seat" onclick="selectSeat(this)" data-seat="7">7</div>
											<div class="seat" onclick="selectSeat(this)" data-seat="8">8</div>
											<div class="seat" onclick="selectSeat(this)" data-seat="9">9</div>
											<div class="seat" onclick="selectSeat(this)" data-seat="10">10</div>
										</div>
										<div class="row">
											<div class="seat" onclick="selectSeat(this)" data-seat="11">11</div>
											<div class="seat" onclick="selectSeat(this)" data-seat="12">12</div>
											<div class="seat" onclick="selectSeat(this)" data-seat="13">13</div>
											<div class="seat" onclick="selectSeat(this)" data-seat="14">14</div>
											<div class="seat" onclick="selectSeat(this)" data-seat="15">15</div>
											<div class="seat" onclick="selectSeat(this)" data-seat="16">16</div>
											<div class="seat" onclick="selectSeat(this)" data-seat="17">17</div>
											<div class="seat" onclick="selectSeat(this)" data-seat="18">18</div>
											<div class="seat" onclick="selectSeat(this)" data-seat="19">19</div>
											<div class="seat" onclick="selectSeat(this)" data-seat="20">20</div>
										</div>
										<div class="row">
											<div class="seat" onclick="selectSeat(this)" data-seat="21">21</div>
											<div class="seat" onclick="selectSeat(this)" data-seat="22">22</div>
											<div class="seat" onclick="selectSeat(this)" data-seat="23">23</div>
											<div class="seat" onclick="selectSeat(this)" data-seat="24">24</div>
											<div class="seat" onclick="selectSeat(this)" data-seat="25">25</div>
											<div class="seat" onclick="selectSeat(this)" data-seat="26">26</div>
											<div class="seat" onclick="selectSeat(this)" data-seat="27">27</div>
											<div class="seat" onclick="selectSeat(this)" data-seat="28">28</div>
											<div class="seat" onclick="selectSeat(this)" data-seat="29">29</div>
											<div class="seat" onclick="selectSeat(this)" data-seat="30">30</div>
										</div>
							</div>
                            </div>
                            <input type="hidden" name="selected_seats" id="selectedSeats">
                            <input type="hidden" name="total_price" id="totalPriceInput">
                            <div class="button-container">
								<a href="loginuser.php" class="btn-custom">Buy Ticket</a>
							</div>
							<div class="button-container">
							</div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
	</div>
    </div>
</body>
<script>
    function calculateTotal() {
        var pricePerTicket = <?php echo $showtime['price']; ?>;
        var numTickets = document.getElementById('ticketSelect').value;
        var totalPrice = pricePerTicket * numTickets;

        document.getElementById('totalPrice').textContent = totalPrice.toFixed(2);
    }

    function selectSeat(seat) {
        seat.classList.toggle('selected');
        updateSelectedSeats();
    }

    function updateSelectedSeats() {
        var selectedSeats = document.querySelectorAll('.seat.selected');
        var seats = [];
        selectedSeats.forEach(function(seat) {
            seats.push(seat.getAttribute('data-seat'));
        });
        document.getElementById('selectedSeats').value = seats.join(',');
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>
<footer style="background-color: #26355D;">
    <div class="container" style="background-color:#26355D; padding: 20px;">
        <div class="row" >
            <div class="col-md-3">
			</div>
			<div class="col-md-4">
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
    </div>
</footer>

</html>
