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
			<h1>DAFTAR TRANSAKSI</h1>
			<h2>Dari Tanggal<br><?= $_GET['awal'] . " - " . $_GET['akhir'] ?></h2>
		</div>
	<div class="table-responsive">
		<table id="example" class="table table-striped tables-bordered" style="width:100%">
												<thead>
													<tr>
														<th>Kode Transaksi</th>
														<th>Nama Barang</th>
														<th>Harga Barang</th>
														<th>Jumlah Beli</th>
														<th>Tanggal Beli</th>
													</tr>
												</thead>
												<tbody>
													<?php 
														$query = mysqli_query($con, "SELECT * FROM daftar_transaksi WHERE tanggal_beli BETWEEN '$_GET[awal]' AND '$_GET[akhir]'");
														while ($data = mysqli_fetch_array($query)) { ?>
															<tr>
																<td><?= $data['kd_transaksi'] ?></td>
																<td><?= $data['nama_barang'] ?></td>
																<td><?= $data['harga_barang'] ?></td>
																<td><?= $data['jumlah_beli'] ?></td>
																<td><?= $data['tanggal_beli'] ?></td>
															</tr>
													<?php }
													 ?>
												</tbody>
											</table>
	</div>
</body>
</html>