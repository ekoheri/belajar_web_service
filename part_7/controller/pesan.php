<?php
class pesan {
    private $model;
    private $view;

    function __construct() {
        $this->model = Service::singleton("model", pesan_model::class, 
            function(){
                return new pesan_model;
            }
        );

        $this->view = Factory::create("library", "view_library");
    }
    
    function notifikasi() {
        header('Content-Type: application/json');
        $xyz = array();
        $xyz['data'] = $this->model->get_notifikasi();
        echo json_encode($xyz);
    }

    // Web service
    function tampil_pesan() {
        header('Content-Type: application/json');
        $xyz = array();
        $xyz['data'] = $this->model->get_pesan();
        echo json_encode($xyz);
    }

    // Monolith
    function tampil_pesan_html() {
        $xyz = array();
        $xyz['data_ke_view'] = $this->model->get_pesan();
        echo $this->view->load("view_pesan", $xyz);
    }

    function tambah_pesan() {
        $data_input = json_decode(file_get_contents("php://input"), true);
        $data_baru = array();
        $data_baru['nama_pengirim'] = $data_input['nama_pengirim'];
        $data_baru['isi_pesan'] = $data_input['isi_pesan'];

        $hasil = $this->model->set_pesan($data_baru);
        if ($hasil == 1)
            echo json_encode(["data" => "Pesan berhasil ditambahkan!"]);
        else
            echo json_encode(["data" => "Pesan gagal ditambahkan!"]);
    }
}
?>
