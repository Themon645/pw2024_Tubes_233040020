<?php
//require "session.php";
require "../koneksi.php";

$queryproduk = mysqli_query($con, "SELECT a.*, b.nama AS nama_kategori FROM produk a JOIN kategori b ON a.kategori_id = b.id");
$jumlahproduk = mysqli_num_rows($queryproduk);

$querykategori = mysqli_query($con, "SELECT * FROM kategori");
function generateRandomString($length = 10)
{
  $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $charactersLength = strlen($characters);
  $randomString = '';
  for ($i = 0; $i < $length; $i++) {
    $randomString .= $characters[rand(0, $charactersLength - 1)];
  }
  return $randomString;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Produk</title>
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css">
</head>

<style>
  .no-decoration {
    text-decoration: none;
  }

  form div {
    margin-bottom: 10px;
  }
</style>


<body>
  <?php
  require "navbar.php"; ?>
  <div class="container mt-5">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page"><a href="../adminpanel" class="no-decoration text-muted"> <i class="fas fa-home"></i> Home</a></li>
        <li class="breadcrumb-item active" aria-current="page"> Produk</li>
      </ol>
    </nav>

    <!-- Tambah produk -->
    <div class="my-5 col-12 col-md-6">
      <h3>Tambah Produk</h3>

      <form action="" method="post" enctype="multipart/form-data">
        <div>
          <label for="nama">Nama</label>
          <input type="text" id="nama" name="nama" class="form-control" autocomplete="off" required>
        </div>
        <div>
          <label for="kategori">Kategori</label>
          <select name="kategori" id="kategori" class="form-control" required>
            <option value="">Pilih Satu</option>
            <?php
            while ($data = mysqli_fetch_array($querykategori)) {
            ?>
              <option value="<?php echo $data['ID']; ?>"><?php echo $data['NAMA']; ?></option>
            <?php
            }
            ?>
          </select>
        </div>
        <div>
          <label for="harga">Harga</label>
          <input type="number" id="harga" name="harga" class="form-control" autocomplete="off" required>
        </div>
        <div>
          <label for="foto">Foto</label>
          <input type="file" name="foto" id="foto" class="form-control">
        </div>
        <div>
          <label for="detail">Detail</label>
          <textarea name="detail" id="detail" cols="30" rows="10" class="form-control"></textarea>
        </div>
        <div>
          <label for="ketersediaan_stok">Ketersediaan Stok</label>
          <select name="ketersediaan_stok" id="ketersediaan_stok" class="form-control">
            <option value="Tersedia">Tersedia</option>
            <option value="habis">habis</option>
          </select>
        </div>
        <div>
          <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
        </div>
      </form>

      <?php
      if (isset($_POST['simpan'])) {
        $nama = htmlspecialchars($_POST['nama']);
        $kategori = htmlspecialchars($_POST['kategori']);
        $harga = htmlspecialchars($_POST['harga']);
        $detail = htmlspecialchars($_POST['detail']);
        $ketersediaan_stok = htmlspecialchars($_POST['ketersediaan_stok']);

        $target_dir = "../img/";
        $nama_file = basename(($_FILES["foto"]["name"]));
        $target_file = $target_dir . $nama_file;
        $imagefiletype = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $image_size = $_FILES["foto"]["size"];
        $random_name = generateRandomString(10);
        $new_name = $random_name . '.' . $imagefiletype;


        if ($nama == '' || $kategori == '' || $harga == '') {
      ?>
          <div class="alert alert-warning" role="alert">
            Data Harus Diisi
          </div>
          <?php
        } else {
          if ($nama_file != '') {
            if ($image_size > 5000000) {
          ?>
              <div class="alert alert-warning" role="alert">
                file terlalu besar
              </div>

              <?php
            } else {
              if ($imagefiletype != 'jpg' && $imagefiletype != 'png' && $imagefiletype != 'gif') {
              ?>
                <div class="alert alert-warning" role="alert">
                  file wajib bertype jpg, png, gif
                </div>

            <?php
              } else {
                move_uploaded_file($_FILES["foto"]["tmp_name"], $target_dir . $new_name);
              }
            }
          }

          //query insert to produk table
          $queryInsert = mysqli_query($con, "INSERT INTO produk (KATEGORI_ID, NAMA, HARGA, FOTO, DETAIL, KETERSEDIAAN_STOK) VALUES ('$kategori', '$nama', '$harga', '$new_name', '$detail', '$ketersediaan_stok')");

          if ($queryInsert) {
            ?>
            <div class="alert alert-success" role="alert">
              Data Berhasil Ditambahkan
            </div>

            <meta http-equiv="refresh" content="2;url=http:produk.php">
      <?php

          } else {
            echo mysqli_error($con);
          }
        }
      }
      ?>
    </div>
    <div class="mt-3 mb-5">
      <h2>List Produk</h2>

      <div class="table-responsive mt-5">
        <table class="table">
          <thead>
            <tr>
              <th>No.</th>
              <th>Nama</th>
              <th>Kategori</th>
              <th>Harga</th>
              <th>Ketersediaan Stok</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if ($jumlahproduk == 0) {
            ?>
              <tr>
                <td colspan=6 class="text-center">Data Produk Tidak Tersedia</td>
              </tr>
              <?php
            } else {
              $jumlah = 1;
              while ($data = mysqli_fetch_array($queryproduk)) {
              ?>
                <tr>
                  <td><?php echo $jumlah; ?></td>
                  <td><?php echo $data['NAMA']; ?></td>
                  <td><?php echo $data['nama_kategori']; ?></td>
                  <td><?php echo $data['HARGA']; ?></td>
                  <td><?php echo $data['KETERSEDIAAN_STOK']; ?></td>
                  <td>
                    <a href="Produk-detail.php?id=<?php echo $data['ID']; ?>" class="btn btn-info"><i class="fas fa-search"></i></a>
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


      <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
      <script src="../fontawesome/js/all.min.js"></script>
</body>

</html>