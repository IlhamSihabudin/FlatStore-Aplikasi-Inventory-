<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Flat Store</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="../css/font-awesome.css">
    <!-- Fontastic Custom icon font-->
    <link rel="stylesheet" href="../css/fontastic.css">
    <!-- Google fonts - Poppins -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,700">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="../css/style.green.css" id="theme-stylesheet">
    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.css">
    <!-- dataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">
    <!-- Favicon-->
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
  </head>

<?php 
session_start();
  if (isset($_SESSION['level']) != "admin") {
    echo "<script>alert('Login Duhulu!!');document.location.href='../'</script>";
  }

  if (isset($_GET['keluar'])) {
    session_destroy();

    echo "<script>document.location.href='../'</script>";
  }
 ?>

  <body>
    <div class="page">
      <!-- Main Navbar-->
      <header class="header">
        <nav class="navbar">
          <div class="container-fluid">
            <div class="navbar-holder d-flex align-items-center justify-content-between">
              <!-- Navbar Header-->
              <div class="navbar-header">
                <!-- Navbar Brand --><a href="index.html" class="navbar-brand">
                  <div class="brand-text brand-big"><span>Flat </span><strong>Store</strong></div>
                  <div class="brand-text brand-small"><strong>FS</strong></div></a>
                <!-- Toggle Button--><a id="toggle-btn" href="#" class="menu-btn active"><span></span><span></span><span></span></a>
              </div>
              <!-- Navbar Menu -->
              <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
                <!-- Logout    -->
                <li class="nav-item"><a href="?keluar" class="nav-link logout">Logout<i class="fa fa-sign-out"></i></a></li>
              </ul>
            </div>
          </div>
        </nav>
      </header>
      <div class="page-content d-flex align-items-stretch"> 
        <!-- Side Navbar -->
        <nav class="side-navbar">
          <!-- Sidebar Navidation Menus-->
            <ul>
              <li><a href="?menu=home"> <i class="icon-home"></i>Home</a></li>
            </ul>
          <ul class="list-unstyled">
            <li><a href="#inputan" aria-expanded="false" data-toggle="collapse"> <i class="fa fa-plus-square-o"></i> Inputan</a>
              <ul id="inputan" class="collapse list-unstyled">
                <li><a href="?menu=input_barang"> <i class="fa fa-angle-double-right"></i>Input Barang</a></li>
                <li><a href="?menu=tambah_stok"> <i class="fa fa-angle-double-right"></i>Tambah Stok</a></li> 
                <li><a href="?menu=input_distributor"> <i class="fa fa-angle-double-right"></i>Input Distributor</a></li>
                <li><a href="?menu=input_merek"> <i class="fa fa-angle-double-right"></i>Input Merek</a></li>
              </ul>
            </li>
            <li><a href="#laporan" aria-expanded="false" data-toggle="collapse"> <i class="fa fa-reply-all"></i> Laporan</a>
              <ul id="laporan" class="collapse list-unstyled">
                <li><a href="?menu=daftar_barang"> <i class="fa fa-angle-double-right"></i>Semua Daftar Barang</a></li>
                <li><a href="?menu=stok_barang"> <i class="fa fa-angle-double-right"></i>Stok Barang</a></li>
              </ul>
            </li>
          </ul>
          
        </nav>
        <div class="content-inner">
          <?php 
            switch (@$_GET['menu']) {
              case 'home':
                include 'home_admin.php';
                break;

              case 'input_barang':
                include 'input_barang.php';
                break;

              case 'tambah_stok':
                include 'input_stok.php';
                break;
              
              case 'input_distributor':
                include 'input_distributor.php';
                break;

              case 'input_merek':
                include 'input_merek.php';
                break;

              case 'daftar_barang':
                include 'daftar_barang.php';
                break;

              case 'stok_barang':
                include 'stok_barang.php';
                break;

              default:
                include 'home_admin.php';
                break;
            }
           ?>  
        </div>
      </div>
    </div>
    <!-- JavaScript files-->
    <script src="../js/jquery.js"></script>
    <script src="../js/bootstrap.js"></script>
    <!-- <script src="../js/popper.js"> </script> -->
    <script src="../js/jquery.validate.js"></script>
    <!-- Main File-->
    <script src="../js/front.js"></script>

    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
    
    <script type="text/javascript">
      $(document).ready(function() {
        $('#example').DataTable();
      } );     
    </script>
</html>