<?php 
include '../config/connect.php';
$id_lab_tarif = $_GET['id'];
$hapus=mysqli_query($koneksi,"DELETE FROM lab_tarif WHERE id_lab_tarif='$id_lab_tarif'");
if($hapus){
	echo "<script>alert('Berhasil Dihapus!!!');document.location='laborat-tarif.php'</script>";
}else{
	echo "<script>alert('Gagal Hapus!!!');document.location='laborat-tarif.php'</script>";
}
?>