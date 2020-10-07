<?php include "views/header.php"; ?>
<nav>
  <div id="wrapper">
    <?php include "menu.php"; ?>
  </div><!-- /.navbar-collapse -->
</nav>
<div id="page-wrapper">
  <div class="row">
    <div class="col-lg-12">
      <h1>Customer <small>Service</small></h1>
      <ol class="breadcrumb">
        <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"><i class="fa fa-check-square-o"></i> Customer Service</li>
      </ol>  
      <?php include "../config/welcome.php"?>
    </div>
  </div><!-- /.row -->
  <div class="row">
    <div class="col-lg-6">
      <div class="bs-example">
        <div class="jumbotron">
          <h2>Laboratorium RSKIA Permata</h2>
          <p>Email  : lab.rskia.permata@gmail.com</p>
          <p>Telepon : (0274) 415317</p>
        </div>
      </div>
    </div>
    <div class="col-lg-6">
      <div class="bs-example">
        <div class="jumbotron">
          <h2>Ardi Tri Heru</h2>
          <p>Email  : arditriheruh@gmail.com</p>
          <p>Mobile : 0896 2967 1717</p>
          <p>
            <a href="https://api.whatsapp.com/send?phone=6289629671717" target="_blank" class="btn btn-success btn-lg"><i class="fa fa-whatsapp"></i></a>
            <a href="https://www.instagram.com/arditriheru/" target="_blank" class="btn btn-danger btn-lg"><i class="fa fa-instagram"></i></a>
            <a href="https://gmail.com" target="_blank" class="btn btn-primary btn-lg"><i class="fa fa-envelope"></i></a>
          </p>
        </div>
      </div>
    </div>
  </div><!-- /.row -->
</div><!-- /#page-wrapper -->
<?php include "views/footer.php"; ?>