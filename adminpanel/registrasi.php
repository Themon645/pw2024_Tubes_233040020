<?php
session_start();
require "../koneksi.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registrasi</title>
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
</head>
<style>
  .main {
    height: 100vh;
  }

  .login-box {
    width: 500px;
    box-sizing: border-box;
    border-radius: 10px;
  }
</style>

<body>
  <div class="main d-flex flex-column justify-content-center align-items-center">
    <div class="login-box p-5 shadow">
      <form action="" method="post">
        <div>
          <label for="username">Username</label>
          <input type="text" class="form-control" name="username" id="username" required>
        </div>
        <div>
          <label for="password">Password</label>
          <input type="password" class="form-control" name="password" id="password" required>
        </div>
        <div>
          <label for="password2">Konfirmasi Password</label>
          <input type="password" class="form-control" name="password2" id="password2" required>
        </div>
        <div>
          <button type="submit" class="btn btn-success form-control mt-3" name="regisbtn">Registrasi</button>
        </div>
        <div class="mt-3">
          <h6>Login Akun <a href="login.php">login</a></h6>
        </div>
      </form>
    </div>

    <div class="mt-3" style="width: 500px">
      <?php
      if (isset($_POST['regisbtn'])) {
        $username = htmlspecialchars($_POST['username']);
        $password = htmlspecialchars($_POST['password']);
        $password2 = htmlspecialchars($_POST['password2']);

        if (!$con) {
          die("Connection failed: " . mysqli_connect_error());
        }

        // Check username sudah terdaftar atau belum
        $result = mysqli_query($con, "SELECT username FROM users WHERE username = '$username'");
        if (mysqli_fetch_assoc($result)) {
          echo '<div class="alert alert-warning" role="alert">Username sudah terdaftar</div>';
        } else if ($password !== $password2) {
          echo '<div class="alert alert-danger" role="alert">Password tidak sesuai</div>';
        } else {
          // enkripsi password
          $password = password_hash($password, PASSWORD_DEFAULT);

          // menambah username baru ke database
          $query = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
          if (mysqli_query($con, $query)) {
            echo '<div class="alert alert-success" role="alert">Registrasi berhasil</div>';
          } else {
            echo '<div class="alert alert-danger" role="alert">Registrasi gagal: ' . mysqli_error($con) . '</div>';
          }
        }
      }
      ?>
    </div>
  </div>
</body>

</html>