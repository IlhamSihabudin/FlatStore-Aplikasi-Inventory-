<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">
</head>

<?php
include '../config/koneksi.php';
include '../library/controllers.php';
$oop = new oop();
@$bayar = $_POST['bayar'];

date_default_timezone_set('Asia/Jakarta');
$tgl = date('Y-m-d');

if (isset($_GET['beli'])) {
	$where = "kd_barang = '$_GET[kd]'";
	$data = $oop->selectWhere($con, "tbl_barang", $where);
	$stok = $data['stok_barang'];
}

if (isset($_GET['ganti_kd'])) {
	$cek_kode = mysqli_query($con, "select max(kd_transaksi) from daftar_transaksi");
	@$data = mysqli_fetch_array($cek_kode);
	if ($data) {
		$nilaikode = substr($data[0], 1);
		$kode = (int) $nilaikode;
		$kode = $kode + 1;
		$kode_otomatis = "T".str_pad($kode, 4, "0", STR_PAD_LEFT);
	} else {
		$kode_otomatis = "T0001";
	}

	$_SESSION['kd_trans'] = $kode_otomatis;
	echo "<script>document.location.href='?menu=transaksi&kd_trans=$kode_otomatis'</script>";
}

$table = "tbl_transaksi";
$link = "?menu=transaksi";

if (isset($_POST['tambah'])) {
	if (isset($_GET['beli'])) {
		if ($_POST['jumlah'] > $stok) {
			echo "<script>alert('Stok Barang Tidak Cukup')</script>";			
		}else{
			@$total_harga = $_POST['harga'] * $_POST['jumlah'];

			$isi = "kd_transaksi = '$_SESSION[kd_trans]', kd_barang = '$_GET[kd]', kd_user = '$_SESSION[kd_user]', jumlah_beli='$_POST[jumlah]', total_harga = '$total_harga'";

			$oop->insert($con, $table, $isi, $link);
		}
		
	}else{
		echo "<script>alert('Lengkapi Data!!')</script>";
	}
}

if (isset($_GET['hapus'])) {
	$where = "kd_transaksi = '$_GET[id]'";
	$oop->delete($con,$table,$where,$link);
}
?>

