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

	$cek_kode = mysqli_query($con, "select max(kd_barang) from tbl_barang");
	@$data = mysqli_fetch_array($cek_kode);
	if ($data) {
		$nilaikode = substr($data[0], 1);
		$kode = (int) $nilaikode;
		$kode = $kode + 1;
		$kode_otomatis = "B".str_pad($kode, 4, "0", STR_PAD_LEFT);
	} else {
		$kode_otomatis = "B0001";
	}

	@$where = "nama_barang = '$_POST[nama_barang]'";
	$link  = "?menu=input_barang";

	if (isset($_POST['submit'])) {
		$nama_file = $_FILES['gambar']['name'];
		$tmp_file = $_FILES['gambar']['tmp_name'];
		$type = $_FILES['gambar']['type'];
		move_uploaded_file($tmp_file,"../foto/$nama_file");

		@$isi = "kd_barang = '$kode_otomatis', nama_barang = '$_POST[nama_barang]', kd_merek = '$_POST[merek]', kd_distributor = '$_POST[distributor]', tanggal_masuk = '$tanggal', harga_barang = '$_POST[harga]', stok_barang = '$_POST[stok]', gambar = '$nama_file', keterangan = '$_POST[keterangan]'";
		
		$oop->insertSelect($con, "tbl_barang", $isi, $where, $link);
	}
	
 ?>

<body>
	<section class="forms"> 
		<div class="container-fluid">
			<div class="col-lg-12">
				<div class="card">
					<div class="card-header d-flex align-items-center">
						<h3 class="h4">Input Barang</h3>
					</div>
					<div class="card-body">
						<form method="post" enctype="multipart/form-data">
							<div class="row">
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="form-group">
										<label class="form-control-label">Kode Barang</label>
										<input type="text" placeholder="Kode Barang" class="form-control" name="kd_barang" value="<?= $kode_otomatis ?>" readonly>
									</div>
									<div class="form-group">
										<label class="form-control-label">Nama Barang</label>
										<input type="text" placeholder="Nama Barang" class="form-control" name="nama_barang" required>
									</div>
									<div class="form-group">
										<label class="form-control-label">Merek</label>
										<select name="merek" class="form-control input-material" required>
											<option value="" disabled selected>Choose your option</option>
											<?php
												$tampil = $oop->selectAll($con, "tbl_merek");
												foreach ($tampil as $row) {?>
												<option value="<?= $row['kd_merek'] ?>"><?= $row['merek'] ?></option>
											<?php } ?>
										</select>
									</div>
									<div class="form-group">
										<label class="form-control-label">Distributor</label>
										<select name="distributor" class="form-control input-material" required>
											<option value="" disabled selected>Choose your option</option>
											<?php
												$tampil = $oop->selectAll($con, "tbl_distributor");
												foreach ($tampil as $row) {?>
												<option value="<?= $row['kd_distributor'] ?>"><?= $row['nama_distributor'] ?></option>
											<?php } ?>
										</select>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="form-group">
										<label class="form-control-label">Harga Barang</label>
										<input type="number" placeholder="Harga Barang" class="form-control" name="harga" min="0" required>
									</div>
									<div class="form-group">
										<label class="form-control-label">Stok</label>
										<input type="number" placeholder="Stok" class="form-control" name="stok" min="0" required>
									</div>
									<div class="form-group">
										<label class="form-control-label">Gambar</label>
										<input type="file" class="form-control" name="gambar" required>
									</div>
									<div class="form-group">
										<label class="form-control-label">Keterangan</label>
										<textarea class="form-control" rows="2" name="keterangan"></textarea>
									</div>
								</div>
							</div>
							<div class="text-center col-lg-12">
								<button type="submit" class="btn btn-primary" name="submit"><i class="fa fa-paper-plane"> </i> Simpan</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
</body>
</html>