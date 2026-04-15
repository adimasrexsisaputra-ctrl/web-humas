<?php include 'koneksi/koneksi.php'; ?>
<?php
$judul=$_POST['judul'];
$isi=$_POST['isi'];
$kategori=$_POST['kategori'];
$tgl=date('Y-m-d');
$gambar=$_FILES['gambar']['name'];
$tmp=$_FILES['gambar']['tmp_name'];
move_uploaded_file($tmp,"uploads/".$gambar);

mysqli_query($conn,"INSERT INTO berita VALUES(null,'$judul','$isi','$gambar','$tgl','$kategori')");
header("Location: admin.php");
?>