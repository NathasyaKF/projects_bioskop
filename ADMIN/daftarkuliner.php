<!DOCTYPE html>
<html lang="en">
    
    <!---BUAT MANGGIL HEAD.PHP-->
    <?php include "include/head.php";?>
    <body class="sb-nav-fixed">

        <?php include "include/menunav.php";?>

        <div id="layoutSidenav">

            <?php include "include/menu.php";?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Daftar Kuliner</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                        <?php
    include 'include/config.php'; //nyambungin data 

?>

<head>
    <title> DESTINASI 1 </title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <!-- stylesheet untuk memanggil file dengan tipe text/css -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
    
    <!--ini buat manggil svg nya-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css" integrity="sha384-b6lVK+yci+bfDmaY1u0zE8YYJt0TZxLEAFyYSLHId4xoVvsrQu3INevFKo+Xir8e" crossorigin="anonymous">
</head>

<body>
    <div class="row"> <!-- total kolom adalah 12 -->
    
        <div class="col-sm-10">

<div class="jumbotron mt-5">
    <h2 class="display-5">Hasil entri data kuliner</h2>
</div>

<form method="POST">
    <div class="form-group row mb-2">
        <label for="search1"class="col-sm-2">Nama kuliner</label>
        
        <!--untuk panjang box isi nya-->
        <div class="col-sm-6">
            <input type="text" name="search1" class="form-control" id="search1" 
            value="<?php if(isset($_POST["search1"]))
            {echo $_POST["search1"];}?>"placeholder="Cari nama kuliner">
        </div>
         <input type="submit" name="kirim1" value="Cari" class="col-sm-1 btn btn-primary">
    </div>
</form>

<form method="POST">
    <div class="form-group row mb-2">
        <label for="search2"class="col-sm-2">Alamat kuliner</label>
        
        <!--untuk panjang box isi nya-->
        <div class="col-sm-6">
            <input type="text" name="search2" class="form-control" id="search2" 
            value="<?php if(isset($_POST["search2"]))
            {echo $_POST["search2"];}?>"placeholder="Cari alamat kuliner">
        </div>
         <input type="submit" name="kirim2" value="Cari" class="col-sm-1 btn btn-primary">
    </div>
	
	
	
</form>
	
  <table class="table table-hover table-primary">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">Kode kuliner</th>
      <th scope="col">Nama kuliner</th>
      <th scope="col">Alamat kuliner</th>
	  <th scope="col">Gambar kuliner</th>
    </tr>
  </thead>
  <tbody>
    <?php

    if(isset($_POST["kirim1"]))
	{
		$search1 = $_POST["search1"];
		$query = mysqli_query($connection, "select kuliner.* 
            from kuliner
            where kulinerNAMA like '%".$search1."%'");
    }elseif(isset($_POST["kirim2"]))
	{
		$search2 = $_POST["search2"];
		$query = mysqli_query($connection, "select kuliner.* 
            from kuliner
            where kulinerALAMAT like '%".$search2."%'");
	}
else
    {
		$query = mysqli_query($connection, "select kuliner.* from kuliner");
    }
                    
                 
        $nomor = 1;
        while($row = mysqli_fetch_array($query)) { //mengambil satu per satu record dari query
    ?>

            <tr>
                <td> <?php echo $nomor; ?> </td>
                <td> <?php echo $row['kulinerKODE']; ?> </td>
                <td> <?php echo $row['kulinerNAMA']; ?> </td>
                <td> <?php echo $row['kulinerALAMAT']; ?> </td>
				<td>
					<?php if(is_file("images/".$row['kulinerFILE']))
					{ ?>
						<img src="images/<?php echo $row['kulinerFILE']?>" width="80">
					<?php } else
						echo "<img src='images/noimage.png' width='80'>"
					?>
				</td>
                                
                
            </tr>
                    
    <?php $nomor = $nomor + 1; ?>

    <?php    
        }
    ?>
    </tbody>
            </table>

        </div>
    </div>

    <script type="text/javascript" scr="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"> </script>

    <script>
        $(document).ready(function() {
            ('#kodekategori').select2( {
                closeOnSelect:true,
                allowClear:true,
                placeholder:'Pilih Kategori Wisata'
            } );
        } );
    </script>

</body>
                        

                    </div>
                </main>
                <?php include "include/footer.php";?>
            </div>
        </div>
        <?php include "include/jsscript.php";?>
    </body>
</html>