<?php include 'koneksi/koneksi.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Portal Humas</title>

<style>
body {
  margin: 0;
  font-family: 'Segoe UI', sans-serif;
  background: #f1f5f9;
}

/* HEADER */
header {
  position: absolute;
  width: 100%;
  padding: 15px 30px;
  display: flex;
  justify-content: space-between;
  color: white;
}

/* HERO */
.hero {
  height: 100vh;
  background: url('https://picsum.photos/1600/900') center/cover;
  display: flex;
  align-items: center;
  justify-content: center;
  position: relative;
  color: white;
}

.hero::before {
  content:"";
  position:absolute;
  width:100%;
  height:100%;
  background:rgba(0,0,0,0.5);
}

.hero-content {
  position: relative;
  text-align: center;
}

.hero h1 {
  font-size: 60px;
}

.hero span {
  color: #ff4d4d;
}

.btn {
  padding: 12px 25px;
  margin: 10px;
  border-radius: 30px;
  border: none;
  cursor: pointer;
}

.btn-outline {
  background: transparent;
  border: 2px solid white;
  color: white;
}

/* SECTION */
section {
  padding: 60px 20px;
}

.section-title {
  text-align: center;
  font-size: 32px;
}

.section-title::after {
  content:"";
  width:60px;
  height:4px;
  background:#2563eb;
  display:block;
  margin:10px auto;
}

/* TENTANG */
.tentang-box {
  display:flex;
  gap:30px;
  max-width:1000px;
  margin:auto;
  background:white;
  padding:30px;
  border-radius:20px;
  box-shadow:0 10px 25px rgba(0,0,0,0.1);
}

.tentang-box img {
  width:300px;
  border-radius:15px;
}

/* BERITA */
.container {
  max-width:1100px;
  margin:auto;
}

.berita-grid {
  display:grid;
  grid-template-columns:repeat(auto-fit,minmax(280px,1fr));
  gap:20px;
}

.card {
  background:white;
  border-radius:15px;
  overflow:hidden;
  box-shadow:0 10px 20px rgba(0,0,0,0.1);
  transition:0.3s;
}

.card:hover {
  transform:translateY(-10px);
}

.card img {
  width:100%;
  height:200px;
  object-fit:cover;
}

.card-content {
  padding:15px;
}

.badge {
  background:#2563eb;
  color:white;
  padding:5px 10px;
  border-radius:5px;
  font-size:12px;
}

.readmore {
  color:#2563eb;
  text-decoration:none;
  font-weight:bold;
}

/* FLOAT WA */
.wa {
  position: fixed;
  bottom: 20px;
  right: 20px;
  background: #25D366;
  color: white;
  padding: 15px;
  border-radius: 50%;
  text-decoration: none;
  font-size: 20px;
}
</style>

<script>
function scrollTentang(){
  document.getElementById("Tentang").scrollIntoView({behavior:"smooth"});
}
function scrollBerita(){
  document.getElementById("berita").scrollIntoView({behavior:"smooth"});
}
</script>

</head>
<body>

<header>
  <h2>Humas</h2>
</header>

<!-- HERO -->
<div class="hero">
  <div class="hero-content">
    <h1>Portal <span>Humas</span></h1>
    <p>Pemerintahan Bersih & Transparan</p>

    <button class="btn btn-outline" onclick="scrollTentang()">Tentang</button>
    <button class="btn btn-outline" onclick="scrollBerita()">Berita</button>
  </div>
</div>

<!-- TENTANG -->
<section id="Tentang">
<h2 class="section-title">Tentang Kami</h2>

<?php
$tentang = mysqli_query($conn,"SELECT * FROM tentang LIMIT 1");
if($t = mysqli_fetch_assoc($tentang)){
?>

<div class="tentang-box">
  <img src="uploads/<?= $t['gambar'] ?>">

  <div>
    <h3><?= $t['judul'] ?></h3>
    <p><?= $t['isi'] ?></p>
  </div>
</div>

<?php } ?>
</section>

<!-- BERITA -->
<section id="berita">
<h2 class="section-title">Berita Terkini</h2>

<div class="container">
<div class="berita-grid">

<?php
$data = mysqli_query($conn,"SELECT * FROM berita ORDER BY id DESC");

while($d=mysqli_fetch_assoc($data)){
?>

<div class="card">
  <img src="uploads/<?= $d['gambar'] ?>">

  <div class="card-content">
    <span class="badge"><?= $d['kategori'] ?></span>
    <h3><?= $d['judul'] ?></h3>
    <p><?= substr($d['isi'],0,80) ?>...</p>

    <a class="readmore" href="detail.php?id=<?= $d['id'] ?>">
      Baca →
    </a>
  </div>
</div>

<?php } ?>

</div>
</div>
</section>

<!-- WA BUTTON -->
<a class="wa" href="https://wa.me/+6285366211103">💬</a>

</body>
</html>