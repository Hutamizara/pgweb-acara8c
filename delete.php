
<?php
$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

if (!$id || $id < 1) {
    http_response_code(400);
    exit("ID tidak valid.");
}

$conn = new mysqli("localhost", "root", "", "table_penduduk");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$stmt = $conn->prepare("DELETE FROM pariwisata WHERE id = ?");
$stmt->bind_param("i", $id);

if (!$stmt->execute()) {
    http_response_code(500);
    exit("Gagal menghapus data: " . $stmt->error);
}

$stmt->close();
$conn->close();

header("Location: index.php");
exit;
?>
