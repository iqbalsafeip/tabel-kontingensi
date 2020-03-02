<?php
    $hostname = "localhost";
    $username = "root";
    $passowrd = "";
    $databasename = "aplikasi_tabel";

    #konekan ke database
    $koneksi = mysqli_connect($hostname, $username, $passowrd, $databasename);