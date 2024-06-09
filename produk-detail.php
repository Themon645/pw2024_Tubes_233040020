<?php
require "./koneksi.php";

$nama =  htmlspecialchars($_GET['nama']);
$queryProduk = mysqli_query($con, "SELECT *  FROM produk WHERE nama = '$nama'");
$produk = mysqli_fetch_array($queryProduk);

$queryProdukTerkait = mysqli_query($con, "SELECT *  FROM produk WHERE kategori_id = '$produk[KATEGORI_ID]'AND id!='$produk[ID]' LIMIT 4");

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ElektroShop | Detail Produk</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">  <link rel="stylesheet" href="./css/style.css">

</head>

<body>
  <?php
  require "navbar.php"; ?>

  <!-- detail produk -->
  <div class="container-fluid py-5">
    <div class="container">
      <div class="row">
        <div class="col-lg-5 mb-5 ">
          <img src="./img/<?php echo $produk['FOTO']; ?>" class="w-100 " alt="">
        </div>
        <div class="col-lg-6 offset-lg-1">
          <h1><?php echo $produk['NAMA']; ?></h1>
          <p class="fs-5">
            <?php echo $produk['DETAIL']; ?>
          </p>
          <p class="text-harga">
            Rp.<?php echo $produk['HARGA']; ?>
          </p>
          <p class="fs-5">
            Status Ketersediaan : <strong><?php echo $produk['KETERSEDIAAN_STOK']; ?></strong>
          </p>
        </div>
      </div>
    </div>
  </div>

  <!-- produk terkait -->
  <div class="container-fluid py-5 warna2">
    <div class="container">
      <h2 class="text-center text-white mb-5">Produk Terkait</h2>

      <div class="row">
        <?php while ($data = mysqli_fetch_array($queryProdukTerkait)) { ?>
          <div class="col-md-6 col-lg-3 mb-3 ">
            <a href="produk-detail.php?nama=<?php echo $data['NAMA'] ?>">
            <img src="./img/<?php echo $data['FOTO'] ?>" class="img-fluid img-thumbnail produk-terkait-img" alt="">
            </a>
          </div>
        <?php } ?>
      </div>
    </div>
  </div>

    <!-- footer -->
    <?php require "./footer.php"; ?>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>        <script src="./fontawesome/js/all.min.js"></script>
</body>

</html>