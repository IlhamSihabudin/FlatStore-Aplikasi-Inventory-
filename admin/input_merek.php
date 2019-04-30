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

$cek_kode = mysqli_query($con, "select max(kd_merek) from tbl_merek");
@$data = mysqli_fetch_array($cek_kode);
if ($data) {
	$nilaikode = substr($data[0], 1);
	$kode = (int) $nilaikode;
	$kode = $kode + 1;
	$kode_otomatis = "M".str_pad($kode, 4, "0", STR_PAD_LEFT);
} else {
	$kode_otomatis = "M0001";
}

$table = "tbl_merek";
@$isi = "kd_merek = '$_POST[kd_merek]', merek = '$_POST[merek]'";
$link = "?menu=input_merek";
@$where = "kd_merek = '$_GET[id]'";

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
								<h3 class="h4">Edit Merk</h3>
							<?php }else{ ?>
								<h3 class="h4">Input Merk</h3>
							<?php } ?>
						</div>
						<div class="card-body">
							<form method="post" enctype="multipart/form-data">
								<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
											<label class="form-control-label">Kode Merk</label>
											<?php if (isset($_GET['ubah'])) {?>
												<input type="text" class="form-control" name="kd_merek" value="<?= @$data['kd_merek'] ?>" readonly>
											<?php }else{ ?>
												<input type="text" class="form-control" name="kd_merek" value="<?= $kode_otomatis ?>" readonly>
											<?php } ?>
										</div>
										<div class="form-group">
											<label class="form-control-label">Nama Merk</label>
											<input type="text" class="form-control" name="merek" value="<?= @$data['merek'] ?>">
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
							<h3 class="h4">Daftar Merek</h3>
						</div>
						<div class="card-body">
							<div class="table-responsive">
								<table class="table table-striped table-hover text-center">
									<thead>
										<tr>
											<th>Kode Merk</th>
											<th>Nama Merk</th>
											<th>Edit</th>
											<th>Hapus</th>
										</tr>
									</thead>
									<tbody>
										<?php 
											$tampil = $oop->selectAll($con, $table);
											foreach ($tampil as $row) {?>
												<tr>
													<td><?= $row['kd_merek'] ?></td>
													<td><?= $row['merek'] ?></td>
													<td><a href="?menu=input_merek&ubah&id=<?= $row['kd_merek'] ?>"><i class="fa fa-pencil text-success" style="font-size: 18pt"></i></a></td>
													<td><a href="?menu=input_merek&hapus&id=<?= $row['kd_merek'] ?>" onclick="return confirm('Anda Yakin Akan Menghapusnya?')"><i class="fa fa-trash text-danger" style="font-size: 18pt;"></i></a></td>
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