<?php error_reporting(0); ?>
<?php include "views/header.php"; ?>
<body>
	<script>
		window.print();
	</script>
	<?php
	$id_lab_trn = $_POST['id_lab_trn'];
	mysqli_query($koneksi,"UPDATE lab_trn SET selesai='1' WHERE id_lab_trn='$id_lab_trn'");
	$data = mysqli_query($koneksi,
		"SELECT *, mr_pasien.id_catatan_medik, mr_pasien.nama_pasien, mr_dokter.nama_dokter, mr_unit.nama_unit,
		IF (mr_pasien.sex='1', 'Laki-laki', 'Perempuan') AS jekel
		FROM lab_trn
		INNER JOIN mr_pendaftaran
		ON lab_trn.id_mr_pendaftaran = mr_pendaftaran.id_mr_pendaftaran
		INNER JOIN mr_pasien
		ON mr_pendaftaran.id_catatan_medik = mr_pasien.id_catatan_medik
		INNER JOIN mr_dokter
		ON mr_pendaftaran.id_dokter = mr_dokter.id_dokter
		INNER JOIN mr_unit
		ON mr_dokter.id_unit = mr_unit.id_unit
		WHERE lab_trn.id_lab_trn='$id_lab_trn';");
	while($d = mysqli_fetch_array($data)){
		$lahir 		= new DateTime($d['tgl_lahir']);
		$today 		= new DateTime();
		$umur  		= $today->diff($lahir);
		$dp 	 	= explode(',', $d['pemeriksaan']);
		$peme     = $d['pemeriksaan'];
		?>
		<div id="page-wrapper">
			<div class="row">
				<div class="col-lg-12">
					<div class="container">
						<div class="container">
							<div class="noprint">
								<a href="dashboard.php"><button type="button" class="btn btn-success">Dashboard</button></a>
							</div>
							<br><br><br>
							<center>
								<div class="row">
									<img class="img-responsive" src="../images/Kop Surat.jpg" width="100%" alt="Kop Surat Laboratorium">
								</div>
							</center><br>
							<div align="center">
								<h4><strong>HASIL PEMERIKSAAN LABORATORIUM</strong></h4><br>
							</div>
							<table class="table table-bordered">
								<tbody>
									<tr>
										<td><b>No.RM</b></td>
										<td><?php echo $d['id_catatan_medik']; ?></td>
										<td><b>Dokter</b></td>
										<td colspan="2"><?php echo $d['nama_dokter']; ?></td>
									</td>
								</tr>
								<tr>
									<td><b>Nama Pasien</b></td>
									<td><?php echo $d['nama_pasien']; ?></td>
									<td><b>Unit</b></td>
									<td colspan="2"><?php echo $d['nama_unit']; ?></td>
								</tr>
								<tr>
									<td><b>Umur</b></td>
									<td><?php echo $umur->y; echo " Tahun, "; echo $umur->m; echo " Bulan, dan "; echo $umur->d; echo " Hari"; ?></td>
									<td><b>Tanggal / Jam</b></td>
									<td colspan="2"><?php echo $d['tanggal'].' / '.$d['jam']; ?>
								</tr>
								<tr>
									<td><b>Jenis Kelamin</b></td>
									<td><?php echo $d['jekel']; ?></td>
									<td><b>Alamat</b></td>
									<td colspan="2"><?php echo $d['alamat']; ?></td>
								</tr>
								<tr>
									<td align="center" colspan="5"><b>HASIL PENGUJIAN</b></td>
								</tr>
								<tr>
									<td align="center"><b>Nama Tes</b></td>
									<td align="center"><b>Hasil</b></td>
									<td align="center"><b>Nilai Normal</b></td>
									<td align="center"><b>Satuan</b></td>
									<td align="center"><b>Sampel</b></td>
								</tr>
								<?php 
								$a = mysqli_query($koneksi,
									"SELECT lab_tarif.nama, lab_tarif.nilai_normal, lab_tarif.satuan, lab_trn_hasil.hasil_uji, lab_sampel.nama_sampel
									FROM lab_tarif
									INNER JOIN lab_trn_hasil
									ON lab_tarif.id_lab_tarif = lab_trn_hasil.id_lab_tarif
									INNER JOIN lab_sampel
									ON lab_tarif.id_lab_sampel = lab_sampel.id_lab_sampel
									WHERE lab_trn_hasil.id_lab_trn='$id_lab_trn'
									AND lab_tarif.id_lab_tarif IN($peme);");
								while($b = mysqli_fetch_array($a)){
									echo "<tr>".
									"<td align='center'>".$b['nama']."</td>".
									"<td align='center'>".$b['hasil_uji']."</td>".
									"<td align='center'>".$b['nilai_normal']."</td>".
									"<td align='center'>".$b['satuan']."</td>".
									"<td align='center'>".$b['nama_sampel']."</td>".
									"</tr>";
								}
								?>
							</tbody>
						</table>
						<div align="right">
							<small>
								Printed : <?php include "../config/date-time.php";?> / <?php echo $jamsekarang;?>
							</small>
						</div><br>
						<div align="right">
							<table>
								<tbody>
									<tr>
										<td>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</td>
										<td><center><strong>Yogyakarta,<br>Petugas,</strong><br><br><br><br><br><br>
											<?php echo $nama_login; ?></center></td>
											<td>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</td>
										</tr>
									</tbody>
									</table><?php } ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
	</html>


