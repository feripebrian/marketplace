<?php

$hostname = "localhost";
$username = "root";
$password = "";
$dbname   = "jak_kemenagselatan";

$conn = mysqli_connect($hostname, $username, $password, $dbname);

// cek koneksi
if (mysqli_connect_errno()) {
	printf("Koneksi Gagal: %s\n", mysqli_connect_error());
	exit();
}
