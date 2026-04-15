<?php 
include 'koneksi/koneksi.php';

$id = $_GET['id'];

// ambil berita utama
$data = mysqli_query($conn,"SELECT * FROM berita WHERE id=$id");
$d = mysqli_fetch_assoc($data);

// ambil berita terkait (kategori sama)
$kategori = $d['kategori'];
$relasi = mysqli_query($conn,"SELECT * FROM berita WHERE kategori='$kategori' AND id!=$id LIMIT 3");
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title><?= $d['judul'] ?></title>

<style>
body{
  font-family:'Segoe UI';
  margin:0;
  background:#f1f5f9;
}

/* Container */
.container{
  max-width:900px;
  margin:40px auto;
  padding:20px;
}

/* Card */
.card{
  background:white;
  padding:25px;
  border-radius:15px;
  box-shadow:0 5px 15px rgba(0,0,0,0.1);
}

/* Gambar */
img{
  width:100%;
  border-radius:10px;
}

/* Badge */
.badge{
  background:#22c55e;
  color:white;
  padding:5px 10px;
  border-radius:5px;
}

/* Share */
.share{
  margin-top:15px;
}

.share a{
  text-decoration:none;
  background:#25D366;
  color:white;
  padding:10px 15px;
  border-radius:8px;
}

/* Related */
.related{
  margin-top:30px;
}

.grid{
  display:grid;
  grid-template-columns:repeat(auto-fit,minmax(250px,1fr));
  gap:15px;
}

.rel-card{
  background:white;
  padding:15px;
  border-radius:10px;
  box-shadow:0 3px 10px rgba(0,0,0,0.1);
}

.rel-card a{
  text-decoration:none;
  color:#2563eb;
}
</style>

</head>
<body>

<div class="container">

<div class="card">

<a href="index.php">← Kembali</a>

<h1><?= $d['judul'] ?></h1>

<p>
  <span class="badge"><?= $d['kategori'] ?></span> |
  <?= $d['tanggal'] ?>
</p>

<img src="uploads/<?= $d['gambar'] ?>">

<p><?= nl2br($d['isi']) ?></p>

<!-- SHARE -->
<div class="share">
  <a href="https://wa.me/?text=<?= urlencode($d['judul'].' - http://localhost/web-humas/detail.php?id='.$d['id']) ?>" target="_blank">
    📤 Share ke WhatsApp
  </a>
</div>

</div>

<!-- RELATED POST -->
<div class="related">
  <h2>Berita Terkait</h2>

  <div class="grid">
    <?php while($r=mysqli_fetch_assoc($relasi)){ ?>
    <div class="rel-card">
      <h4><?= $r['judul'] ?></h4>
      <a href="detail.php?id=<?= $r['id'] ?>">Baca →</a>
    </div>
    <?php } ?>
  </div>

</div>

</div>

</body>
</html>