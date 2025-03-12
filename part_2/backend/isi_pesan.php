<?php
$file = 'notifikasi.json';

// Baca data JSON yang ada
if (file_exists($file)) {
    $jsonData = file_get_contents($file);
    $data = json_decode($jsonData, true);
} else {
    $data = [];
}

// Data baru yang akan ditambahkan
$dataBaru = [
    "id" => count($data) + 1,
    "nama_pengirim" => "User Baru",
    "isi_pesan" => "Pesan baru telah ditambahkan.",
    "status" => "unread"
];

// Tambahkan data baru ke array
$data[] = $dataBaru;

// Simpan kembali ke dalam file JSON
file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT));

echo "Notifikasi berhasil ditambahkan!";
?>
