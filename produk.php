<?php
require "./koneksi.php";
$querykategori = mysqli_query($con, "SELECT * FROM kategori");

//get produk by search
if (isset($_GET['keyword'])) {
  $queryProduk = mysqli_query($con, "SELECT * FROM produk WHERE nama LIKE '%$_GET[keyword]%'");
}
//get produk by kategori
else if (isset($_GET['kategori'])) {
  $queryGetKategoriId = mysqli_query($con, "SELECT id FROM kategori WHERE nama='$_GET[kategori]'");
  $kategoriId = mysqli_fetch_array($queryGetKategoriId);

  $queryProduk = mysqli_query($con, "SELECT * FROM produk WHERE kategori_id='$kategoriId[id]'");
}
//get produk by default
else {
  $queryProduk = mysqli_query($con, "SELECT * FROM produk");
}

$countData = mysqli_num_rows($queryProduk);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ElektroShop | Produk</title>
  <link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="./fontawesome/css/all.min.css">
  <link rel="stylesheet" href="./css/style.css">
</head>

<body>
  <?php require "./navbar.php"; ?>

  <!-- banner -->
  <div class="container-fluid banner2 d-flex align-items-center">
    <div class="container">
      <h1 class="text-white text-center">Produk</h1>
      <div class="col-md-8 offset-md-2">
        <form action="produk.php" method="get">
          <div class="input-group input-group-lg my-4">
            <input type="text" class="form-control" id="keyword2" placeholder="Nama Produk" aria-label="Recipient's username" aria-describedby="basic-addon2" name="keyword">
            <button type="submit" class="btn warna2 text-white" id="tombol-cari" type="button">Cari</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- produk -->
  <div class="container py-5">
    <div class="row">
      <div class="col-lg-3 mb-5">
        <h3>Kategori</h3>
        <ul class="list-group">
          <?php while ($kategori = mysqli_fetch_array($querykategori)) { ?>
            <a class="no-decoration" href="./produk.php?kategori=<?php echo $kategori['NAMA'] ?>">
              <li class="list-group-item"><?php echo $kategori['NAMA'] ?></li>
            </a>
          <?php } ?>
        </ul>
      </div>
      <div class="col-lg-9">
        <h3 class="text-center mb-3">Produk</h3>
        <div class="row" id="container2">
          <?php 
          if ($countData == 0) {
            ?>
            <h4 class="text-center my-5">Produk Yang Anda Cari Tidak Tersedia</h4>
            <?php
          }
          
          ?>

          <?php mysqli_data_seek($queryProduk, 0);
          while ($produk = mysqli_fetch_array($queryProduk)) {  ?>
            <div class="col-md-4 mb-4">
              <div class="card h-100">
                <div class="image-box">
                  <img src="./img/<?php echo $produk['FOTO'] ?>" class="card-img-top" alt="...">
                </div>
                <div class="card-body">
                  <h4 class="card-title"><?php echo $produk['NAMA'] ?></h4>
                  <p class="card-text text-truncate"><?php echo $produk['DETAIL'] ?></p>
                  <p class="card-text text-harga">Rp<?php echo $produk['HARGA'] ?></p>
                  <a href="./produk-detail.php?nama=<?php echo $produk['NAMA'] ?>" class="btn warna2 text-white">Lihat Detail</a>
                </div>
              </div>
            </div>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>

  <!-- footer -->
  <?php require "./footer.php"; ?>


  <script src="./bootstrap/js/bootstrap.min.js"></script>
  <script src="./fontawesome/js/all.min.js"></script>
  <script src="./js/script.js"></script>
</body>

</html>