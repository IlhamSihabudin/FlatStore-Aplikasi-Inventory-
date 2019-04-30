
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>FlatStore</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Fontastic Custom icon font-->
    <link rel="stylesheet" href="css/fontastic.css">
    <!-- Google fonts - Poppins -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,700">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="css/style.green.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="css/custom.css">
    <!-- Favicon-->
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
  </head>

  <?php
    include 'config/koneksi.php';
    include 'library/controllers.php';

    @$table = "tbl_user";
    @$user  = $_POST['username'];
    @$pass  = base64_encode($_POST['password']);
    @$level = $_POST['level'];

    $oop = new oop();

    if (isset($_POST['login'])) {
      $oop->login($con, $table, $user, $pass, $level);
    }
   ?>

  <body>
    <div class="page login-page">
      <div class="container d-flex align-items-center">
        <div class="form-holder has-shadow">
          <div class="row">
            <!-- Logo & Information Panel-->
            <div class="col-lg-6">
              <div class="info d-flex align-items-center">
                <div class="content">
                  <div class="logo">
                    <h1>FLAT STORE</h1>
                  </div>
                  <p>Menyediakan Semua Barang Yang Anda Perlukan.</p>
                </div>
              </div>
            </div>
            <!-- Form Panel    -->
            <div class="col-lg-6 bg-white">
              <div class="form d-flex align-items-center">
                <div class="content">
                  <form id="login-form" method="post">
                    <div class="form-group">
                      <input id="username" type="text" name="username" required class="input-material">
                      <label for="username" class="label-material">Username</label>
                    </div>
                    <div class="form-group">
                      <input id="password" type="password" name="password" required class="input-material">
                      <label for="password" class="label-material">Password</label>
                    </div>
                    <div class="form-group">
                    	<label class="form-control-label">Level</label>
                    	<select id="level" name="level" class="form-control input-material" required>
                    		<option value="" disabled selected>Choose your option</option>
                    		<option value="kasir">Kasir</option>
                    		<option value="manager">Manager</option>
                    		<option value="admin">Admin</option>
                    	</select>
                    </div>
                    <button id="login" name="login" type="submit" class="btn btn-primary col-lg-5 col-md-7">Login</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- JavaScript files-->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/jquery.validate.js"></script>
    <!-- Main File-->
    <script src="js/front.js"></script>
  </body>
</html>