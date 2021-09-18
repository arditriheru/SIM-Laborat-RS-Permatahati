<?php include "views/header.php"; ?>
<nav>
  <div id="wrapper">
    <?php include "menu.php"; $id_lab_trn = $_GET['id']; ?>
  </div><!-- /.navbar-collapse -->
</nav>
<div id="page-wrapper">
  <div class="row">
    <div class="col-lg-12">
      <h1>Detail <small>Pemeriksaan</small></h1>
      <ol class="breadcrumb">
        <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"><i class="fa fa-check-square-o"></i> Detail</li>
      </ol>  
      <?php include "../config/welcome.php"?>
    </div>
  </div><!-- /.row -->
  <div class="row">
    <div class="col-lg-6">
      <form method="post" action="form-hasil-lab.php" role="form">
        <div class="form-group">
          <input class="form-control" type="hidden" name="id_lab_trn" value="<?php echo $id_lab_trn?>">
        </div>
        <button type="submit" class="btn btn-primary"><i class='fa fa-print'></i> Print</button>
      </form>
    </div>
    <div align="right" class="col-lg-6">
      <a href="laborat-hapus.php?id=<?php echo $id_lab_trn; ?>"
        onclick="javascript: return confirm('Anda yakin hapus?')">
        <button type="button" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>
      </a>
    </div><br><br><br>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <?php
      include '../config/connect.php';
      $data = mysqli_query($koneksi,
        "SELECT *, mr_pasien.id_catatan_medik, mr_pasien.nama_pasien, mr_dokter.nama_dokter, mr_unit.nama_unit, lab_trn.pemeriksaan
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
        $lahir    = new DateTime($d['tgl_lahir']);
        $today    = new DateTime();
        $umur     = $today->diff($lahir);
        $dp       = explode(',', $d['pemeriksaan']);
        $peme     = $d['pemeriksaan'];
        ?>
        <table class="table table-bordered">
          <tbody>
            <tr>
              <div align="right">
                <img class="img-responsive" src="../images/imagesbarcode/<?php echo $d['id_catatan_medik']; ?>.png" width="15%" alt="imagesbarcode">
              </div>
            </tr>
            <tr>
              <td><b>No.RM</b></td>
              <td><?php echo $d['id_catatan_medik']; ?></td>
              <td><b>No.Register</b></td>
              <td colspan="2"><?php echo $id_lab_trn; ?></td>
            </tr>
            <tr>
              <td><b>Nama Pasien</b></td>
              <td><?php echo $d['nama_pasien']; ?></td>
              <td><b>Tanggal / Jam</b></td>
              <td colspan="2"><?php echo $d['tanggal'].' / '.$d['jam']; ?></td>
            </tr>
            <tr>
              <td><b>Petugas</b></td>
              <td><?php echo $nama_login; ?></td>
              <td><b>Dokter</b></td>
              <td colspan="2"><?php echo $d['nama_dokter']; ?></td>
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
            $data = mysqli_query($koneksi,
              "SELECT lab_tarif.nama, lab_tarif.nilai_normal, lab_tarif.satuan, lab_trn_hasil.hasil_uji, lab_sampel.nama_sampel
              FROM lab_tarif
              INNER JOIN lab_trn_hasil
              ON lab_tarif.id_lab_tarif = lab_trn_hasil.id_lab_tarif
              INNER JOIN lab_sampel
              ON lab_tarif.id_lab_sampel = lab_sampel.id_lab_sampel
              WHERE lab_trn_hasil.id_lab_trn='$id_lab_trn'
              AND lab_tarif.id_lab_tarif IN($peme);");
            while($d = mysqli_fetch_array($data)){
              echo "<tr>".
              "<td align='center'>".$d['nama']."</td>".
              "<td align='center'>".$d['hasil_uji']."</td>".
              "<td align='center'>".$d['nilai_normal']."</td>".
              "<td align='center'>".$d['satuan']."</td>".
              "<td align='center'>".$d['nama_sampel']."</td>".
              "</tr>";
            }
            ?>
          </tbody>
          </table><?php } ?>
        </div>
        <div class="col-lg-6">
          <?php
          if(isset($_POST['hasilsubmit'])){
            $id_lab_tarif = $_POST['id_lab_tarif'];
            $hasil_uji    = $_POST['hasil_uji'];

            $simpan=mysqli_query($koneksi,"INSERT INTO lab_trn_hasil (id_lab_trn_hasil, id_lab_tarif, id_lab_trn, id_petugas, hasil_uji, tanggal, jam)VALUES('','$id_lab_tarif','$id_lab_trn','$id_petugas','$hasil_uji','$tanggalsekarang','$jamsekarang')");
            if($simpan){
             echo "<script>
             setTimeout(function() {
              swal({
                title: 'Sukses',
                text: 'Menambahkan Hasil Pemeriksaan',
                type: 'success'
                }, function() {
                  window.location = 'trn-detail.php?id=$id_lab_trn';
                  });
                  }, 10);
                  </script>";
                }else{
                 echo "<script>
                 setTimeout(function() {
                  swal({
                    title: 'Upsss',
                    text: 'Masukkan Pemeriksaan',
                    type: 'error'
                    }, function() {
                      window.location = 'trn-detail.php?id=$id_lab_trn';
                      });
                      }, 10);
                      </script>";
                    }
                  }
                  ?>
                  <form method="post" action="" role="form">
                   <div class="form-group">
                    <label>Pemeriksaan</label>
                    <select class="form-control" type="text" name="id_lab_tarif" required="">
                      <option value="">Pilih</option>
                      <?php 
                      $data = mysqli_query($koneksi,
                        "SELECT id_lab_tarif, nama FROM lab_tarif WHERE id_lab_tarif IN($peme);");
                      while($d = mysqli_fetch_array($data)){
                        echo "<option value='".$d['id_lab_tarif']."'>".$d['nama']."</option>";
                      }
                      ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Hasil</label>
                    <input class="form-control" type="text" name="hasil_uji" placeholder="Masukkan Hasil.." required="">
                  </div>
                  <button type="submit" name="hasilsubmit" class="btn btn-success">Submit</button>
                </form>
              </div>
            </div>
          </div><!-- /#page-wrapper -->
          <?php include "views/footer.php"; ?>