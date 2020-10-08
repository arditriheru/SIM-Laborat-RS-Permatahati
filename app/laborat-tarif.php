<?php include "views/header.php"; ?>
<nav>
  <div id="wrapper">
    <?php include "menu.php"; ?>
  </div><!-- /.navbar-collapse -->
</nav>
<div id="page-wrapper">
  <div class="row">
    <div class="col-lg-12">
      <h1>Tarif <small>Tambah</small></h1>
      <ol class="breadcrumb">
        <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"><i class="fa fa-check-square-o"></i> Tarif</li>
      </ol>  
      <?php include "../config/welcome.php"?>
    </div>
  </div><!-- /.row -->
  <div class="row">
    <div class="col-lg-6">
      <form method="post" action="" role="form">
        <div class="form-group">
          <label>Nama Parameter</label>
          <input class="form-control" type="text" name="nama" placeholder="Masukkan.." required="">
        </div>
        <div class="form-group">
          <label>Nilai Normal</label>
          <input class="form-control" type="text" name="nilai_normal" placeholder="Masukkan.." required="">
        </div>
        <div class="form-group">
          <label>Satuan</label>
          <input class="form-control" type="text" name="satuan" placeholder="Masukkan.." required="">
        </div>
        <div class="form-group">
          <label>Tarif</label>
          <input class="form-control" type="number" name="tarif" placeholder="Masukkan.." required="">
        </div>
        <div class="form-group">
          <label>Sampel</label>
          <select class="form-control" type="text" name="id_lab_sampel" required="">
            <option value="">Pilih</option>
            <?php 
            $data = mysqli_query($koneksi,
              "SELECT id_lab_sampel, nama_sampel FROM lab_sampel;");
            while($d = mysqli_fetch_array($data)){
              echo "<option value='".$d['id_lab_sampel']."'>".$d['nama_sampel']."</option>";
            }
            ?>
          </select>
        </div>
        <div class="form-group">
          <label>Kelompok</label>
          <select class="form-control" type="text" name="kel" required="">
            <option value="">Pilih</option>
            <option value="1">Hematologi</option>
            <option value="2">Kimia Darah</option>
            <option value="3">Urine</option>
            <option value="4">Serologi</option>
            <option value="5">Lain-lain</option>
          </select>
        </div>
        <button type="submit" name="tambahsubmit" class="btn btn-success">Submit</button>
      </form>
      <?php
      if(isset($_POST['tambahsubmit'])){
        $nama           = $_POST['nama'];
        $nilai_normal   = $_POST['nilai_normal'];
        $satuan         = $_POST['satuan'];
        $tarif          = $_POST['tarif'];
        $id_lab_sampel  = $_POST['id_lab_sampel'];
        $kel            = $_POST['kel'];

        $simpan=mysqli_query($koneksi,"INSERT INTO lab_tarif (id_lab_tarif, id_lab_sampel, nama, nilai_normal, satuan, tarif, kel)VALUES('','$id_lab_sampel','$nama','$nilai_normal','$satuan','$tarif','$kel')");
        if($simpan){
          echo '<script>
          setTimeout(function() {
            swal({
              title: "Sukses",
              text: "Menambah Tarif Baru",
              type: "success"
              }, function() {
                window.location = "laborat-tarif.php";
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
                      window.location = "laborat-tarif.php";
                      });
                      }, 10);
                      </script>';
                    }
                  }
                  ?>
                </div>
              </div>
            </div><!-- /#page-wrapper -->
            <?php include "views/footer.php"; ?>