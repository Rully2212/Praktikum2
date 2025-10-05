<?php
$connect = mysqli_connect("localhost", "root", "", "json");

if (!$connect) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

$sql = "SELECT * FROM wisata";
$result = mysqli_query($connect, $sql);

$json_array = array();

while ($row = mysqli_fetch_assoc($result)) {
    // ubah harga = 0 menjadi "GRATIS"
    if ($row['harga'] == 0) {
        $row['harga'] = "GRATIS";
    }
    $json_array[] = $row;
}

echo json_encode($json_array);

mysqli_close($connect);
?>
