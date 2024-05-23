<?php
//require "session.php";
require "../koneksi.php";

$id = $_GET['id'];

$query = mysqli_query($con, "SELECT a.*, b.nama AS nama_kategori FROM produk a JOIN kategori b ON a.kategori_id = b.id WHERE a.id = '$id'");
$data = mysqli_fetch_array($query);

$querykategori = mysqli_query($con, "SELECT * FROM kategori WHERE id != '$data[KATEGORI_ID]'");
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
  <title>Produk Detail</title>
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">

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
    <h2>Detail Produk</h2>

    <div class="col-12 col-md-6">
      <form action="" method="post" enctype="multipart/form-data">
        <div>
          <label for="nama">Nama</label>
          <input type="text" id="nama" name="nama" value="<?php echo $data['NAMA'] ?>" class="form-control" autocomplete="off" required>
        </div>
    </div>
    <div>
      <label for="kategori">Kategori</label>
      <select name="kategori" id="kategori" class="form-control">
        <option value="" <?php echo $data['KATEGORI_ID']; ?>><?php echo $data['nama_kategori']; ?></option>
        <?php
        while ($dataKategori = mysqli_fetch_array($querykategori)) {
        ?>
          <option value="<?php echo $dataKategori['ID']; ?>"><?php echo $dataKategori['NAMA']; ?></option>
        <?php
        }
        ?>
      </select>
    </div>
    <div>
      <label for="harga">Harga</label>
      <input type="number" class="form-control" value="<?php echo $data['HARGA'] ?>" name="harga">
    </div>
    <div>
      <label for="currentFoto">Foto Produk Sekarang</label>
      <img src="../img/<?php echo $data['FOTO']; ?>" alt="Foto Produk" width="300px" class="mt-3">
    </div>
    <div>
      <label for="foto">Foto</label>
      <input type="file" name="foto" id="foto" class="form-control">
    </div>
    <div>
      <label for="detail">Detail</label>
      <textarea name="detail" id="detail" cols="30" rows="10" class="form-control">
            <?php echo $data['DETAIL']; ?>
          </textarea>
    </div>
    <div>
      <label for="ketersediaan_stok" class="mt-3 ">Ketersediaan Stok</label>
      <select name="ketersediaan_stok" id="ketersediaan_stok" class="form-control">
        <option value="<?php echo $data['KETERSEDIAAN_STOK'] ?>"><?php echo $data['KETERSEDIAAN_STOK'] ?></option>
        <?php
        if ($data['KETERSEDIAAN_STOK'] == "Tersedia") {
        ?>
          <option value="Tersedia">Tersedia</option>
        <?php
        } else {
        ?>
          <option value="habis">Habis</option>
        <?php
        }
        ?>
      </select>
    </div>
    <div class="d-flex justify-content-between">
      <button type="submit" name="simpan" class="btn btn-primary mt-3 mb-5">Simpan</button>
      <button type="submit" name="hapus" class="btn btn-danger mt-3 mb-5">Hapus</button>
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

      if (empty($nama) || empty($kategori) || empty($harga)) {
    ?>
        <div class="alert alert-danger" role="alert">
          Semua data harus diisi
        </div>
        <?php
      } else {
        $queryUpdate = mysqli_query($con, "UPDATE produk SET kategori_id = '$kategori', 
        nama = '$nama', harga = '$harga', detail = '$detail', ketersediaan_stok = $ketersediaan_stok WHERE id = '$id'");

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

              $queryUpdate = mysqli_query($con, "UPDATE produk SET foto = '$new_name' WHERE id = '$id'");

              if ($queryUpdate) {
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
        }
      }
    }

    if (isset($_POST['hapus'])) {
      $queryDelete = mysqli_query($con, "DELETE FROM produk WHERE id = '$id'");

      if ($queryDelete) {
        ?>
        <div class="alert alert-primary mt-3" role="alert">
          Data Berhasil Dihapus
        </div>
        <meta http-equiv="refresh" content="2;url=http:produk.php">

    <?php
      }
    }


    ?>
  </div>
  </div>

  <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>