//ambil elemen yang dibutuhkan
var keyword = document.getElementById('keyword2');
var tombolCari = document.getElementById('tombol-cari');
var container = document.getElementById('container2');

//tambahkan event ketika keyword ditulis
keyword.addEventListener('keyup', function(){
    
    //buat objek ajax
    var xhr = new XMLHttpRequest();

    //cek kesiapan ajax
    xhr.onreadystatechange = function(){
        if(xhr.readyState == 4 && xhr.status == 200){
            container.innerHTML = xhr.responseText;
        }
    }   

    //eksekusi ajax
    xhr.open('GET', 'ajax/coba.txt', true);
    xhr.send();
});