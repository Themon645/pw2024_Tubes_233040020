<?php
require '../koneksi.php';

if (isset($_GET['keyword'])) {
    $keyword = $_GET['keyword'];
    $query = "SELECT * FROM produk WHERE nama LIKE '%$keyword%'";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0) {
        while ($data = mysqli_fetch_array($result)) { ?>
            <div class="col-sm-6 col-md-4 mb-3">
                <div class="card h-100">
                    <div class="image-box">
                        <img src="./img/<?php echo $data['FOTO']; ?>" class="card-img-top" alt="...">
                    </div>
                    <div class="card-body">
                        <h4 class="card-title"><?php echo $data['NAMA'] ?></h4>
                        <p class="card-text text-truncate"><?php echo $data['DETAIL'] ?></p>
                        <p class="card-text text-harga">Rp<?php echo $data['HARGA'] ?></p>
                        <a href="./produk-detail.php?nama=<?php echo $data['NAMA'] ?>" class="btn warna2 text-white">Lihat Detail</a>
                    </div>
                </div>
            </div>
        <?php }
    } 
    else {
      echo '<p>Produk tidak ditemukan</p>';
  }
  
    if (!$result) {
      echo "Error: " . mysqli_error($con); // Tampilkan pesan kesalahan jika query gagal
      exit;
  }

} else {
    echo '<p>Silakan masukkan kata kunci pencarian</p>';
}
?>
