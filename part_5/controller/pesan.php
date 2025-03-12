<?php
    class pesan {
        private $model;
        function __construct() {
            include "model/pesan_model.php";
            $this->model = new pesan_model;
        }
        
        function notifikasi() {
            echo $this->model->get_notifikasi();
        }

        function tampil_pesan() {
            header('Content-Type: application/json');
            echo $this->model->get_pesan();
        }

        function tambah_pesan() {
            $data_input = json_decode(file_get_contents("php://input"), true);
            $data_baru = array();
            $data_baru['nama_pengirim'] = $data_input['nama_pengirim'];
            $data_baru['isi_pesan'] = $data_input['isi_pesan'];

            $hasil = $this->model->set_pesan($data_baru);
            if($hasil == 1)
                echo json_encode(["data" => "Pesan berhasil ditambahkan!"]);
            else
                echo json_encode(["data" => "Pesan gagal ditambahkan!"]);
        }
    }//end class
?>