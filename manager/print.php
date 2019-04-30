<?php
include '../config/koneksi.php';
include '../library/controllers.php';
date_default_timezone_set('Asia/Jakarta');

$oop = new oop();
?>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<body>

	<script>window.print();</script>
	<section class="forms"> 
		<div class="container text-center">
			<h1>Daftar Barang</h1>
			<table class="table table-striped tables-bordered">
				<thead>
					<tr>
						<th>Kode Barang</th>
						<th>Nama Barang</th>
						<th>Merk</th>
						<th>Distributor</th>
						<th>Tanggal Masuk</th>
						<th>Harga</th>
						<th>Stok</th>
						<th>Gambar</th>
						<th>Keterangan</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$tampil = $oop->selectAll($con, "daftar_barang");
					foreach ($tampil as $row) {?>
						<tr>
							<td><?= $row['kd_barang'] ?></td>
							<td><?= $row['nama_barang'] ?></td>
							<td><?= $row['merek'] ?></td>
							<td><?= $row['nama_distributor'] ?></td>
							<td><?= $row['tanggal_masuk'] ?></td>
							<td><?= $row['harga_barang'] ?></td>
							<td><?= $row['stok_barang'] ?></td>
							<td><img src="../foto/<?= $row['gambar'] ?>" width="80px;"></td>
							<td><?= $row['keterangan'] ?></td>
						</tr>
						<?php } ?>
				</tbody>
			</table>
		</div>
	</section>
</body>
</html>