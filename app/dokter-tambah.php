<?php include "views/header.php"; ?>
<nav>
  <div id="wrapper">
    <?php include "menu.php"; ?>
  </div><!-- /.navbar-collapse -->
</nav>
<div id="page-wrapper">
  <div class="row">
    <div class="col-lg-12">
      <h1>Dokter <small>Tambah</small></h1>
      <ol class="breadcrumb">
        <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"><i class="fa fa-check-square-o"></i> Dokter Baru</li>
      </ol>  
      <?php include "../config/welcome.php"?>
    </div>
  </div><!-- /.row -->
  <div class="row">
    <div class="col-lg-6">
      <form method="post" action="" role="form">
        <div class="form-group">
          <label>Nama Dokter</label>
          <input class="form-control" type="text" name="nama_dokter" placeholder="Masukkan.." required="">
        </div>
        <div class="form-group">
          <label>Unit</label>
          <select class="form-control" type="text" name="id_unit" required="">
            <option value="">Pilih</option>
            <?php 
            $data = mysqli_query($koneksi,
              "SELECT id_unit, nama_unit FROM mr_unit;");
            while($d = mysqli_fetch_array($data)){
              echo "<option value='".$d['id_unit']."'>".$d['nama_unit']."</option>";
            }
            ?>
          </select>
        </div>
        <button type="submit" name="tambahsubmit" class="btn btn-success">Submit</button>
      </form>
      <?php
      if(isset($_POST['tambahsubmit'])){
        $id_unit     = $_POST['id_unit'];
        $nama_dokter = $_POST['nama_dokter'];

        $simpan=mysqli_query($koneksi,"INSERT INTO mr_dokter (id_dokter, id_unit, nama_dokter)VALUES('','$id_unit','$nama_dokter')");
        if($simpan){
          echo '<script>
          setTimeout(function() {
            swal({
              title: "Sukses",
              text: "Menambah Dokter Baru",
              type: "success"
              }, function() {
                window.location = "dokter-tambah.php";
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
                      window.location = "dokter-tambah.php";
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