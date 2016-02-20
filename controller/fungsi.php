<?php
	
	class Mahasiswa
	{
		public function View()
		{
			$sql = "SELECT * FROM tb_mahasiswa";
			$exe = mysql_query($sql);

			return $exe;
		}
		public function Create($nama, $nim, $jenjang)
		{
			$sql = "INSERT INTO `tb_mahasiswa` (`id`, `nama`, `nim`, `jenjang`) VALUES (NULL, '$nama', '$nim', '$jenjang');";
			$exe = mysql_query($sql);
            echo "<script>alert('Tambah data Berhasil!!!'); document.location.href='./index.php';</script>"; 

            return $exe;
		}
		public function ViewById($id)
		{
			$sql = "SELECT * FROM tb_mahasiswa WHERE id = $id";
			$exe = mysql_query($sql);

			return $exe;
		}
		public function Update($id ,$nama, $nim, $jenjang)
		{
			$sql = "UPDATE tb_mahasiswa SET `nama` = '$nama', `nim` = '$nim', `jenjang` = '$jenjang'";
			$exe = mysql_query($sql);
			if ($exe) {
				echo "<script>alert('Data Berhasil Di Ubah !'); document.location.href='./index.php';</script>";
			}else{
				echo "<script>alert('Data Gagal Di Ubah !'); document.location.href='./index.php';</script>";

			}
		}
		public function Delete($id)
		{
			$sql = "DELETE FROM tb_mahasiswa WHERE id = $id";
			$exe = mysql_query($sql);
			if ($exe) {
				echo "<script>alert('Data Berhasil Di Hapus !'); document.location.href='./index.php';</script>";
			}else{
				echo "<script>alert('Data Gagal Di Hapus !'); document.location.href='./index.php';</script>";

			}
		}
	}
?>