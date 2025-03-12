<?php
header('Content-Type: application/json');

// Membaca file JSON
$json_file = 'notifikasi.json';
$data = json_decode(file_get_contents($json_file), true);

// Filter notifikasi yang statusnya "unread"
$unread_notifikasi = array_filter($data, function ($notif) {
    return $notif['status'] === 'unread';
});

// Format respons JSON dengan elemen "data"
$response = [
    "data" => array_values($unread_notifikasi)
];

// Menampilkan respons dalam format JSON
echo json_encode($response);
?>
