<?php
include '../config/connect.php';
$id_catatan_medik = $_GET['id_catatan_medik'];
$query = mysqli_query($koneksi, "SELECT nama_pasien FROM mr_pasien WHERE id_catatan_medik='$id_catatan_medik'");
$pasien = mysqli_fetch_array($query);
$data = array(
	'nama_pasien' 	=>  $pasien['nama_pasien']);
echo json_encode($data);
?>