<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
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
										<button class="btn btn-primary" style="margin-bottom: 20px;"><a href="print.php" style="color: white" target="output"><i class="fa fa-print"> </i> Print</a></button>
										<div class="table-responsive">
											<table id="example" class="table table-striped tables-bordered" style="width:100%">
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
														foreach ($tampil as $row) { ?>
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
														<?php }?>
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

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('#example').DataTable();
	} );
</script>
</body>
</html>