<?php
    class pesan extends singleton {
        function __construct() {
            parent :: __construct ();
            registry::model('pesan_model');
            registry::library('view_library');
        }
        
        function notifikasi() {
            header('Content-Type: application/json');
            $xzy = array();
            $xyz['data']  = $this->pesan_model->get_notifikasi();
            echo json_encode($xyz);
        }

        //web service
        function tampil_pesan() {
            header('Content-Type: application/json');
            $xzy = array();
            $xyz['data'] = $this->pesan_model->get_pesan();
            echo json_encode($xyz);
        }

        //monolith
        function tampil_pesan_html() {
            $xzy = array();
            $xyz['data_ke_view'] = $this->pesan_model->get_pesan();
            echo $this->view_library->load("view_pesan", $xyz);
        }

        function tambah_pesan() {
            $data_input = json_decode(file_get_contents("php://input"), true);
            $data_baru = array();
            $data_baru['nama_pengirim'] = $data_input['nama_pengirim'];
            $data_baru['isi_pesan'] = $data_input['isi_pesan'];

            $hasil = $this->pesan_model->set_pesan($data_baru);
            if($hasil == 1)
                echo json_encode(["data" => "Pesan berhasil ditambahkan!"]);
            else
                echo json_encode(["data" => "Pesan gagal ditambahkan!"]);
        }
    }//end class
?>
