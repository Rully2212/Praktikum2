<?php
function curl($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch);
    curl_close($ch);
    return $output;
}

// Ambil data dari getWisata.php
$send = curl("http://localhost/wisata/getWisata.php");

// Ubah JSON menjadi array asosiatif
$data = json_decode($send, true);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabel Data Wisata</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f9fafb;
            color: #333;
            margin: 40px;
        }
        h2 {
            text-align: center;
            color: #2c3e50;
        }
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background: white;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        th, td {
            border: 1px solid #ddd;
            padding: 12px 16px;
            text-align: center;
        }
        th {
            background-color: #2980b9;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #eaf2f8;
        }
        .gratis {
            color: green;
            font-weight: bold;
        }
    </style>
</head>
<body>

<h2>Daftar Tempat Wisata</h2>

<table>
    <tr>
        <th>ID</th>
        <th>Nama Wisata</th>
        <th>Lokasi</th>
        <th>Harga</th>
    </tr>

    <?php
    if (!empty($data)) {
        foreach ($data as $row) {
            echo "<tr>";
            echo "<td>" . $row["id"] . "</td>";
            echo "<td>" . $row["nama_wisata"] . "</td>";
            echo "<td>" . $row["lokasi"] . "</td>";

            // jika harga berisi "GRATIS", beri warna hijau
            if (strtoupper($row["harga"]) == "GRATIS") {
                echo "<td class='gratis'>" . strtoupper($row["harga"]) . "</td>";
            } else {
                echo "<td>Rp " . number_format($row["harga"], 0, ',', '.') . "</td>";
            }

            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='4'>Tidak ada data ditemukan</td></tr>";
    }
    ?>

</table>

</body>
</html>
