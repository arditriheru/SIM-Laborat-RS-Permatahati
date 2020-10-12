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
          <label>Parameter</label>
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
                <div class="col-lg-6">
                  <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped tablesorter">
                      <thead>
                        <tr>
                          <th><center>#</center></th>
                          <th><center>Nama Parameter</center></th>
                          <th><center>Nilai Normal</center></th>
                          <th><center>Satuan</center></th>
                          <th><center>Tarif</center></th>
                          <th colspan='2'><center>Action</center></th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                        $no = 1;
                        $data = mysqli_query($koneksi,
                          "SELECT * FROM lab_tarif ORDER BY nama ASC;");
                        while($d = mysqli_fetch_array($data)){
                          ?>
                          <tr>
                            <td><center><?php echo $no++; ?></center></td>
                            <td><left><?php echo $d['nama']; ?></left></td>
                            <td><center><?php echo $d['nilai_normal']; ?></center></td>
                            <td><center><?php echo $d['satuan']; ?></center></td>
                            <td><center><?php echo $d['tarif']; ?></center></td>
                            <td>
                              <div align="center">
                                <a href="laborat-tarif-edit.php?id=<?php echo $d['id_lab_tarif']; ?>"
                                  <button type="button" class="btn btn-success"><i class='fa fa-pencil'></i></button></a>
                                </div>
                              </td>
                              </tr><?php } ?>
                            </tbody>
                          </table>
                        </div><!-- col-lg-12 -->
                      </div>
                    </div>
                  </div><!-- /#page-wrapper -->
                  <?php include "views/footer.php"; ?>