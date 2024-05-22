<?php

session_start();
require "../koneksi.php";
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
          <input type="text" class="form-control" name="username" id="username">
        </div>
        <div>
          <label for="password">password</label>
          <input type="password" class="form-control" name="password" id="password">
        </div>
        <div>
          <button class="btn btn-success form-control mt-3" type="submit" name="loginbtn">Login</button>
        </div>
      </form>
    </div>
    <div class="mt-3" style="width: 500px">
      <?php
      if (isset($_POST['loginbtn'])) {
        $username = htmlspecialchars ($_POST['username']);
        $password = htmlspecialchars ($_POST['password']);

        $query = mysqli_query($con, "SELECT * FROM users WHERE username='$username'");
        $countdata = mysqli_num_rows($query);
        $data = mysqli_fetch_array($query);
        echo $data['USERNAME'];
        echo $data['PASSWORD'];
        
        if($countdata>0){
          if(password_verify($password, $data['PASSWORD'])) {
              echo "benar";
          }
          else{
            ?>
            <div class="alert alert-danger" role="alert">
              password salah
            </div>
            <?php
          }
        }
        else{
          ?>
          <div class="alert alert-danger" role="alert">
            akun tidak terdaftar
          </div>
          <?php
        }
      }
      ?>
    </div>
  </div>


</body>

</html>