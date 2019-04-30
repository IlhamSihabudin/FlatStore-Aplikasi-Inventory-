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

$cek_kode = mysqli_query($con, "select max(kd_distributor) from tbl_distributor");
@$data = mysqli_fetch_array($cek_kode);
if ($data) {
	$nilaikode = substr($data[0], 1);
	$kode = (int) $nilaikode;
	$kode = $kode + 1;
	$kode_otomatis = "D".str_pad($kode, 4, "0", STR_PAD_LEFT);
} else {
	$kode_otomatis = "D0001";
}

$table = "tbl_distributor";
@$isi = "kd_distributor = '$_POST[kd_distributor]', nama_distributor = '$_POST[nama_distributor]', alamat = '$_POST[alamat]', no_telp = '$_POST[no_telp]'";
$link = "?menu=input_distributor";
@$where = "kd_distributor = '$_GET[id]'";

$oop = new oop();

if (isset($_POST['simpan'])) {
	$oop->insert($con, $table, $isi, $link);
}

if (isset($_GET['ubah'])) {
	$data = $oop->selectWhere($con, $table, $where);
}

if (isset($_GET['hapus'])) {
	$oop->delete($con, $table, $where, $link);
}

if (isset($_POST['edit'])) {
	$oop->update($con, $table, $isi, $where, $link);
}
?>

<body>
	<section class="forms"> 
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-4">
					<div class="card">
						<div class="card-header d-flex align-items-center">
							<?php if (isset($_GET['ubah'])) {?>
								<h3 class="h4">Edit Distributor</h3>
							<?php }else{ ?>
								<h3 class="h4">Input Distributor</h3>
							<?php } ?>
						</div>
						<div class="card-body">
							<form method="post" enctype="multipart/form-data">
								<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
											<label class="form-control-label">Kode Distributor</label>
											<?php if (isset($_GET['ubah'])) {?>
												<input type="text" class="form-control" name="kd_distributor" value="<?= @$data['kd_distributor'] ?>" readonly>
											<?php }else{ ?>
												<input type="text" class="form-control" name="kd_distributor" value="<?= $kode_otomatis ?>" readonly>
											<?php } ?>
										</div>
										<div class="form-group">
											<label class="form-control-label">Nama Distributor</label>
											<input type="text" class="form-control" name="nama_distributor" value="<?= @$data['nama_distributor'] ?>">
										</div>
										<div class="form-group">
											<label class="form-control-label">Alamat</label>
											<textarea class="form-control" name="alamat" row="3"><?= @$data['alamat'] ?></textarea>
										</div>
										<div class="form-group">
											<label class="form-control-label">No Telepon</label>
											<input type="number" class="form-control" name="no_telp" value="<?= @$data['no_telp'] ?>">
										</div>
										<div class="text-center">
											<?php if(isset($_GET['ubah'])) {?>
												<button type="submit" class="btn btn-success" name="edit"><i class="fa fa-upload"> </i> Edit</button>
											<?php }else{ ?>
												<button type="submit" class="btn btn-primary" name="simpan"><i class="fa fa-paper-plane"> </i> Simpan</button>
											<?php } ?>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
				<div class="col-lg-8">
					<div class="card">
						<div class="card-header d-flex align-items-center">
							<h3 class="h4">Daftar Distributor</h3>
						</div>
						<div class="card-body">
							<div class="table-responsive">
								<table class="table table-striped table-hover text-center">
									<thead>
										<tr>
											<th>Kode Distributor</th>
											<th>Nama Distributor</th>
											<th>Alamat</th>
											<th>No Telepon</th>
											<th>Edit</th>
											<th>Hapus</th>
										</tr>
									</thead>
									<tbody>
										<?php 
											$tampil = $oop->selectAll($con, $table);
											foreach ($tampil as $row) {?>
												<tr>
													<td><?= $row['kd_distributor'] ?></td>
													<td><?= $row['nama_distributor'] ?></td>
													<td><?= $row['alamat'] ?></td>
													<td><?= $row['no_telp'] ?></td>
													<td><a href="?menu=input_distributor&ubah&id=<?= $row['kd_distributor'] ?>"><i class="fa fa-pencil text-success" style="font-size: 18pt"></i></a></td>
													<td><a href="?menu=input_distributor&hapus&id=<?= $row['kd_distributor'] ?>" onclick="return confirm('Anda Yakin Akan Menghapusnya?')"><i class="fa fa-trash text-danger" style="font-size: 18pt;"></i></a></td>
												</tr>
											<?php } ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</body>
</html>