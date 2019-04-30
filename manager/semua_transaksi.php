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
										<button class="btn btn-primary" style="margin-bottom: 20px;"><a href="print_semua_transaksi.php" style="color: white" target="output"><i class="fa fa-print"> </i> Print</a></button>
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