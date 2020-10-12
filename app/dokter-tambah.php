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
                <div class="col-lg-6">
                  <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped tablesorter">
                      <thead>
                        <tr>
                          <th><center>#</center></th>
                          <th><center>Nama Dokter</center></th>
                          <th><center>Unit</center></th>
                          <!-- <th colspan='2'><center>Action</center></th> -->
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                        $no = 1;
                        $data = mysqli_query($koneksi,
                          "SELECT *, mr_unit.nama_unit
                          FROM mr_dokter
                          INNER JOIN mr_unit
                          ON mr_dokter.id_unit = mr_unit.id_unit
                          ORDER BY nama_dokter ASC;");
                        while($d = mysqli_fetch_array($data)){
                          ?>
                          <tr>
                            <td><center><?php echo $no++; ?></center></td>
                            <td><left><?php echo $d['nama_dokter']; ?></left></td>
                            <td><center><?php echo $d['nama_unit']; ?></center></td>
                            <!-- <td>
                              <div align="center">
                                <a href="trn-detail.php?id=<?php echo $d['id_lab_trn']; ?>"
                                  <button type="button" class="btn btn-success"><i class='fa fa-file-text'></i></button></a>
                                </div>
                              </td> -->
                              </tr><?php } ?>
                            </tbody>
                          </table>
                        </div><!-- col-lg-12 -->
                      </div>
                    </div>
                  </div><!-- /#page-wrapper -->
                  <?php include "views/footer.php"; ?>