<?php include "views/header.php"; ?>
<nav>
  <div id="wrapper">
    <?php include "menu.php"; ?>
  </div><!-- /.navbar-collapse -->
</nav>
<div id="page-wrapper">
  <div class="row">
    <div class="col-lg-12">
      <h1>Pasien <small><?php include "../config/date-time.php";?></small></h1>
      <ol class="breadcrumb">
        <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"><i class="fa fa-check-square-o"></i> Poliklinik</li>
      </ol>  
      <?php include "../config/welcome.php"?>
    </div>
  </div><!-- /.row -->
  <!-- <div class="row">
    <div class="col-lg-4">
      <form method="post" action="" role="form">
        <div class="form-group input-group">
          <input type="text" class="form-control" name="id_catatan_medik" placeholder="No. Rekam Medik">
          <span class="input-group-btn">
            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Cari</button>
          </span>
        </div>
      </form>
    </div>
  </div> -->
  <div class="row">
    <div class="col-lg-12">
      <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped tablesorter">
          <thead>
            <tr>
              <th><center>#</center></th>
              <th><center>No.Reg</center></th>
              <th><center>Registrasi</center></th>
              <th><center>No.RM</center></th>
              <th><center>Nama Pasien</center></th>
              <th><center>TTL</center></th>
              <th><center>Unit</center></th>
              <th><center>Dokter</center></th>
              <th colspan='2'><center>Action</center></th>
            </tr>
          </thead>
          <tbody>
            <?php 
            $no = 1;
            $data = mysqli_query($koneksi,
              "SELECT *, mr_pasien.nama_pasien, mr_pasien.tempat, mr_pasien.tgl_lahir, mr_dokter.nama_dokter, mr_unit.nama_unit
              FROM mr_pendaftaran
              INNER JOIN mr_pasien
              ON mr_pendaftaran.id_catatan_medik=mr_pasien.id_catatan_medik
              INNER JOIN mr_dokter
              ON mr_pendaftaran.id_dokter=mr_dokter.id_dokter
              INNER JOIN mr_unit
              ON mr_dokter.id_unit=mr_unit.id_unit
              WHERE mr_pendaftaran.selesai='0'
              ORDER BY mr_pendaftaran.id_mr_pendaftaran ASC;");
            while($d = mysqli_fetch_array($data)){
              $tanggal    = $d['tanggal'];
              $tgl_lahir  = $d['tgl_lahir'];
              ?>
              <tr>
                <td><center><?php echo $no++; ?></center></td>
                <td><center><?php echo $d['id_mr_pendaftaran']; ?></center></td>
                <td><center><?php echo date('d-m-Y', strtotime($tanggal)).' ('.$d['jam'].')'; ?></center></td>
                <td><center><?php echo $d['id_catatan_medik']; ?></center></td>
                <td><center><?php echo $d['nama_pasien']; ?></center></td>
                <td><center><?php echo $d['tempat'].', '.date('d F Y', strtotime($tgl_lahir)); ?></center></td>
                <td><center><?php echo $d['nama_unit']; ?></center></td>
                <td><center><?php echo $d['nama_dokter']; ?></center></td>
                <td>
                  <div align="center">
                    <a href="laborat-tambah-form.php?id=<?php echo $d['id_mr_pendaftaran']; ?>"
                      <button type="button" class="btn btn-success"><i class='fa fa-sign-in'></i></button></a>
                    </div>
                  </td>
                  </tr><?php } ?>
                </tbody>
              </table>
            </div><!-- col-lg-12 -->
          </div>
        </div>
        <?php
        if(isset($_POST['tambahsubmit'])){
          $id_catatan_medik = $_POST['id_catatan_medik'];
          $id_dokter        = $_POST['id_dokter'];
          $selesai          = '0';

          $simpan=mysqli_query($koneksi,"INSERT INTO mr_pendaftaran (id_mr_pendaftaran, id_catatan_medik, id_dokter, tanggal, jam, selesai)VALUES('','$id_catatan_medik','$id_dokter','$tanggalsekarang','$jamsekarang','$selesai')");
          if($simpan){
            echo '<script>
            setTimeout(function() {
              swal({
                title: "Sukses",
                text: "Mendaftarkan Pasien",
                type: "success"
                }, function() {
                  window.location = "pendaftaran.php";
                  });
                  }, 10);
                  </script>';
                }else{
                  echo '<script>
                  setTimeout(function() {
                    swal({
                      title: "Upss..",
                      text: "Coba Sekali Lagi",
                      type: "error"
                      }, function() {
                        window.location = "pendaftaran.php";
                        });
                        }, 10);
                        </script>';
                      }
                    }
                    ?>
                  </div><!-- /#page-wrapper -->
                  <?php include "views/footer.php"; ?>