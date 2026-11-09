
<?php
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    http_response_code(405);
    exit("Metode tidak diizinkan.");
}

$nama = trim($_POST["nama_destinasi_pariwisata"] ?? "");
$longitude = $_POST["longitude"] ?? "";
$latitude = $_POST["latitude"] ?? "";
$jenis = trim($_POST["jenis_wisata"] ?? "");
$fasilitas = trim($_POST["fasilitas"] ?? "");
$pengunjung = filter_input(INPUT_POST, "jlh_pengunjung_thn_2025", FILTER_VALIDATE_INT);
$sumber = trim($_POST["sumber_data"] ?? "");
$desa = trim($_POST["desa_kelurahan"] ?? "");
$kecamatan = trim($_POST["kecamatan"] ?? "");
$kabupaten = trim($_POST["kabupaten"] ?? "");
$provinsi = trim($_POST["provinsi"] ?? "");

if (
    $nama === "" ||
    !is_numeric($longitude) ||
    !is_numeric($latitude) ||
    $jenis === "" ||
    $pengunjung === false ||
    $pengunjung === null ||
    $pengunjung < 0
) {
    http_response_code(400);
    exit("Data formulir tidak valid.");
}

$conn = new mysqli("localhost", "root", "", "table_penduduk");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO pariwisata (
    nama_destinasi_pariwisata,
    longitude,
    latitude,
    jenis_wisata,
    fasilitas,
    jlh_pengunjung_thn_2025,
    sumber_data,
    desa_kelurahan,
    kecamatan,
    kabupaten,
    provinsi
) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);

$stmt->bind_param(
    "sddssisssss",
    $nama,
    $longitude,
    $latitude,
    $jenis,
    $fasilitas,
    $pengunjung,
    $sumber,
    $desa,
    $kecamatan,
    $kabupaten,
    $provinsi
);

if (!$stmt->execute()) {
    http_response_code(500);
    exit("Gagal menyimpan data: " . $stmt->error);
}

$stmt->close();
$conn->close();

header("Location: ../index.php");
exit;
?>
