<!doctype html>

<?php

include "include/config.php";
if (isset($_POST["Simpan"]))
{

    //isset -> digunakan untuk memeriksa ada kah yang dikirim ke variabel di yang diatas
    //function untuk menerima yaitu $_POST
    //method harus sama dengan belakang $_

        $kategoriberitaKODE = $_POST['inputkode'];
        $kategoriberitaNAMA = $_POST['inputnama'];
        $kategoriberitaKET = $_POST['inputket'];

        //digunakan untuk memasukkan data yang akan tersimpan di variabel ini
        //variabel nya harus sama yang ada di file config.php
        mysqli_query($connection,  "insert into kategortiberita values ('$kategoriberitaKODE', '$kategoriberitaNAMA', '$kategoriberitaKET')");
       
        //setiap disimpan balik ke file ini
        header("location:kategortiberita.php");

}


?>

<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>

 <!--mulai saya kerja -->

 <!--menyediakan satu kolom di sebelah kiri form-->



<div class="row">

<div class="col-sm-1">
</div>

<div class="col-sm-10">

<div class="alert alert-dark text-white" role="alert">
  <h4 class="alert-heading">ENTRY DATA KATEGORI BERITA</h4>
</div>

<form method="POST">

<!-- for harus sama dengan id -->
<!-- fungsi dua duanya sama biar pas ke label bisa langsung isi kotak-->
<!-- "col-sm-2" -> untuk membagi bagi kolom di layar kita (setiap div dilayar kita total 12 kolom)-->

    <div class="form-group row">
          <label for="inputkode" class="col-sm-3 text-right col-form-label">Kode Kategori Berita</label>
         <div class="col-sm-7">
           <input type="text" class="form-control" id="inputkode" name="inputkode" placeholder="Kode Kategori Berita">   <!-- name digunakan untuk menyambungkan dengan bagian if -->
        </div>
    </div>

    <div class="form-group row">
          <label for="inputnama" class="col-sm-3 text-right col-form-label">Nama Kategori Berita</label>
         <div class="col-sm-7">
           <input type="text" class="form-control" id="inputnama" name="inputnama" placeholder="Nama Kategori Berita">
        </div>
    </div>

    <div class="form-group row">
          <label for="inputket" class="col-sm-3 text-right col-form-label">Keterangan Kategori Berita</label>
         <div class="col-sm-7">
           <input type="text" class="form-control" id="inputket" name="inputket" placeholder="Keterangan Kategori Berita">
        </div>
    </div>
	<div class="form-group row">
    <div class="col-sm-10 offset-sm-3">
        <input type="submit" name="Simpan" value="Simpan" class="btn btn-primary">
        <button type="reset" class="btn btn-info">Batal</button>
    </div>
</div>


</form>
</div>
</div>


 <!--akhir saya kerja -->

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>
