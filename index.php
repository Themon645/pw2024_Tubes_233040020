<?php
require "./koneksi.php";
$queryProduk = mysqli_query($con, "SELECT id, nama, harga, foto, detail  FROM produk LIMIT 6");


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>TElektroShop | Home</title>
  <link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="./fontawesome/css/all.min.css">
  <link rel="stylesheet" href="./css/style.css">
</head>

<body>
  <?php
  require "navbar.php"; ?>

  <!-- banner -->
  <div class="container-fluid banner d-flex align-items-center">
    <div class="container text-center text-white">
      <h1>ElektroShop</h1>
      <br>
      <h5>Tempatnya Belanja Elektronik Terlengkap dan Termurah</h5>
      <div class="col-md-8 offset-md-2">
        <form action="produk.php" method="get">
          <div class="input-group input-group-lg my-4">
            <input type="text" class="form-control" placeholder="Nama Produk" aria-label="Recipient's username" aria-describedby="basic-addon2" name="keyword">
            <button type="submit" class="btn warna2 text-white" type="button">Cari</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- highlighted kategori -->
  <div class="container-fluid py-5">
    <div class="container text-center">
      <h3>Kategori Terlaris</h3>

      <div class="row mt-5">
        <div class="col-md-4 mb-3">
          <div class="highlighted-kategori kategori-Laptop d-flex justify-content-center align-items-center">
            <h4 class="text-white"><a class="no-decoration" href="produk.php?kategori=Laptop">Laptop</a></h4>
          </div>
        </div>
        <div class="col-md-4 mb-3">
          <div class="highlighted-kategori kategori-Xbox d-flex justify-content-center align-items-center">
            <h4 class="text-white"><a class="no-decoration" href="produk.php?kategori=Xbox">Xbox</a></h4>
          </div>
        </div>
        <div class="col-md-4 mb-3">
          <div class="highlighted-kategori kategori-Handphone d-flex justify-content-center align-items-center">
            <h4 class="text-white"><a class="no-decoration" href="produk.php?kategori=Handphone">Handphone</a></h4>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- tentang kami -->
  <div class="container-fluid warna3 py-5">
    <div class="container text-center text-white">
      <h3>Tentang kami</h3>
      <p class="fs-5 mt-3">
        "Toko kami adalah tempat di mana inovasi bertemu dengan kebutuhan.
        Dari gadget canggih hingga perangkat rumah pintar,
        kami menghadirkan teknologi terbaru untuk memperkaya hidup Anda.
        Temukan keajaiban elektronik di setiap sudut,
        dan biarkan kami menjadi mitra dalam perjalanan Anda menuju kenyamanan modern."
      </p>
    </div>
  </div>

  <!-- Produk -->
  <div class="container-fluid py-5">
    <div class="container  text-center">
      <h3>Produk</h3>

      <div class="row mt-5">
        <?php while ($data = mysqli_fetch_array($queryProduk)) { ?>
          <div class="col-sm-6 col-md-4 mb-3">
            <div class="card h-100">
              <div class="image-box">
                <img src="./img/<?php echo $data['foto']; ?>" class="card-img-top" alt="...">
              </div>
              <div class="card-body">
                <h4 class="card-title"><?php echo $data['nama'] ?></h4>
                <p class="card-text text-truncate"><?php echo $data['detail'] ?></p>
                <p class="card-text text-harga">Rp<?php echo $data['harga'] ?></p>
                <a href="./produk-detail.php?nama=<?php echo $data['nama'] ?>" class="btn warna2 text-white">Lihat Detail</a>
              </div>
            </div>
          </div>
        <?php } ?>
      </div>
    </div>
  </div>

  <!-- footer -->
  <?php require "./footer.php"; ?>


  <script src="./bootstrap/js/bootstrap.min.js"></script>
  <script src="./fontawesome/js/all.min.js"></script>
</body>

</html>