<?php
session_start();
$_SESSION['useremail'];
unset($_SESSION['useremail']);

session_unset(); /*session_unset hanya menghapus sessi untuk penggunaan,
	dengan menggunakan session_unset, variabel masih ada */
session_destroy();
header("location:login.php")
?>