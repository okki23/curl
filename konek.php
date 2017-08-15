<?php
$server = "185.101.35.39";
$user = "root";
$pass = "eNd2016:E|3m3nt";
$db = "rbtixcloud1";
// melakukan koneksi ke database
$connect = new mysqli($server,$user,$pass,$db);

// cek koneksi yang kita lakukan berhasil atau tidak
if ($connect->connect_error) {
   // jika terjadi error, matikan proses dengan die() atau exit();
   die('Maaf koneksi gagal: '. $connect->connect_error);
}
?>
