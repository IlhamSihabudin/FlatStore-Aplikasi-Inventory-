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
		<h1>DAFTAR STOK BARANG</h1>
	</div>
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
					<tr style="color: red;">
						<td><?= $row['kd_barang'] ?></td>
						<td><?= $row['nama_barang'] ?></td>
						<td><?= $row['merek'] ?></td>
						<td><?= $row['nama_distributor'] ?></td>
						<td><?= $row['harga_barang'] ?></td>
						<td><?= $row['stok_barang'] ?></td>
						<td><img src="../foto/<?= $row['gambar'] ?>" width="80px;"></td>
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
</body>
</html>