<?php

// File JSON yang menyimpan data notifikasi
$json_file = 'notifikasi.json';

// Periksa apakah file JSON ada
if (!file_exists($json_file)) {
    echo 0;
    exit;
}

// Baca isi file JSON
$json_data = file_get_contents($json_file);
$notifications = json_decode($json_data, true);

// Hitung jumlah notifikasi (misalnya berdasarkan status "unread")
$counter = 0;
if (is_array($notifications)) {
    foreach ($notifications as $notif) {
        if (isset($notif['status']) && $notif['status'] === 'unread') {
            $counter++;
        }
    }
}

// Keluarkan jumlah notifikasi sebagai output
echo json_encode(["data" => $counter]);
?>
