<?php 
session_start(); 
include 'koneksi/koneksi.php'; 

$error = "";

if(isset($_POST['login'])){
  $user = $_POST['username'];
  $pass = $_POST['password'];

  $cek = mysqli_query($conn,"SELECT * FROM admin WHERE username='$user' AND password='$pass'");

  if($cek && mysqli_num_rows($cek) > 0){
    $_SESSION['login'] = true;
    header("Location: admin.php");
  } else { 
    $error = "Username atau Password salah!";
  }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login Admin</title>

<style>
body {
  margin: 0;
  font-family: 'Segoe UI', sans-serif;
  background: linear-gradient(135deg, #2563eb, #1e3a8a);
  height: 100vh;
  display: flex;
  justify-content: center;
  align-items: center;
}

.login-box {
  background: white;
  padding: 40px;
  border-radius: 15px;
  width: 300px;
  box-shadow: 0 10px 25px rgba(0,0,0,0.2);
  text-align: center;
}

.login-box h2 {
  margin-bottom: 20px;
}

input {
  width: 100%;
  padding: 12px;
  margin: 10px 0;
  border-radius: 10px;
  border: 1px solid #ccc;
}

button {
  width: 100%;
  padding: 12px;
  background: #2563eb;
  color: white;
  border: none;
  border-radius: 10px;
  cursor: pointer;
  font-size: 16px;
}

button:hover {
  background: #1e40af;
}

.error {
  color: red;
  margin-bottom: 10px;
}
</style>
</head>

<body>

<div class="login-box">
  <h2>Login Admin</h2>

  <?php if($error){ ?>
    <div class="error"><?php echo $error; ?></div>
  <?php } ?>

  <form method="POST">
    <input type="text" name="username" placeholder="Username" required>
    <input type="password" name="password" placeholder="Password" required>
    <button name="login">Login</button>
  </form>
</div>

</body>
</html>