<body>
	<section class="forms"> 
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-5">
					<div class="card">
						<div class="card-header d-flex align-items-center">
							<h3 class="h4">Transaksi</h3>
						</div>
						<div class="card-body">
							<form method="post">
								<div class="row">
									<div class="form-group col-lg-8" style="padding-left: 17px;">
										<label class="form-control-label">Barang</label>
										<input type="text" name="nama_barang" class="form-control" value="<?= @$data['nama_barang'] ?>" required readonly>
									</div>
									<div class="col-lg-4">
										<div class="form-group">
											<button type="button" data-toggle="modal" data-target="#myModal" class="btn btn-info col-lg-12" style="margin-top: 30px;">Pilih</button>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="form-control-label">Harga</label>
									<input type="number" name="harga" class="form-control" value="<?= $data['harga_barang'] ?>" required readonly>
								</div>
								<div class="form-group">
									<label class="form-control-label">Jumlah Beli</label>
									<input type="number" name="jumlah" class="form-control" min="1" required>
								</div>
								<button type="submit" class="btn btn-primary" name="tambah"><i class="fa fa-plus-square"> </i> Tambah</button>
							</form>
						</div>
					</div>
				</div>
				<!-- Keranjang -->
				<div class="col-lg-7">
					<div class="card">
						<div class="card-header d-flex align-items-center">
							<h3 class="h4">Keranjang</h3>
						</div>
						<div class="card-body">
							<form method="post">
								<div class="row">
									<div class="table-responsive">
										<table class="table table-striped tables-bordered" style="width:100%">
											<thead>
												<tr>
													<th>Nama Barang</th>
													<th>Username</th>
													<th>Harga</th>
													<th>Jumlah Beli</th>
													<th>Total Harga</th>
													<th>Delete</th>
												</tr>
											</thead>
											<tbody>
												<?php
												$cek = $_SESSION['kd_trans'];
												$query = mysqli_query($con, "SELECT * FROM daftar_transaksi WHERE kd_transaksi = '$cek'");
												while ($row = mysqli_fetch_array($query)){ ?>
													<tr>
														<td><?= @$row['nama_barang'] ?></td>
														<td><?= @$row['username'] ?></td>
														<td><?= @$row['harga_barang'] ?></td>
														<td><?= @$row['jumlah_beli'] ?></td>
														<td><?= @$row['total_harga'] ?></td>
														<td><a href="?menu=transaksi&hapus&id=<?= @$row['kd_transaksi'] ?>" onclick="return confirm('Anda Yakin Akan Menghapusnya?')"><i class="fa fa-trash text-danger" style="font-size: 18pt;"></i></a></td>
													</tr>
													<?php } ?>
											</tbody>
											<?php 
												$sql = mysqli_query($con, "SELECT SUM(total_harga) FROM tbl_transaksi WHERE kd_transaksi = '$cek'");
												$sum = mysqli_fetch_array($sql);
											 ?>
											<tfoot>
												<tr class="bg-info" style="color: white">
													<th colspan="4" class="text-right">Grand Total</th>
													<th><?= $sum[0] ?></th>
													<th></th>
												</tr>
											</tfoot>
										</table>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
				<!-- Pembelian -->
				<div class="col-lg-5">
					<div class="card">
						<div class="card-header d-flex align-items-center">
							<h3 class="h4">Pembayaran</h3>
						</div>
						<div class="card-body">
							<form method="post">
									<div class="form-group">
										<label class="form-control-label">Grand Total</label>
										<input type="text" class="form-control" name="grand_total" value="<?= $sum[0] ?>" readonly>
									</div>
									<div class="form-group">
										<label class="form-control-label">Bayar</label>
										<input type="number" class="form-control" name="bayar" min="0" required value="<?= @$bayar ?>">
									</div>
									<div class="form-group text-right">
										<?php if (@$sum[0] == ""): ?>
											<button type="submit" class="btn btn-info" disabled>
												<i class="fa fa-shopping-cart"> </i> Pembelian
											</button>
										<?php else: ?>
											<button type="submit" class="btn btn-info" name="beli">
												<i class="fa fa-shopping-cart"> </i> Pembelian
											</button>
										<?php endif ?>
									</div>
									<?php 
										if (isset($_POST['beli'])) {
											$_SESSION['grand_total'] = $_POST['grand_total'];
											$_SESSION['bayar'] = $_POST['bayar'];

											$isi_update = "tanggal_beli = '$tgl'";
											$where_update = "kd_transaksi = '$_SESSION[kd_trans]'";
											$query = mysqli_query($con, "UPDATE tbl_transaksi SET $isi_update WHERE $where_update");

											if ($bayar < $_SESSION['grand_total']) {
												echo "<script>alert('Uang anda kurang !!');document.location.href='?menu=transaksi'</script>";
											}else{
												$kembali = $bayar - $_SESSION['grand_total'];
												?>
												<div class="form-group">
													<label class="form-control-label">Kembalian</label>
													<input type="number" class="form-control" name="kembali" value="<?= @$kembali ?>" readonly>
												</div>
												<div class="form-group text-right">
													<a href="struk.php" name="cetak" class="btn btn-success" target="output">
														<i class="fa fa-check-square-o"></i> Cetak Struk
													</a>
												</div>
									<?php	}
										}
									 ?>
							</form>
						</div>
						<div class="card-footer" style="text-align: center;">
							<a href="?menu=transaksi&ganti_kd" class="btn btn-danger col-md-5	" name="selesai" onclick="return confirm('Anda Yakin ??')">
								<i class="fa fa-trash"></i> Reset
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Modal -->
	<div id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
		<div role="document" class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 id="exampleModalLabel" class="modal-title">Signin Modal</h4>
					<button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
				</div>
				<div class="modal-body">
					<form>
						<table class="table table-striped tables-bordered" style="width:100%">
							<thead>
								<tr>
									<th>Nama Barang</th>
									<th>Merk</th>
									<th>Harga</th>
									<th>Stok</th>
									<th>Gambar</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$tampil = $oop->selectAll($con, "daftar_barang");
								foreach ($tampil as $row) { ?>
								<tr>
									<td><a href="?menu=transaksi&beli&kd=<?= @$row['kd_barang'] ?>"><?= @$row['nama_barang'] ?></a></td>
									<td><?= @$row['merek'] ?></td>
									<td><?= @$row['harga_barang'] ?></td>
									<td><?= @$row['stok_barang'] ?></td>
									<td><img src="../foto/<?= @$row['gambar'] ?>" width="80px;"></td>
								</tr>
								<?php }?>
							</tbody>
						</table>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" data-dismiss="modal" class="btn btn-secondary">Close</button>
				</div>
			</div>
		</div>
	</div>
</body>
</html>