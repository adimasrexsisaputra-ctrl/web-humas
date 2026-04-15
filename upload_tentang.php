<?php 
include 'koneksi.php';

$judul = $_POST['judul'];
$isi = $_POST['isi'];

$gambar = $_FILES['gambar']['name'];
$tmp = $_FILES['gambar']['tmp_name'];

// cek apakah sudah ada data
$cek = mysqli_query($conn,"SELECT * FROM tentang LIMIT 1");
$data = mysqli_fetch_assoc($cek);

if($data){
  // 🔥 UPDATE (replace)
  
  // hapus gambar lama
  if($data['gambar']){
    unlink("uploads/".$data['gambar']);
  }

  // upload gambar baru
  move_uploaded_file($tmp, "uploads/".$gambar);

  mysqli_query($conn,"UPDATE tentang SET 
    judul='$judul',
    isi='$isi',
    gambar='$gambar'
    WHERE id=".$data['id']);

} else {
  // 🆕 INSERT pertama kali
  move_uploaded_file($tmp, "uploads/".$gambar);

  mysqli_query($conn,"INSERT INTO tentang VALUES(null,'$judul','$isi','$gambar')");
}

header("Location: admin.php?update=success");
exit;
?>