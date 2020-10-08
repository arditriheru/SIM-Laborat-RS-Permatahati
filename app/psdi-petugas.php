<?php include "views/header.php"; ?>
<nav>
  <div id="wrapper">
    <?php include "menu.php"; ?>
  </div><!-- /.navbar-collapse -->
</nav>
<div id="page-wrapper">
  <div class="row">
    <div class="col-lg-12">
      <h1>Petugas <small>Tambah</small></h1>
      <ol class="breadcrumb">
        <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"><i class="fa fa-check-square-o"></i> Petugas Baru</li>
      </ol>  
      <?php include "../config/welcome.php"?>
    </div>
  </div><!-- /.row -->
  <div class="row">
    <div class="col-lg-6">
      <form method="post" action="" role="form">
        <div class="form-group">
          <label>Nama Petugas</label>
          <input class="form-control" type="text" name="nama_petugas" placeholder="Masukkan.." required="">
        </div>
        <div class="form-group">
          <label>Username</label>
          <input class="form-control" type="text" name="username" placeholder="Masukkan.." required="">
        </div>
        <div class="form-group">
          <label>Password</label>
          <input class="form-control" type="text" name="password" placeholder="Masukkan.." required="">
        </div>
        <button type="submit" name="tambahsubmit" class="btn btn-success">Submit</button>
      </form>
      <?php
      if(isset($_POST['tambahsubmit'])){
        $nama_petugas = $_POST['nama_petugas'];
        $username     = $_POST['username'];
        $password     = md5($_POST['password']);

        $simpan=mysqli_query($koneksi,"INSERT INTO psdi_petugas (id_petugas, nama_petugas, username, password)VALUES('','$nama_petugas','$username','$password')");
        if($simpan){
          echo '<script>
          setTimeout(function() {
            swal({
              title: "Sukses",
              text: "Menambah Petugas Baru",
              type: "success"
              }, function() {
                window.location = "psdi-petugas.php";
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
                      window.location = "psdi-petugas.php";
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