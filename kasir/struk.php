<?php
include '../config/koneksi.php';
include '../library/controllers.php';
date_default_timezone_set('Asia/Jakarta');

session_start();
$oop = new oop();

$kd_transaksi = $_SESSION['kd_trans'];

$kembalian = 0;
$kembalian = $_SESSION['bayar'] - $_SESSION['grand_total'];
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
			<h1 style="font-size: 35pt;font-weight: bold">TOKO FLAT</h1>
			<h1>STRUK PEMBAYARAN</h1>
			<h3>Kode Transaksi : <?= $_SESSION['kd_trans'] ?></h3>
			<table border="1" style="width: 60%;margin: auto">
				<thead>
					<tr style="text-align: center">
						<th>Nama Barang</th>
						<th>Harga Barang</th>
						<th>Jumlah Beli</th>
						<th>Total Harga</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						$query = mysqli_query($con, "SELECT * FROM daftar_transaksi WHERE kd_transaksi = '$kd_transaksi'");
						while ($row = mysqli_fetch_array($query)) { ?>
							<tr style="text-align: center">
								<td><?= $row['nama_barang'] ?></td>
								<td><?= $row['harga_barang'] ?></td>
								<td><?= $row['jumlah_beli'] ?></td>
								<td><?= $row['total_harga'] ?></td>
							</tr>
						<?php }
					 ?>
					 <tr>
					 	<td style="text-align: center;" colspan="3" style="text-align: right;">Grand Total</td>
					 	<td style="text-align: center;"><?= $_SESSION['grand_total'] ?></td>
					 </tr>
					 <tr>
					 	<td style="text-align: center;" colspan="3" style="text-align: right;">Bayar</td>
					 	<td style="text-align: center;"><?= $_SESSION['bayar'] ?></td>
					 </tr>
					 <tr>
					 	<td style="text-align: center;" colspan="3" style="text-align: right;">Kembalian</td>
					 	<td style="text-align: center;"><?= $kembalian ?></td>
					 </tr>
				</tbody>
			</table>
		</div>
	</section>
</body>
</html>