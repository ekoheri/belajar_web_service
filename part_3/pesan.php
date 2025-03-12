<?php
    // Contoh controller
    class pesan {
        private $json_file = 'notifikasi.json';

        function notifikasi() {
            // Periksa apakah file JSON ada
            if (!file_exists($this->json_file)) {
                echo 0;
                exit;
            }

            // Baca isi file JSON
            $json_data = file_get_contents($this->json_file);
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
        }

        function tampil_pesan() {
            header('Content-Type: application/json');

            // Membaca file JSON
            $data = json_decode(file_get_contents($this->json_file), true);

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
        }

        function tambah_pesan() {
            // Baca data JSON yang ada
            $data_input = json_decode(file_get_contents("php://input"), true);
            $nama_pengirim = $data_input['nama_pengirim'];
            $isi_pesan = $data_input['isi_pesan'];
            if (file_exists($this->json_file)) {
                $jsonData = file_get_contents($this->json_file);
                $data = json_decode($jsonData, true);
            } else {
                $data = [];
            }

            // Data baru yang akan ditambahkan
            $dataBaru = [
                "id" => count($data) + 1,
                "nama_pengirim" => $nama_pengirim,
                "isi_pesan" => $isi_pesan,
                "status" => "unread"
            ];

            // Tambahkan data baru ke array
            $data[] = $dataBaru;

            // Simpan kembali ke dalam file JSON
            file_put_contents($this->json_file, json_encode($data, JSON_PRETTY_PRINT));

            echo json_encode(["data" => "Notifikasi berhasil ditambahkan!"]);
        }
    }//end class
?>