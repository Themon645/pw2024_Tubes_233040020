<?php
require '../koneksi.php';

if (isset($_GET['keyword'])) {
    $keyword = htmlspecialchars($_GET['keyword']);
    $query = "SELECT a.*, b.nama AS nama_kategori FROM produk a JOIN kategori b ON a.kategori_id = b.id WHERE a.nama LIKE '%$keyword%'";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0) {
        $jumlah = 1;
        while ($data = mysqli_fetch_array($result)) {
            echo "<tr>
                    <td>{$jumlah}</td>
                    <td>{$data['NAMA']}</td>
                    <td>{$data['nama_kategori']}</td>
                    <td>{$data['HARGA']}</td>
                    <td>{$data['KETERSEDIAAN_STOK']}</td>
                    <td><a href='Produk-detail.php?id={$data['ID']}' class='bi bi-pencil-square fs-3'><i class='fas fa-search'></i></a></td>
                  </tr>";
            $jumlah++;
        }
    } else {
        echo "<tr><td colspan='6' class='text-center'>Produk Yang Anda Cari Tidak Tersedia</td></tr>";
    }
} else {
    echo "<tr><td colspan='6' class='text-center'>Silakan masukkan kata kunci pencarian</td></tr>";
}
?>
