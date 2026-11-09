
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "table_penduduk";

// Create connection
$conn = new mysqli(
    $servername,
    $username,
    $password,
    $dbname
);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM pariwisata";
$result = $conn->query($sql);

echo "<a href='input/index.html'>Input Data</a>";

if ($result->num_rows > 0) {
    echo "<table border='1'>
            <tr>
                <th>Nama Destinasi</th>
                <th>Longitude</th>
                <th>Latitude</th>
                <th>Jenis Wisata</th>
                <th>Fasilitas</th>
                <th>Jumlah Pengunjung 2025</th>
                <th>Sumber Data</th>
                <th>Desa/Kelurahan</th>
                <th>Kecamatan</th>
                <th>Kabupaten</th>
                <th>Provinsi</th>
                <th colspan='2'>Aksi</th>
            </tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars((string)$row["nama_destinasi_pariwisata"], ENT_QUOTES, "UTF-8") . "</td>";
        echo "<td>" . rtrim(rtrim(number_format((float)$row["longitude"], 6, '.', ''), '0'), '.') . "</td>";
        echo "<td>" . rtrim(rtrim(number_format((float)$row["latitude"], 6, '.', ''), '0'), '.') . "</td>";
        echo "<td>" . htmlspecialchars((string)$row["jenis_wisata"], ENT_QUOTES, "UTF-8") . "</td>";
        echo "<td>" . htmlspecialchars((string)$row["fasilitas"], ENT_QUOTES, "UTF-8") . "</td>";
        echo "<td align='right'>" . htmlspecialchars((string)$row["jlh_pengunjung_thn_2025"], ENT_QUOTES, "UTF-8") . "</td>";
        echo "<td>" . htmlspecialchars((string)$row["sumber_data"], ENT_QUOTES, "UTF-8") . "</td>";
        echo "<td>" . htmlspecialchars((string)$row["desa_kelurahan"], ENT_QUOTES, "UTF-8") . "</td>";
        echo "<td>" . htmlspecialchars((string)$row["kecamatan"], ENT_QUOTES, "UTF-8") . "</td>";
        echo "<td>" . htmlspecialchars((string)$row["kabupaten"], ENT_QUOTES, "UTF-8") . "</td>";
        echo "<td>" . htmlspecialchars((string)$row["provinsi"], ENT_QUOTES, "UTF-8") . "</td>";
        echo "<td><a href='delete.php?id=" . rawurlencode((string)$row["id"]) . "'>hapus</a></td>";
        echo "<td><a href='edit/index.php?id=" . rawurlencode((string)$row["id"]) . "'>edit</a></td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "0 results";
}

$conn->close();
?>
