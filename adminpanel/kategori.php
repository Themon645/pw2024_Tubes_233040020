<?php
require "../adminpanel/session.php";
require "../koneksi.php";

$queryKategori = mysqli_query($con, "SELECT * FROM kategori");
$jumlahKategori = mysqli_num_rows($queryKategori);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kategori</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"></head>
<style>
  .no-decoration {
    text-decoration: none;
  }
</style>

<body>
  <?php
  require "navbar.php"; ?>
  <div class="container mt-5">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page"><a href="../adminpanel" class="no-decoration text-muted"> <i class="fas fa-home"></i> Home</a></li>
        <li class="breadcrumb-item active" aria-current="page"> Kategori</li>
      </ol>
    </nav>

    <div class="my-5 col-12 col-md-6" >
      <h3>Tambah Kategori</h3>
      <form action="" method="post">
        <div>
            <label for="kategori">kategori</label>
            <input type="text" class="form-control" name="kategori" id="kategori" placeholder="input nama kategori" class="form-control">
        </div>
        <div class="mt-3">
            <button class="btn btn-primary" type="submit" name="tambahkategori">Tambah</button>
      </form>

      <?php
      if (isset($_POST['tambahkategori'])) {
        $kategori = htmlspecialchars($_POST['kategori']);
        $queryExits = mysqli_query($con, "SELECT nama FROM kategori WHERE nama = '$kategori'");
        $jumlahdatakategoribaru = mysqli_num_rows($queryExits);

        if($jumlahdatakategoribaru > 0){
          ?>
          <div class="alert alert-warning mt-3" role="alert">
            Kategori Sudah Ada
          </div>
          <?php 
      }
      else{
        $queryInsert = mysqli_query($con, "INSERT INTO kategori (NAMA) VALUES ('$kategori')");
        if ($queryInsert) {
          ?>
          <div class="alert alert-success mt-3" role="alert">
            Kategori Berhasil Ditambahkan
          </div>
          <meta http-equiv="refresh" content="1;url=http:kategori.php">
        <?php
        } else {
          echo mysqli_error($con);

        }
      }
    }

      ?>
    </div>

    <div class="mt-3">
      <h2>List Kategori</h2>

      <div class="table-responsive mt-5">
        <table class="table">
          <thead>
            <tr>
              <th>No.</th>
              <th>Nama</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if ($jumlahKategori == 0) {
            ?>
              <tr>
                <td colspan=3 class="text-center">Data Kategori Tidak Tersedia</td>
              </tr>
              <?php
            } else {
              $jumlah = 1;
              while ($data = mysqli_fetch_array($queryKategori)) {
              ?>
                <tr>
                  <td><?php echo $jumlah; ?></td>
                  <td><?php echo $data['NAMA']; ?></td>
                  <td>
                    <a href="editkategori.php?id=<?php echo $data['ID']; ?>" class="bi bi-pencil-square fs-3"><i class="fas fa-search"></i></a>
                  </td>
                </tr>

            <?php
                $jumlah++;
              }
            }

            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

</body>
<script src="../bootstrap/js/bootstrap.bundle.min.js"></script>

</html>