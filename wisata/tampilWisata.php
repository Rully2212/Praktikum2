<?php
function curl($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch);
    curl_close($ch);
    return $output;
}

// ambil data dari getWisata.php
$send = curl("http://localhost/wisata/getWisata.php");

// ubah JSON menjadi array
$data = json_decode($send, true);

// tampilkan data
foreach ($data as $row) {
    echo "ID: " . $row["id"] . "<br/>";
    echo "Nama Wisata: " . $row["nama_wisata"] . "<br/>";
    echo "Lokasi: " . $row["lokasi"] . "<br/>";
    echo "Harga: " . $row["harga"] . "<br/><hr/>";
}
?>
