<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link rel="stylesheet" href="">
</head>

<?php
include '../config/koneksi.php';
include '../library/controllers.php';
date_default_timezone_set('Asia/Jakarta');
$tanggal = date('Y-m-d');

$oop = new oop();

if (isset($_GET['tambah'])) {
	$where="kd_barang = '$_GET[kd]'";

	$tampil = $oop->selectWhere($con, "tbl_barang", $where);
}

if (isset($_POST['update'])) {
	$hasil = $_POST['t_stok'] + $_POST['l_stok'];

	$query = mysqli_query($con, "UPDATE tbl_barang SET stok_barang = '$hasil' WHERE $where");
	if ($query) {
		echo "<script>alert('Stok Berhasil Bertambah');document.location.href='?menu=tambah_stok'</script>";
	}else{
		echo "<script>alert('Terjadi Kesalahan!!')</script>";
	}
}

?>

<body>
	<section class="forms"> 
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-4">
					<div class="card">
						<div class="card-header d-flex align-items-center">
							<h3 class="h4">Tambah Stok Barang</h3>
						</div>
						<div class="card-body">
							<form method="post" enctype="multipart/form-data">
								<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
											<label class="form-control-label">Kode Barang</label>
											<input class="form-control" type="text" name="kd_barang" value="<?= @$tampil['kd_barang'] ?>" readonly>
										</div>
										<div class="form-group">
											<label class="form-control-label">Nama Barang</label>
											<input class="form-control" type="text" name="nama_barang" value="<?= @$tampil['nama_barang'] ?>" readonly>
										</div>
										<div class="form-group">
											<label class="form-control-label">Stok Lama</label>
											<input class="form-control" type="text" name="l_stok" value="<?= @$tampil['stok_barang'] ?>" readonly>
										</div>
										<div class="form-group">
											<label class="form-control-label">Tambah Stok</label>
											<input class="form-control" type="number" min="0" name="t_stok">
										</div>
									</div>
								</div>
								<div class="text-center col-lg-12">
									<button type="submit" class="btn btn-primary" name="update"><i class="fa fa-upload"> </i> Update</button>
								</div>
							</form>
						</div>
					</div>
				</div>
				<div class="col-lg-8">
					<div class="card">
						<div class="card-header d-flex align-items-center">
							<h3 class="h4">Daftar Barang</h3>
						</div>
						<div class="card-body">
							<form method="post" enctype="multipart/form-data">
								<div class="table-responsive">                       
									<table class="table table-striped table-hover">
										<thead>
											<tr>
												<th>Kode Barang</th>
												<th>Nama Barang</th>
												<th>Stok</th>
											</tr>
										</thead>
										<tbody>
											<?php 
											$tampil = $oop->selectAll($con, "tbl_barang");
											foreach ($tampil as $row) {?>
											<tr>
												<td><a href="?menu=tambah_stok&tambah&kd=<?= $row['kd_barang'] ?>"><?= $row['kd_barang'] ?></a></td>
												<td><?= $row['nama_barang'] ?></td>
												<td><?= $row['stok_barang'] ?></td>
											</tr>
											<?php } ?>
										</tbody>
									</table>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</body>
</html>