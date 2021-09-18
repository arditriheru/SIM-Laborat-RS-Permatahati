<?php include "views/header.php"; ?>
<nav>
  <div id="wrapper">
    <?php include "menu.php"; $id_lab_tarif = $_GET['id']; ?>
  </div><!-- /.navbar-collapse -->
</nav>
<div id="page-wrapper">
  <div class="row">
    <div class="col-lg-12">
      <h1>Tarif <small>Edit</small></h1>
      <ol class="breadcrumb">
        <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"><i class="fa fa-check-square-o"></i> Tarif</li>
      </ol>  
      <?php include "../config/welcome.php"?>
    </div>
  </div><!-- /.row -->
  <div class="row">
    <div class="col-lg-6">
      <div align="right">
        <a href="laborat-tarif-hapus.php?id=<?php echo $id_lab_tarif; ?>"
          onclick="javascript: return confirm('Anda yakin hapus?')">
          <button type="button" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>
        </a>
      </div>
      <?php 
      $data = mysqli_query($koneksi,
        "SELECT * FROM lab_tarif WHERE id_lab_tarif = '$id_lab_tarif';");
      while($d = mysqli_fetch_array($data)){
        ?>
        <form method="post" action="" role="form">
          <div class="form-group">
            <label>Nama Parameter</label>
            <input class="form-control" type="text" name="nama" value="<?php echo $d['nama'];?>" required="">
          </div>
          <div class="form-group">
            <label>Nilai Normal</label>
            <input class="form-control" type="text" name="nilai_normal" value="<?php echo $d['nilai_normal'];?>" required="">
          </div>
          <div class="form-group">
            <label>Satuan</label>
            <input class="form-control" type="text" name="satuan" value="<?php echo $d['satuan'];?>" required="">
          </div>
          <div class="form-group">
            <label>Tarif</label>
            <input class="form-control" type="number" name="tarif" value="<?php echo $d['tarif'];?>" required="">
          </div>
          <button type="submit" name="editsubmit" class="btn btn-success">Submit</button>
          </form><?php } ?>
          <?php
          if(isset($_POST['editsubmit'])){
            $nama           = $_POST['nama'];
            $nilai_normal   = $_POST['nilai_normal'];
            $satuan         = $_POST['satuan'];
            $tarif          = $_POST['tarif'];

            $simpan=mysqli_query($koneksi,"UPDATE lab_tarif 
              SET nama='$nama', nilai_normal='$nilai_normal', satuan='$satuan', tarif='$tarif' WHERE id_lab_tarif='$id_lab_tarif'");
            if($simpan){
              echo '<script>
              setTimeout(function() {
                swal({
                  title: "Sukses",
                  text: "Memperbarui Tarif Baru",
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