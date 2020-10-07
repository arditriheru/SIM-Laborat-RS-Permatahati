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
          <p>Telpon : (0274) 415317</p>
        </div>
      </div>
    </div>
    <div class="col-lg-6">
      <div class="bs-example">
        <div class="jumbotron">
          <h2>IT RSKIA Rachmi</h2>
          <p>Email  : it.rskiarachmi@gmail.com</p>
          <p>Telpon : (0274) 415318</p>
        </div>
      </div>
    </div>
  </div><!-- /.row -->
</div><!-- /#page-wrapper -->
<?php include "views/footer.php"; ?>