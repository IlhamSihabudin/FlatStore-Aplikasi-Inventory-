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
							<h3 class="h4">Filter Tanggal</h3>
						</div>
						<div class="card-body">
							<form method="post" enctype="multipart/form-data">
								<div class="row">
									<div class="col-lg-5">
										<div class="form-group">
											<label class="form-control-label">Tanggal Awal</label>
											<input type="date" class="form-control" name="tgl_awal" value="<?= @$_GET['awal'] ?>" required>
										</div>
									</div>
									<div style="text-align: center;padding-top: 40px">
										<label class="form-control-label" style="font-size: 14pt">To</label>
									</div>
									<div class="col-lg-5">
										<div class="form-group">
											<label class="form-control-label">Tanggal Akhir</label>
											<input type="date" class="form-control" name="tgl_akhir" value="<?= @$_GET['akhir'] ?>" required>
										</div>
									</div>
								</div>
								<button type="submit" class="btn btn-primary" name="go">Go</button>
							</form>
						</div>
					</div>
				</div>

			<?php 

			if (isset($_POST['go'])) {
				echo "<script>document.location.href='?menu=penjualan_pertanggal&show&awal=$_POST[tgl_awal]&akhir=$_POST[tgl_akhir]'</script>";
			} 

			if (isset($_GET['show'])) {
				$tgl_awal = $_GET['awal'];
				$tgl_akhir = $_GET['akhir'];
			?>
				<div class="col-lg-12">
					<div class="card">
						<div class="card-header d-flex align-items-center">
							<h3 class="h4">Daftar Barang</h3>
						</div>
						<div class="card-body">
							<form method="post" enctype="multipart/form-data">
								<div class="row">
									<div class="col-lg-12">
										<button class="btn btn-primary" style="margin-bottom: 20px;"><a href="print_pertanggal.php?menu=penjualan_pertanggal&show&awal=<?= $_GET['awal'] ?>&akhir=<?= $_GET['akhir'] ?>" style="color: white" target="output"><i class="fa fa-print"> </i> Print</a></button>
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
														$query = mysqli_query($con, "SELECT * FROM daftar_transaksi WHERE tanggal_beli BETWEEN '$tgl_awal' AND '$tgl_akhir'");
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
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			<?php
			}

			?>
			</div>
		</div>
	</section>
</body>
</html>