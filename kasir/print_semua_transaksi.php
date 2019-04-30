<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link rel="stylesheet" href="../css/bootstrap.min.css">
</head>

<?php
include '../config/koneksi.php';
include '../library/controllers.php';
date_default_timezone_set('Asia/Jakarta');
$tanggal = date('Y-m-d');

$oop = new oop();

?>

<body>
	<script>window.print();</script>
	<div class="container">
		<div class="text-center">
		<h1>DAFTAR SEMUA TRANSAKSI</h1>
	</div>
	<div class="table-responsive">
		<table id="example" class="table table-striped tables-bordered" style="width:100%">
												<thead>
													<tr>
														<th>Kode Transaksi</th>
														<th>Nama Barang</th>
														<th>Harga Barang</th>
														<th>Jumlah Beli</th>
														<th>Total Harga</th>
													</tr>
												</thead>
												<tbody>
													<?php 
														$tampil = $oop->selectAll($con, "daftar_transaksi");
														foreach ($tampil as $row) { ?>
															<tr>
																<td><?= $row['kd_transaksi'] ?></td>
																<td><?= $row['nama_barang'] ?></td>
																<td><?= $row['harga_barang'] ?></td>
																<td><?= $row['jumlah_beli'] ?></td>
																<td><?= $row['total_harga'] ?></td>
															</tr>
														<?php } ?>
												</tbody>
											</table>
	</div>
</body>
</html>