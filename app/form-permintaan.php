<?php error_reporting(0); ?>
<?php include "views/header.php"; ?>
<body>
	<script>
		window.print();
	</script>
	<?php
	$id_lab_trn = $_GET['id'];
	include '../config/connect.php';
	$data = mysqli_query($koneksi,
		"SELECT *, mr_pasien.id_catatan_medik, mr_pasien.nama_pasien, mr_dokter.nama_dokter, mr_unit.nama_unit
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
								<h4><strong>FORM PERMINTAAN PEMERIKSAAN LABORATORIUM</strong></h4><br>
							</div>
							<table class="table table-bordered">
								<tbody>
									<tr>
										<td><b>No.RM</b></td>
										<td><?php echo $d['id_catatan_medik']; ?></td>
										<td><b>Tanggal / Jam</b></td>
										<td><?php echo $d['tanggal'].' / '.$d['jam']; ?></td>
									</tr>
									<tr>
										<td><b>Nama Pasien</b></td>
										<td><?php echo $d['nama_pasien']; ?></td>
										<td><b>Dokter</b></td>
										<td><?php echo $d['nama_dokter']; ?></td>
									</tr>
									<tr>
										<td><b>Umur</b></td>
										<td><?php echo $umur->y; echo " Tahun, "; echo $umur->m; echo " Bulan, dan "; echo $umur->d; echo " Hari"; ?></td>
										<td><b>Unit</b></td>
										<td><?php echo $d['nama_unit']; ?></td>
									</tr>
									<tr>
										<td><b>Alamat</b></td>
										<td><?php echo $d['alamat']; ?></td>
										<td><b>Diagnosa</b></td>
										<td><?php echo $d['dx']; ?></td>
									</tr>
								</tbody>
							</table><br>
							<table class="table table-bordered">
								<tbody>
									<tr>
										<td align="center"><b>HEMATOLOGI</b></td>
										<td align="center"><b>KIMIA DARAH</b></td>
										<td align="center"><b>URINE</b></td>
										<td align="center"><b>SEROLOGI</b></td>
										<td align="center"><b>LAIN-LAIN</b></td>
									</tr>
									<tr>
										<td>
											<div class="checkbox">
												<?php 
												$data = mysqli_query($koneksi,
													"SELECT id_lab_tarif, nama FROM lab_tarif WHERE kel='1'GROUP BY id_lab_tarif;");
												while($d = mysqli_fetch_array($data)){
													$ilt = $d['id_lab_tarif']; ?>
													<label>
														<input type="checkbox" name="tarif[]" value="<?= $d['id_lab_tarif']?>" <?php if (in_array("$ilt", $dp)) echo "checked";?> ><?= $d['nama']?>
													</label><br>
												<?php } ?>
											</div>
										</td>
										<td>
											<div class="checkbox">
												<?php 
												$data = mysqli_query($koneksi,
													"SELECT id_lab_tarif, nama FROM lab_tarif WHERE kel='2'GROUP BY id_lab_tarif;");
												while($d = mysqli_fetch_array($data)){
													$ilt = $d['id_lab_tarif']; ?>
													<label>
														<input type="checkbox" name="tarif[]" value="<?= $d['id_lab_tarif']?>" <?php if (in_array("$ilt", $dp)) echo "checked";?> ><?= $d['nama']?>
													</label><br>
												<?php } ?>
											</div>
										</td>
										<td>
											<div class="checkbox">
												<?php 
												$data = mysqli_query($koneksi,
													"SELECT id_lab_tarif, nama FROM lab_tarif WHERE kel='3'GROUP BY id_lab_tarif;");
												while($d = mysqli_fetch_array($data)){
													$ilt = $d['id_lab_tarif']; ?>
													<label>
														<input type="checkbox" name="tarif[]" value="<?= $d['id_lab_tarif']?>" <?php if (in_array("$ilt", $dp)) echo "checked";?> ><?= $d['nama']?>
													</label><br>
												<?php } ?>
											</div>
										</td>
										<td>
											<div class="checkbox">
												<?php 
												$data = mysqli_query($koneksi,
													"SELECT id_lab_tarif, nama FROM lab_tarif WHERE kel='4'GROUP BY id_lab_tarif;");
												while($d = mysqli_fetch_array($data)){
													$ilt = $d['id_lab_tarif']; ?>
													<label>
														<input type="checkbox" name="tarif[]" value="<?= $d['id_lab_tarif']?>" <?php if (in_array("$ilt", $dp)) echo "checked";?> ><?= $d['nama']?>
													</label><br>
												<?php } ?>
											</div>
										</td>
										<td>
											<div class="checkbox">
												<?php 
												$data = mysqli_query($koneksi,
													"SELECT id_lab_tarif, nama FROM lab_tarif WHERE kel='5'GROUP BY id_lab_tarif;");
												while($d = mysqli_fetch_array($data)){
													$ilt = $d['id_lab_tarif']; ?>
													<label>
														<input type="checkbox" name="tarif[]" value="<?= $d['id_lab_tarif']?>" <?php if (in_array("$ilt", $dp)) echo "checked";?> ><?= $d['nama']?>
													</label><br>
												<?php } ?>
											</div>
										</td>
									</tr>
								</tbody>
							</table>
							<div align="right">
								<small>
									Printed : <?php include "../config/date-time.php";?> / <?php echo $jamsekarang;?>
								</small>
							</div><br>
							<table class="table table-bordered">
								<tbody>
									<tr>
										<td colspan="2" align="center"><br>
											<b>Bersedia diambil sampel</b>
										</td>
										<td colspan="2" align="left">
											<p>Jam diterima :</p>
											<p>Jam diserahkan :</p>
										</td>
									</tr>
									<tr>
										<td align="center">
											Yang Menyerahkan
											<br><br><br><br><br><br>
											(...............................)
										</td>
										<td align="center">
											Yang Menerima
											<br><br><br><br><br><br>
											(...............................)
										</td>
										<td align="center">
											Yang Menerima
											<br><br><br><br><br><br>
											(...............................)
										</td>
										<td align="center">
											Yang Menyerahkan
											<br><br><br><br><br><br>
											(...............................)
										</td>
									</tr>
								</tbody>
							</table>
						<?php } ?>
					</div>

				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>


