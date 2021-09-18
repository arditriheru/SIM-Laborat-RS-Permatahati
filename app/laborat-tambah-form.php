<?php include "views/header.php"; ?>
<nav>
  <div id="wrapper">
    <?php include "menu.php"; ?>
  </div><!-- /.navbar-collapse -->
</nav>
<div id="page-wrapper">
  <div class="row">
    <div class="col-lg-12">
      <h1>Form <small>Permintaan</small></h1>
      <ol class="breadcrumb">
        <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="laborat-tambah.php"><i class="fa fa-check-square-o"></i> Poliklinik</a></li>
        <li class="active"><i class="fa fa-check-square-o"></i> Pemeriksaan Laborat</li>
      </ol>  
      <?php include "../config/welcome.php"?>
    </div>
  </div><!-- /.row -->
  <div class="row">
    <div class="col-lg-12">
      <?php
      $id_mr_pendaftaran = $_GET['id']; 
      $a = mysqli_query($koneksi,
        "SELECT id_lab_trn
        FROM lab_trn
        WHERE id_mr_pendaftaran='$id_mr_pendaftaran';");
      while($b = mysqli_fetch_array($a)){
        $id_lab_trn = $b['id_lab_trn'];
      }
      if (isset($_POST['tambahsubmit'])) {
        $dx = $_POST['dx'];

        $data = implode(",", $_POST['tarif']);
        if(!$data){
         echo "<script>
         setTimeout(function() {
          swal({
            title: 'Upsss',
            text: 'Masukkan Pemeriksaan',
            type: 'error'
            }, function() {
              window.location = 'laborat-tambah-form.php?id=$id_mr_pendaftaran';
              });
              }, 10);
              </script>";
            }else{
              $simpan=mysqli_query($koneksi,"INSERT INTO lab_trn (id_lab_trn, id_mr_pendaftaran, pemeriksaan, dx, tanggal, jam, selesai)VALUES('','$id_mr_pendaftaran','".$data."','$dx','$tanggalsekarang','$jamsekarang','0')");

              mysqli_query($koneksi,"UPDATE mr_pendaftaran SET selesai='1' WHERE id_mr_pendaftaran='$id_mr_pendaftaran'");
              if($simpan){

                echo "<script>
                setTimeout(function() {
                  swal({
                    title: 'Sukses',
                    text: 'Membuat Form Permintaan',
                    type: 'success'
                    }, function() {
                      window.location = 'laborat-tambah-form.php?id=$id_mr_pendaftaran';
                      });
                      }, 10);
                      </script>";
                    }else{
                      echo '<script>
                      setTimeout(function() {
                        swal({
                          title: "Upss..",
                          text: "Coba Sekali Lagi",
                          type: "error"
                          }, function() {
                            window.location = "laborat-tambah.php";
                            });
                            }, 10);
                            </script>';
                          }
                        }
                      }

                      $a = mysqli_query($koneksi,
                       "SELECT mr_pendaftaran.id_catatan_medik, mr_pasien.nama_pasien, mr_dokter.nama_dokter
                       FROM mr_pendaftaran
                       INNER JOIN mr_pasien
                       ON mr_pendaftaran.id_catatan_medik = mr_pasien.id_catatan_medik
                       INNER JOIN mr_dokter
                       ON mr_pendaftaran.id_dokter = mr_dokter.id_dokter
                       WHERE mr_pendaftaran.id_mr_pendaftaran = '$id_mr_pendaftaran';");
                      while($b = mysqli_fetch_array($a)){
                       ?>
                       <form method="post" action="" role="form">
                        <div class="col-lg-4">
                          <div class="form-group">
                            <label>No. Rekam Medik</label>
                            <input class="form-control" type="text" name="id_catatan_medik" value="<?php echo $b['id_catatan_medik'];?>" readonly="">
                          </div>
                        </div>
                        <div class="col-lg-4">
                          <div class="form-group">
                            <label>Nama Pasien</label>
                            <input class="form-control" type="text" name="nama_pasien" value="<?php echo $b['nama_pasien'];?>" readonly="">
                          </div>
                        </div>
                        <div class="col-lg-4">
                          <div class="form-group">
                            <label>Nama Dokter</label>
                            <input class="form-control" type="hidden" name="id_dokter" value="<?php echo $b['id_dokter'];?>" readonly="">
                            <input class="form-control" type="text" name="nama_dokter" value="<?php echo $b['nama_dokter'];?>" readonly="">
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-lg-12">
                            <div class="col-lg-4">
                              <div class="form-group">
                                <label>Diagnosa Dokter</label>
                                <input class="form-control" type="text" name="dx" required="">
                              </div>
                            </div>
                          </div>
                        </div><br>
                        <div class="row">
                          <div class="col-lg-12">
                            <div class="col-lg-3">
                              <div class="form-group">
                                <label>HEMATOLOGI</label>
                                <div class="checkbox">
                                  <?php 
                                  $data = mysqli_query($koneksi,
                                    "SELECT * FROM lab_tarif WHERE kel='1';");
                                    while($d = mysqli_fetch_array($data)){ ?>
                                      <label>
                                        <input type="checkbox" name="tarif[]" value="<?=$d['id_lab_tarif']?>"><?=$d['nama']?>
                                      </label><br>
                                    <?php }
                                    ?>
                                  </div>
                                </div>
                              </div>
                              <div class="col-lg-3">
                                <div class="form-group">
                                  <label>KIMIA DARAH</label>
                                  <div class="checkbox">
                                    <?php 
                                    $data = mysqli_query($koneksi,
                                      "SELECT * FROM lab_tarif WHERE kel='2';");
                                      while($d = mysqli_fetch_array($data)){ ?>
                                        <label>
                                          <input type="checkbox" name="tarif[]" value="<?=$d['id_lab_tarif']?>"><?=$d['nama']?>
                                        </label><br>
                                      <?php }
                                      ?>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-lg-3">
                                  <div class="form-group">
                                    <label>URINE</label>
                                    <div class="checkbox">
                                      <?php 
                                      $data = mysqli_query($koneksi,
                                        "SELECT * FROM lab_tarif WHERE kel='3';");
                                        while($d = mysqli_fetch_array($data)){ ?>
                                          <label>
                                            <input type="checkbox" name="tarif[]" value="<?=$d['id_lab_tarif']?>"><?=$d['nama']?>
                                          </label><br>
                                        <?php }
                                        ?>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-lg-3">
                                    <div class="form-group">
                                      <label>SEROLOGI</label>
                                      <div class="checkbox">
                                        <?php 
                                        $data = mysqli_query($koneksi,
                                          "SELECT * FROM lab_tarif WHERE kel='4';");
                                          while($d = mysqli_fetch_array($data)){ ?>
                                            <label>
                                              <input type="checkbox" name="tarif[]" value="<?=$d['id_lab_tarif']?>"><?=$d['nama']?>
                                            </label><br>
                                          <?php }
                                          ?>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div><br>
                                <div class="row">
                                  <div class="col-lg-12">
                                    <div class="col-lg-3">
                                      <div class="form-group">
                                        <label>LAIN-LAIN</label>
                                        <div class="checkbox">
                                          <?php 
                                          $data = mysqli_query($koneksi,
                                            "SELECT * FROM lab_tarif WHERE kel='5';");
                                            while($d = mysqli_fetch_array($data)){ ?>
                                              <label>
                                                <input type="checkbox" name="tarif[]" value="<?=$d['id_lab_tarif']?>"><?=$d['nama']?>
                                              </label><br>
                                            <?php }
                                            ?>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div><br>
                                  <button type="submit" name="tambahsubmit" class="btn btn-primary">Tambah</button>
                                  <a href="form-permintaan.php?id=<?php echo $id_lab_trn ?>"><button type="button" class="btn btn-success"><i class="fa fa-print"></i> Print</button></a>
                                  </form><?php } ?>
                                </div>
                              </div>
                            </div><!-- /#page-wrapper -->
                            <?php include "views/footer.php"; ?>