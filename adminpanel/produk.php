<?php
//require "session.php";
require "../koneksi.php";

$queryproduk = mysqli_query($con, "SELECT * FROM produk");
$jumlahproduk = mysqli_num_rows($queryproduk);

$querykategori = mysqli_query($con, "SELECT * FROM kategori");
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

    <form action="" menthod="post" enctype="multipart/form-data">
    <div>
      <label for="nama">Nama</label>
      <input type="text" id="nama" name="nama" class="form-control" autocomplete="off" required>
    </div>
    <div>
      <label for="kategori">Kategori</label>
      <select name="kategori" id="kategori" class="form-control" required>
        <option value="">Pilih Satu</option>
        <?php
        while($data = mysqli_fetch_array($querykategori)){
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
      <input type="file" nama="foto" id="foto" class="form-control">
    </div>
    <div>
      <label for="detail">Detail</label>
      <textarea name="detail" id="detail" cols="30" rows="10" class="form-control"></textarea>
    </div>
    <div>
      <label for="ketersediaan_stok">Ketersediaan Stok</label>
      <select name="ketersediaan_stok" id="ketersediaan_stok" class="dorm-control">
        <option value="Tersedia">Tersedia</option>
        <option value="Tidak Tersedia">Tidak Tersedia</option>
      </select>
    </div>
    <div>
      <button type="submit" name="tambahproduk" class="btn btn-primary">Simpan</button>
    </div>
    </form>
    </div>
    <div class="mt-3"></div>
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
          </tr>
        </thead>
        <tbody>
          <?php
          if ($jumlahproduk == 0){
          ?>
          <tr>
            <td colspan=5 class="text-center">Data Produk Tidak Tersedia</td>
          </tr>
          <?php
          }
          else{
            $jumlah = 1;
            while($data = mysqli_fetch_array($queryproduk)){
          ?>
          <tr>
            <td><?php echo $jumlah; ?></td>
            <td><?php echo $data['NAMA']; ?></td>
            <td><?php echo $data['KATEGORI_ID']; ?></td>
            <td><?php echo $data['HARGA']; ?></td>
            <td><?php echo $data['KETERSEDIAAN_STOK']; ?></td>

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