<!DOCTYPE html>
<html lang="en">
    <?php include "include/head.php";?>
    <body class="sb-nav-fixed">
        <?php include "include/menunav.php";?>
        <div id="layoutSidenav">
            <?php include "include/menu.php";?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Hotel</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                        <?php
							include 'include/config.php';
							if(isset($_POST['Simpan']))
							{
								$movie_id = $_POST['movie_id'];
								$judul = $_POST['judul'];
								$genre = $_POST['genre'];
								$usia = $_POST['usia'];
								$movie_img = $_POST['movie_img'];
								$jenis_bioskop = $_POST['jenis_bioskop'];
								$durasi = $_POST['durasi'];
								$sinopsis = $_POST['sinopsis'];
								$producer = $_POST['producer`'];
								$writer = $_POST['writer`'];
								$cast = $_POST['cast'];
								$distributor = $_POST['distributor`'];

						 

								mysqli_query($connection, "insert into movie values ('$movie_id', '$judul', '$genre', '$usia', '$movie_img', '$jenis_bioskop', '$durasi', '$sinopsis', '$producer', '$writer', '$cast', '$distributor')");
								header("location:hotel.php");

						 

							}

						?>

						<head>
							<title>movie</title>
							<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
							<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
							<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css" integrity="sha384-b6lVK+yci+bfDmaY1u0zE8YYJt0TZxLEAFyYSLHId4xoVvsrQu3INevFKo+Xir8e" crossorigin="anonymous">
						 

						</head>
						<body>

						 

						<div class="row">
						<div class="col-sm-1"></div>
						<div class="col-sm-10">

						 

						<form method="POST">

						  <div class="mb-3 row">
							<label for="movie_id" class="col-sm-2 col-form-label">Kode movie</label>
							<div class="col-sm-10">
							  <input type="text" class="form-control" name="movie_id" id="movie_id">
							</div>
						  </div>

						  <div class="mb-3 row">
							<label for="judul" class="col-sm-2 col-form-label">Nama movie</label>
							<div class="col-sm-10">
							  <input type="text" class="form-control" name="judul" id="judul">
							</div>
						  </div>  

						  <div class="mb-3 row">
							<label for="genre" class="col-sm-2 col-form-label">Alamat movie</label>
							<div class="col-sm-10">
							  <input type="text" class="form-control" name="genre" id="genre">
							</div>
						  </div>  

						  <div class="form-group row">
						  <div class="mb-3 row">
						  <div class="col-sm-2">
						  </div>
						  <div class="col-sm-10">
							  <input type="submit" name="Simpan" value="Simpan" class="btn btn-info">
							  <input type="reset" class="btn btn-warning" value="Batal" name="Batal">
						  </div>
						  </div>

						</form>

						<form method="POST">
							<div class="form-group row mb-2">
								<label for="search1"class="col-sm-2">Nama movie</label>
								
								<!--untuk panjang box isi nya-->
								<div class="col-sm-6">
									<input type="text" name="search1" class="form-control" id="search1" 
									value="<?php if(isset($_POST["search1"]))
									{echo $_POST["search1"];}?>"placeholder="Cari nama movie">
								</div>
								 <input type="submit" name="kirim1" value="Cari" class="col-sm-1 btn btn-primary">
							</div>
						</form>

						<form method="POST">
							<div class="form-group row mb-2">
								<label for="search2"class="col-sm-2">Alamat movie</label>
								
								<!--untuk panjang box isi nya-->
								<div class="col-sm-6">
									<input type="text" name="search2" class="form-control" id="search2" 
									value="<?php if(isset($_POST["search2"]))
									{echo $_POST["search2"];}?>"placeholder="Cari alamat movie">
								</div>
								 <input type="submit" name="kirim2" value="Cari" class="col-sm-1 btn btn-primary">
							</div>
						</form>

						 

						<table class="table table-hover table-primary">
						  <thead>
							<tr>
							  <th scope="col">No</th>
							  <th scope="col">Kode movie</th>
							  <th scope="col">Nama movie</th>
							  <th scope="col">Alamat movie</th>
							  <th colspan="2" style="text-align: center">Aksi</th>
							</tr>
						  </thead>
						  <tbody>
							<?php

							if(isset($_POST["kirim1"]))
							{
								$search1 = $_POST["search1"];
								$query = mysqli_query($connection, "select movie.* 
									from movie
									where judul like '%".$search1."%'");
							}elseif(isset($_POST["kirim2"]))
							{
								$search2 = $_POST["search2"];
								$query = mysqli_query($connection, "select movie.* 
									from movie
									where genre like '%".$search2."%'");
							}
						else
							{
								$query = mysqli_query($connection, "select movie.* from movie");
							}
											
										 
								$nomor = 1;
								while($row = mysqli_fetch_array($query)) { //mengambil satu per satu record dari query
							?>

									<tr>
										<td> <?php echo $nomor; ?> </td>
										<td> <?php echo $row['movie_id']; ?> </td>
										<td> <?php echo $row['judul']; ?> </td>
										<td> <?php echo $row['genre']; ?> </td>
														
										<td width="5px">

										</td>
										<td width="5px">
										<a href="movieHAPUS.php?hapus=<?php echo $row["movie_id"]?>" 
										 class="btn btn-danger btn-sm" title="HAPUS">
											<i class="bi bi-trash"></i>
										</td>
									</tr>
											
							<?php $nomor = $nomor + 1; ?>

							<?php    
								}
							?>
							</tbody>
						</table>

 

</div> <!-- penutup clas=col-sm-10 -->
<div class="col-sm-1"></div>
</div> <!-- penutup clas=row -->


</body>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

                        
                    </div>
                </main>
                <?php include "include/footer.php";?>
            </div>
        </div>
        <?php include "include/jsscript.php";?>
    </body>
</html>
