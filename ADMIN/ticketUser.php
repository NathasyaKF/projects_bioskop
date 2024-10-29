<?php
include "include/config.php";

// Ambil showtime_id dan username dari URL
$showtime_id = isset($_GET['showtime_id']) ? $_GET['showtime_id'] : '';
$username = isset($_GET['username']) ? $_GET['username'] : '';

// Query untuk mengambil data showtime berdasarkan showtime_id
$query = mysqli_query($connection, "
    SELECT s.showtime_id, s.theater, s.show_time, s.price, s.show_date, c.name as cinema_name, c.address, c.kode_kota, m.judul, m.durasi, m.jenis_bioskop, m.usia, m.movie_img
    FROM showtimes s 
    JOIN cinema c ON s.cinema_id = c.cinema_id 
    JOIN movie m ON s.movie_id = m.movie_id
    WHERE s.showtime_id = '$showtime_id'
");

$showLihatTicketButton = isset($_POST['submit']); // Show button after form submission


// Mengambil data showtime
$showtime = mysqli_fetch_assoc($query);

// Query untuk mengambil data kursi yang sudah terpilih
$seats_query = mysqli_query($connection, "
    SELECT seats 
    FROM ticket 
    WHERE showtime_id = '$showtime_id'
");

$booked_seats = [];
while ($row = mysqli_fetch_assoc($seats_query)) {
    $booked_seats = array_merge($booked_seats, explode(',', $row['seats']));
}

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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Showtime Info</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
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
		.btn-primary {
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
                                <div class="row">
                                    <?php for ($i = 1; $i <= 30; $i++): ?>
                                        <?php
                                            $seatNumber = str_pad($i, 2, '0', STR_PAD_LEFT); // Format seat number as 01, 02, etc.
                                            $seatClass = in_array($seatNumber, $booked_seats) ? 'seat booked' : 'seat';
                                        ?>
                                        <div class="<?php echo $seatClass; ?>" data-seat="<?php echo $seatNumber; ?>">
                                            <?php echo $seatNumber; ?>
                                        </div>
                                    <?php endfor; ?>
                                </div>
                            </div>
                            <input type="hidden" name="selected_seats" id="selectedSeats">
                            <input type="hidden" name="total_price" id="totalPriceInput">
                            <button type="submit" class="btn-custom" name="submit">Beli Tiket</button>
						<button type="button" class="btn btn-primary <?php echo $showLihatTicketButton ? '' : 'd-none'; ?>" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
							Lihat Ticket
						</button>

						<!-- Modal -->
						<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
							<div class="modal-dialog modal-dialog-centered">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="staticBackdropLabel">Detail Tiket</h5>
										<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
									</div>
									<div class="modal-body">
										<?php
										// PHP logic to display ticket details
										if (isset($_POST['submit'])) {
											// Assuming after successful form submission ($_POST['submit'])
											$ticket_id = generateTicketID($connection); // Generate or retrieve ticket ID
											$judul = $showtime['judul'];
											$cinema_name = $showtime['cinema_name'];
											$show_time = $showtime['show_time'];
											$show_date = $showtime['show_date'];
											$selected_seats = $_POST['selected_seats'];
											$total_price = $_POST['total_price'];

											// Display ticket details in the modal body
											?>
											<div class="ticket-details">
												<p><strong>Ticket ID:</strong> <?php echo htmlspecialchars($ticket_id); ?></p>
												<p><strong>Judul Film:</strong> <?php echo htmlspecialchars($judul); ?></p>
												<p><strong>Nama Bioskop:</strong> <?php echo htmlspecialchars($cinema_name); ?></p>
												<p><strong>Tanggal Tayang:</strong> <?php echo htmlspecialchars($show_date); ?></p>
												<p><strong>Waktu Tayang:</strong> <?php echo htmlspecialchars($show_time); ?></p>
												<p><strong>Kursi:</strong> <?php echo htmlspecialchars($selected_seats); ?></p>
												<p><strong>Total Harga:</strong> <?php echo htmlspecialchars($total_price); ?></p>
											</div>
										<?php
										}
										?>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
										<!-- Additional buttons if needed -->
									</div>
								</div>
							</div>
						</div>
						
						<style>
							.modal-body {
								font-family: Arial, sans-serif;
								padding: 20px; 
							}
							.modal-header {
								background-color: #26355D;
							}
							.modal-title {
								color: white;
							}
							.ticket-details p {
								margin-bottom: 10px;
							}

							.ticket-details strong {
								font-weight: bold; 
							}
						</style>

						
                        </form>

                        <script>
                            const seats = document.querySelectorAll('.seat');
                            const selectedSeatsInput = document.getElementById('selectedSeats');
                            const totalPriceElement = document.getElementById('totalPrice');
                            const totalPriceInput = document.getElementById('totalPriceInput');
                            let selectedSeats = [];

                            seats.forEach(seat => {
                                seat.addEventListener('click', () => {
                                    if (!seat.classList.contains('booked')) {
                                        seat.classList.toggle('selected');
                                        const seatNumber = seat.getAttribute('data-seat');

                                        if (seat.classList.contains('selected')) {
                                            selectedSeats.push(seatNumber);
                                        } else {
                                            const index = selectedSeats.indexOf(seatNumber);
                                            if (index > -1) {
                                                selectedSeats.splice(index, 1);
                                            }
                                        }

                                        selectedSeatsInput.value = selectedSeats.join(',');
                                        calculateTotal();
                                    }
                                });
                            });

                            function calculateTotal() {
                                const ticketCount = parseInt(document.getElementById('ticketSelect').value);
                                const pricePerTicket = <?php echo $showtime['price']; ?>;
                                const totalPrice = ticketCount * pricePerTicket;
                                totalPriceElement.innerText = totalPrice;
                                totalPriceInput.value = totalPrice;
                            }
                        </script>

                        <?php
                        // Proses submit form
                        if (isset($_POST['submit'])) {
                            $num_tickets = $_POST['num_tickets'];
                            $payment_method = $_POST['payment_method'];
                            $selected_seats = $_POST['selected_seats'];
                            $total_price = $_POST['total_price']; // Ambil nilai total_price dari input tersembunyi

                            // Validasi jumlah kursi yang dipilih
                            $selected_seats_array = explode(',', $selected_seats);
                            if (count($selected_seats_array) != $num_tickets) {
                                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                          Error: Number of selected seats does not match number of tickets.
                                          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                      </div>';
                            } else {
                                // Generate unique ticket_id
                                $ticket_id = generateTicketID($connection);

                                // Query untuk menyimpan data tiket ke dalam database
                                $insert_query = "INSERT INTO ticket (ticket_id, username, showtime_id, payment, seats, total_price) 
                                                VALUES ('$ticket_id', '$username', '$showtime_id', '$payment_method', '$selected_seats', '$total_price')";

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
                        }
                        ?>

                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>
</body>
</html>
