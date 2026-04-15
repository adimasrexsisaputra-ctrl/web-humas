<?php
include 'koneksi/koneksi.php';

$id = $_GET['id'];

// ambil gambar
$data = mysqli_query($conn,"SELECT * FROM berita WHERE id=$id");
$d = mysqli_fetch_assoc($data);

// hapus file
if($d['gambar']){
  unlink("uploads/".$d['gambar']);
}

// hapus database
mysqli_query($conn,"DELETE FROM berita WHERE id=$id");

header("Location: admin.php");