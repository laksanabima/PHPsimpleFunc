<?php
	include 'config/koneksi.php';
	include 'controller/fungsi.php';

	$classMahasiswa = new Mahasiswa();

	function antiinjection($data){
	  $filter_sql = mysql_real_escape_string(htmlspecialchars($data,ENT_QUOTES));
	  return $filter_sql;
	}
	if (isset($_POST['tambah'])){
		$nama = antiinjection($_POST['nama']);
		$nim = antiinjection($_POST['nim']);
		$jenjang = antiinjection($_POST['jenjang']);

		$classMahasiswa->Create($nama, $nim, $jenjang);
	} 
	if (isset($_POST['ubah'])) {
		$id = $_GET['id'];
		$nama = antiinjection($_POST['nama']);
		$nim = antiinjection($_POST['nim']);
		$jenjang = antiinjection($_POST['jenjang']);

		$classMahasiswa->Update($id ,$nama, $nim, $jenjang);
	}
?>
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
	if (isset($_GET['action'])) {	
		if ($_GET['action'] == 'tambah') {
?>
	<form action="" method="post">
		<table align="center">
			<caption><h2>Tambah Mahasiswa</h2></caption>
			<tbody>
				<tr>
					<td>Nama</td>
					<td>:</td>
					<td><input type="text" name="nama" value="" placeholder=""></td>					
				</tr>
				<tr>
					<td>NIM</td>
					<td>:</td>
					<td><input type="text" name="nim" value="" placeholder=""></td>					
				</tr>
				<tr>
					<td>Jenjang</td>
					<td>:</td>
					<td><input type="text" name="jenjang" value="" placeholder=""></td>					
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td><input type="submit" name="tambah" value="Tambah"></td>					
				</tr>
			</tbody>
		</table>
	</form>
	<?php
	}
	elseif ($_GET['action'] == 'ubah' && isset($_GET['id'])) {
		$id = base64_decode($_GET['id']);
		$view = $classMahasiswa->ViewById($id);
		$row = mysql_fetch_array($view);
	?>
	<form action="" method="post">
		<table align="center">
			<caption><h2>Tambah Mahasiswa</h2></caption>
			<tbody>
				<tr>
					<td>Nama</td>
					<td>:</td>
					<td><input type="text" name="nama" value="<?=$row['nama']?>" placeholder=""></td>					
				</tr>
				<tr>
					<td>NIM</td>
					<td>:</td>
					<td><input type="text" name="nim" value="<?=$row['nim']?>" placeholder=""></td>					
				</tr>
				<tr>
					<td>Jenjang</td>
					<td>:</td>
					<td><input type="text" name="jenjang" value="<?=$row['jenjang']?>" placeholder=""></td>					
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td><input type="submit" name="ubah" value="Ubah"></td>					
				</tr>
			</tbody>
		</table>
	</form>
	<?php
	}
	elseif ($_GET['action']=='hapus' && isset($_GET['id'])) {
		$id = base64_decode($_GET['id']);
		$classMahasiswa->Delete($id);
	}
	}
	else{
	?>
		<hr />
		<p align="right"><a href="?action=tambah">Tambah Data Mahasiswa</a></p>
		<table align="center" width="90%" border = "1">
			<caption><h2>Daftar Mahasiswa</h2></caption>
			<thead>
				<tr>
					<th width="2%">No</th>
					<th>Nama</th>
					<th>NIM</th>
					<th>Jenjang</th>
					<th width="8%">Action</th>
				</tr>
			</thead>
			<tbody>
			<?php
				$no = 1;
				$tampil = $classMahasiswa->View();
				while ($row = mysql_fetch_array($tampil)) {
			?>
				<tr>				
					<td><?=$no++?></td>
					<td><?=$row['nama']?></td>
					<td><?=$row['nim']?></td>
					<td><?=$row['jenjang']?></td>
					<td>
						<a href = "?action=ubah&id=<?php echo base64_encode($row['id']); ?>">Ubah</a> | 
						<a href = "?action=hapus&id=<?php echo base64_encode($row['id']); ?>">Hapus</a></td>
				</tr>
			<?php
				}
			?>
			</tbody>
		</table>
		<?php
	}
		?>
</body>
</html>