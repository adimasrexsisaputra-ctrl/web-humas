<?php 
session_start(); 
if(!$_SESSION['login']){header("Location: login.php");} 
include 'koneksi/koneksi.php'; 
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard Admin</title>

<style>
body {
  font-family: 'Segoe UI', sans-serif;
  margin: 0;
  background: #f1f5f9;
}

/* Navbar */
header {
  background: #1e40af;
  color: white;
  padding: 15px 30px;
  display: flex;
  justify-content: space-between;
}

header a {
  color: white;
  text-decoration: none;
}

/* Notifikasi */
.notif {
  background: #22c55e;
  color: white;
  padding: 15px;
  text-align: center;
  font-weight: bold;
}

/* Container */
.container {
  max-width: 1000px;
  margin: auto;
  padding: 20px;
}

/* Card */
.card {
  background: white;
  padding: 20px;
  margin-bottom: 20px;
  border-radius: 15px;
  box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

/* Input */
input, textarea, select {
  width: 100%;
  padding: 10px;
  margin-top: 10px;
  border-radius: 10px;
  border: 1px solid #ccc;
}

/* Button */
button {
  margin-top: 10px;
  padding: 12px;
  background: #2563eb;
  color: white;
  border: none;
  border-radius: 10px;
  cursor: pointer;
}

button:hover {
  background: #1e40af;
}

/* Table */
table {
  width: 100%;
  border-collapse: collapse;
}

table th, table td {
  padding: 10px;
  border-bottom: 1px solid #ddd;
}

.badge {
  background: #22c55e;
  color: white;
  padding: 5px 10px;
  border-radius: 5px;
}

.action a {
  margin-right: 10px;
  text-decoration: none;
  color: #2563eb;
}
</style>
</head>

<body>

<header>
  <h2>Dashboard Admin</h2>
  <a href="logout.php">Logout</a>
</header>

<!-- ✅ NOTIFIKASI -->
<?php if(isset($_GET['msg']) && $_GET['msg']=='success'){ ?>
  <div class="notif">✅ Tentang Kami berhasil diupdate!</div>
<?php } ?>

<div class="container">

  <!-- FORM BERITA -->
  <div class="card">
    <h3>Tambah Berita</h3>
    <form action="upload.php" method="POST" enctype="multipart/form-data">
      <input type="text" name="judul" placeholder="Judul Berita" required>

      <select name="kategori">
        <option>Umum</option>
        <option>Kegiatan</option>
        <option>Pengumuman</option>
      </select>

      <textarea name="isi" placeholder="Isi berita..." rows="5"></textarea>

      <input type="file" name="gambar">

      <button>Upload Berita</button>
    </form>
  </div>

  <!-- DATA BERITA -->
  <div class="card">
    <h3>Data Berita</h3>

    <table>
      <tr>
        <th>No</th>
        <th>Judul</th>
        <th>Kategori</th>
        <th>Aksi</th>
      </tr>

      <?php
      $no=1;
      $data=mysqli_query($conn,"SELECT * FROM berita ORDER BY id DESC");

      if($data){
        while($d=mysqli_fetch_assoc($data)){
      ?>

      <tr>
        <td><?= $no++ ?></td>
        <td><?= $d['judul'] ?></td>
        <td><span class="badge"><?= $d['kategori'] ?></span></td>
        <td class="action">
          <a href="edit.php?id=<?= $d['id'] ?>">Edit</a>
          <a href="hapus.php?id=<?= $d['id'] ?>" onclick="return confirm('Yakin hapus?')">Hapus</a>
        </td>
      </tr>

      <?php 
        }
      } else {
        echo "<tr><td colspan='4'>Data tidak ada</td></tr>";
      }
      ?>
    </table>
  </div>

  <!-- TENTANG KAMI -->
  <div class="card">
    <h3>Tentang Kami</h3>

    <?php
    $tentang = mysqli_query($conn,"SELECT * FROM tentang LIMIT 1");
    $t = mysqli_fetch_assoc($tentang);
    ?>

    <form action="upload_tentang.php" method="POST" enctype="multipart/form-data">

      <input type="text" name="judul" 
        value="<?= $t['judul'] ?? '' ?>" 
        placeholder="Judul">

      <textarea name="isi" rows="5"><?= $t['isi'] ?? '' ?></textarea>

      <?php if(!empty($t['gambar'])){ ?>
        <img src="uploads/<?= $t['gambar'] ?>" width="150"><br>
      <?php } ?>

      <input type="file" name="gambar">

      <button>Simpan / Update</button>
    </form>

  </div>

</div>

<!-- AUTO HILANG -->
<script>
setTimeout(() => {
  let notif = document.querySelector('.notif');
  if(notif){
    notif.style.display = 'none';
  }
}, 3000);
</script>

</body>
</html>