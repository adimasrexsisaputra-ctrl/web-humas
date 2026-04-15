<?php include 'koneksi/koneksi.php'; ?>
<?php
$id = $_GET['id'];
$data = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM berita WHERE id=$id"));

if(isset($_POST['update'])){
  $judul = $_POST['judul'];
  $isi = $_POST['isi'];
  $kategori = $_POST['kategori'];

  $gambar = $_FILES['gambar']['name'];
  $tmp = $_FILES['gambar']['tmp_name'];

  if($gambar){
    // hapus gambar lama
    if($data['gambar']){
      unlink("uploads/".$data['gambar']);
    }

    // upload gambar baru
    move_uploaded_file($tmp,"uploads/".$gambar);

    mysqli_query($conn,"UPDATE berita SET 
      judul='$judul',
      isi='$isi',
      kategori='$kategori',
      gambar='$gambar'
      WHERE id=$id");

  } else {
    // kalau tidak ganti gambar
    mysqli_query($conn,"UPDATE berita SET 
      judul='$judul',
      isi='$isi',
      kategori='$kategori'
      WHERE id=$id");
  }

  header("Location: admin.php?msg=edit");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Edit Berita</title>

<style>
body {
  font-family: 'Segoe UI';
  background: #f1f5f9;
}

/* Container */
.container {
  max-width: 600px;
  margin: 50px auto;
}

/* Card */
.card {
  background: white;
  padding: 30px;
  border-radius: 15px;
  box-shadow: 0 10px 25px rgba(0,0,0,0.1);
}

h2 {
  text-align: center;
}

/* Input */
input, textarea, select {
  width: 100%;
  padding: 12px;
  margin-top: 10px;
  border-radius: 10px;
  border: 1px solid #ccc;
}

/* Button */
button {
  width: 100%;
  padding: 12px;
  margin-top: 15px;
  background: #2563eb;
  color: white;
  border: none;
  border-radius: 10px;
  cursor: pointer;
}

button:hover {
  background: #1e40af;
}

/* Image preview */
.preview {
  margin-top: 10px;
  text-align: center;
}

.preview img {
  max-width: 100%;
  border-radius: 10px;
}

/* Back */
.back {
  text-decoration: none;
  color: #2563eb;
}
</style>

</head>

<body>

<div class="container">
  <div class="card">

    <a href="admin.php" class="back">← Kembali</a>

    <h2>Edit Berita</h2>

    <form method="POST" enctype="multipart/form-data">

      <input name="judul" value="<?= $data['judul']; ?>">

      <select name="kategori">
        <option <?= $data['kategori']=='Umum'?'selected':'' ?>>Umum</option>
        <option <?= $data['kategori']=='Kegiatan'?'selected':'' ?>>Kegiatan</option>
        <option <?= $data['kategori']=='Pengumuman'?'selected':'' ?>>Pengumuman</option>
      </select>

      <textarea name="isi" rows="6"><?= $data['isi']; ?></textarea>

      <!-- Gambar lama -->
      <div class="preview">
        <p>Gambar Saat Ini:</p>
        <img src="uploads/<?= $data['gambar']; ?>">
      </div>

      <!-- Upload baru -->
      <input type="file" name="gambar" onchange="previewImage(event)">

      <!-- Preview gambar baru -->
      <div class="preview">
        <p>Preview Gambar Baru:</p>
        <img id="preview">
      </div>

      <button name="update">💾 Update Berita</button>

    </form>

  </div>
</div>

<script>
function previewImage(event){
  const input = event.target;
  const preview = document.getElementById('preview');

  if(input.files && input.files[0]){
    const reader = new FileReader();
    reader.onload = function(e){
      preview.src = e.target.result;
    }
    reader.readAsDataURL(input.files[0]);
  }
}
</script>

</body>
</html>