<?php
session_start();
require "../koneksi.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
</head>

<style>
  .main {
    height: 100vh;
  }

  .login-box {
    width: 500px;
    height: 300px;
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
          <button class="btn btn-success form-control mt-3" type="submit" name="loginbtn">Login</button>
        </div>
        <div class="mt-3">
          <h6>Registrasi akun <a href="registrasi.php">Registrasi</a></h6> 
        </div>
      </form>
    </div>
    <div class="mt-3" style="width: 500px">
      <?php
      if (isset($_POST['loginbtn'])) {
        $username = htmlspecialchars($_POST['username']);
        $password = htmlspecialchars($_POST['password']);

        $stmt = $con->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $countdata = $result->num_rows;
        $data = $result->fetch_assoc();

        if ($countdata > 0) {
          if (password_verify($password, $data['PASSWORD'])) { 
            $_SESSION['username'] = $data['USERNAME'];
            $_SESSION['login'] = true;
            header('Location: ../adminpanel/');
            exit;
          } else {
            echo '<div class="alert alert-danger" role="alert">Password salah</div>';
          }
        } else {
          echo '<div class="alert alert-warning" role="alert">Akun tidak terdaftar</div>';
        }

        $stmt->close();
        $con->close();
      }
      ?>
    </div>
  </div>
</body>
</html>
