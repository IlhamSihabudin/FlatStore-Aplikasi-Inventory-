<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link rel="stylesheet" href="">
</head>
<body>

<?php
include '../config/koneksi.php';
include '../library/controllers.php';
date_default_timezone_set('Asia/Jakarta');
$tanggal = date('Y-m-d');

$oop = new oop();

?>
<body>
	<section class="forms"> 
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-12">
					<div class="card">
						<div class="card-header d-flex align-items-center">
							<h3 class="h4">Daftar Barang</h3>
						</div>
						<div class="card-body">
							<form method="post" enctype="multipart/form-data">
								<div class="row">
									<div class="col-lg-12">
										<button class="btn btn-primary" style="margin-bottom: 20px;"><a href="print_stok.php" style="color: white" target="output"><i class="fa fa-print"> </i> Print</a></button>
										<div class="table-responsive">
											<table id="example" class="table table-striped tables-bordered" style="width:100%">
												<thead>
													<tr>
														<th>Kode Barang</th>
														<th>Nama Barang</th>
														<th>Merk</th>
														<th>Distributor</th>
														<th>Harga</th>
														<th>Stok</th>
														<th>Gambar</th>
													</tr>
												</thead>
												<tbody>
													<?php 
														$tampil = $oop->selectAllOrder($con, "daftar_barang", "stok_barang", "asc");
														foreach ($tampil as $row) { 
															if ($row['stok_barang'] <= 10) {?>
															<tr class="bg-danger">
																<td><a href="?menu=tambah_stok&tambah&kd=<?= $row['kd_barang'] ?>" style="color: white;"><?= $row['kd_barang'] ?></a></td>
																<td><a href="?menu=tambah_stok&tambah&kd=<?= $row['kd_barang'] ?>" style="color: white;"><?= $row['nama_barang'] ?></a></td>
																<td><a href="?menu=tambah_stok&tambah&kd=<?= $row['kd_barang'] ?>" style="color: white;"><?= $row['merek'] ?></a></td>
																<td><a href="?menu=tambah_stok&tambah&kd=<?= $row['kd_barang'] ?>" style="color: white;"><?= $row['nama_distributor'] ?></a></td>
																<td><a href="?menu=tambah_stok&tambah&kd=<?= $row['kd_barang'] ?>" style="color: white;"><?= $row['harga_barang'] ?></a></td>
																<td><a href="?menu=tambah_stok&tambah&kd=<?= $row['kd_barang'] ?>" style="color: white;"><?= $row['stok_barang'] ?></a></td>
																<td><a href="?menu=tambah_stok&tambah&kd=<?= $row['kd_barang'] ?>" style="color: white;"><img src="../foto/<?= $row['gambar'] ?>" width="80px;"></a></td>
															</tr>	
															<?php }else{?>
															<tr>
																<td><?= $row['kd_barang'] ?></td>
																<td><?= $row['nama_barang'] ?></td>
																<td><?= $row['merek'] ?></td>
																<td><?= $row['nama_distributor'] ?></td>
																<td><?= $row['harga_barang'] ?></td>
																<td><?= $row['stok_barang'] ?></td>
																<td><img src="../foto/<?= $row['gambar'] ?>" width="80px;"></td>
															</tr>
														<?php }
														} ?>
												</tbody>
											</table>
										</div>
									</div>
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