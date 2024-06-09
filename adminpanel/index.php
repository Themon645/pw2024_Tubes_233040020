<?php
require "session.php";
require "../koneksi.php";

$queryKategori = mysqli_query($con, "SELECT * FROM kategori");
$jumlahKategori = mysqli_num_rows($queryKategori);

$queryProduk = mysqli_query($con, "SELECT * FROM produk");
$jumlahProduk = mysqli_num_rows($queryProduk);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<style>
  .kotak {
    border: solid;
  }

  .elektronik-kategori {
    background-color: #4D648D;
    border-radius: 15px;
  }

  .elektronik-produk {
    background-color: #283655;
    border-radius: 15px;
  }

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
        <li class="breadcrumb-item active" aria-current="page"> <i class="fas fa-home"></i> Home</li>
      </ol>
    </nav>
    <h2>Halo <?php echo $_SESSION['username']; ?></h2>

    <div class="container mt-5">
      <div class="row">
        <div class="col-lg-4 col-md-6 col-12 mb-3">
          <div class="elektronik-kategori p-3">
            <div class="row d-flex justify-content-between align-items-center">
              <div class="col-6 d-flex justify-content-center">
                <i class="bi bi-border-width text-white" style="font-size: 100px;"></i>
              </div>
              <div class="col-6 text-white">
                <h3 class="fs-2">kategori</h3>
                <p class="fs-4"><?php echo $jumlahKategori ?> Kategori</p>
                <p><a href="kategori.php" class="text-white">Lihat Detail</a></p>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 col-12 mb-3">
          <div class=" elektronik-produk p-3">
            <div class="row d-flex justify-content-between align-items-center">
              <div class="col-6 d-flex justify-content-center">
                <i class="bi bi-box2-fill text-white" style="font-size: 100px;"></i>
              </div>
              <div class="col-6 text-white">
                <h3 class="fs-2">Produk</h3>
                <p class="fs-4"><?php echo $jumlahProduk ?> Produk</p>
                <p><a href="kategori.php" class="text-white">Lihat Detail</a></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>