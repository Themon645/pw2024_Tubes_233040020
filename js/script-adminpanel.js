// ambil elemen yang dibutuhkan
var keyword = document.getElementById('keyword-produk');
var container = document.getElementById('container-produk');

// tambahkan event ketika keyword ditulis
keyword.addEventListener('keyup', function(){
    // buat objek ajax
    var xhr = new XMLHttpRequest();

    // cek kesiapan ajax
    xhr.onreadystatechange = function(){
        if(xhr.readyState == 4 && xhr.status == 200){
            container.innerHTML = xhr.responseText;
        }
    };

    // eksekusi ajax
    xhr.open('GET', '../ajax/produk-adminpanel.php?keyword=' + keyword.value, true);
    xhr.send();
});
