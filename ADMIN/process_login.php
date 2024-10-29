<?php
include "include/config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Lakukan validasi data di sini jika diperlukan

    // Query untuk memasukkan data pengguna ke dalam database
    $query = "INSERT INTO user (username, password) VALUES ('$username', '$password')";

    if (mysqli_query($connection, $query)) {
        echo "Data berhasil dimasukkan ke dalam database.";
        // Redirect atau tindakan lainnya setelah login berhasil
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($connection);
    }

    mysqli_close($connection);
}
?>
