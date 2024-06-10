<?php
require "session.php";
require "../koneksi.php";

$id = $_GET['id'];

$query = mysqli_query($con, "SELECT * FROM kategori WHERE id = '$id'");
$data = mysqli_fetch_array($query);
?>

<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Detail Kategori</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"></head>

<body>
  <?php
  require "navbar.php"; ?>
  <div class="container mt-5">
    <h2>Detail Kategori</h2>

    <div class="col-12 col-md-6">
      <form action="" method="post">
        <div>
          <label for="kategori">Kategori</label>
          <input type="text" name="kategori" id="kategori" class="form-control" value="<?php echo $data['NAMA']; ?>">
        </div>

        <div class="mt-5 d-flex justify-content-between">
          <button type="submit" class="btn btn-primary" name="editkategori">Edit</button>
          <button type="submit" class="btn btn-danger" name="delete">Delete</button>
        </div>
    </div>
    </form>
    <?php
    if (isset($_POST['editkategori'])) {
      $kategori = htmlspecialchars($_POST['kategori']);

      if ($data['NAMA'] == $kategori) {
    ?>
        <meta http-equiv="refresh" content="0;url=http:kategori.php">
        </meta>
        <?php

      } else {
        $query = mysqli_query($con, "SELECT * FROM kategori WHERE nama = '$kategori'");
        $jumlahdatakategoribaru = mysqli_num_rows($query);

        if ($jumlahdatakategoribaru > 0) {
        ?>
          <div class="alert alert-warning mt-3" role="alert">
            Kategori Sudah Ada
          </div>
          <?php
        } else {
          $queryInsert = mysqli_query($con, "UPDATE kategori SET NAMA = '$kategori' WHERE id = '$id'");
          if ($queryInsert) {
          ?>
            <div class="alert alert-success mt-3" role="alert">
              Kategori Berhasil Diupdate
            </div>
            <meta http-equiv="refresh" content="2;url=http:kategori.php">
        <?php
          } else {
            echo mysqli_error($con);
          }
        }
      }
    }
    if (isset($_POST['delete'])) {
      $queryCheck = mysqli_query($con, "SELECT * FROM produk WHERE kategori_id = '$id'");
      $dataCount = mysqli_num_rows($queryCheck);

      if ($dataCount > 0) {
        ?>
        <div class="alert alert-danger mt-3" role="alert">
          Kategori Tidak Bisa Dihapus Karena Masih Terdapat Produk
        </div>
      <?php
        die();
      }

      $queryDelete = mysqli_query($con, "DELETE FROM kategori WHERE id = '$id'");
      if ($queryDelete) {
      ?>
        <div class="alert alert-primary mt-3" role="alert">
          Kategori Berhasil Dihapus
        </div>
        <meta http-equiv="refresh" content="1;url=http:kategori.php">
    <?php
      } else {
        echo mysqli_error($con);
      }
    }


    ?>

  </div>
  </div>

</body>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</html>