<?php
    class pesan_model {
        private $json_file = 'notifikasi.json';

        function get_notifikasi() {
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

            return json_encode(["data" => $counter]);
        }

        function get_pesan() {
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

            // Mengembalikan respons dalam format JSON
            return json_encode($response);
        }

        function set_pesan($parameter_data) {
            // Baca data JSON yang ada
            if (file_exists($this->json_file)) {
                $jsonData = file_get_contents($this->json_file);
                $data = json_decode($jsonData, true);
            } else {
                $data = [];
                return 0;
                exit;
            }

            // Data baru yang akan ditambahkan
            $dataBaru = [
                "id" => count($data) + 1,
                "nama_pengirim" => $parameter_data['nama_pengirim'],
                "isi_pesan" => $parameter_data['isi_pesan'],
                "status" => "unread"
            ];

            // Tambahkan data baru ke array
            $data[] = $dataBaru;

            // Simpan kembali ke dalam file JSON
            file_put_contents($this->json_file, json_encode($data, JSON_PRETTY_PRINT));

            return 1;
        }
    } //end class
?>