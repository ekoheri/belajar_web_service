<?php
new index;

//Single Point of Entry
class index {
    function __construct() {
        $router = new router();
        $router->route();

        if(!file_exists('controller/'.$router->controller.'.php'))
            die('File Controller Tidak Ditemukan !');

        require 'controller/'.$router->controller.'.php';
        $obj = new $router->controller;
        if(!method_exists($obj, $router->method))
            die('Method tidak ditemukan !');
        
        define('METHOD_ACTIVE', $router->method);

        call_user_func_array(
            array($obj, $router->method),
            $router->parameter
        );
    }
}

// Router
// http://localhost/part_4/index.php/pesan/tampil_pesan
// pesan : nama controller
// tampil_pesan : nama method yang dipanggil

class router {
    public $controller = "pesan"; // nama controller default
    public $method = "tampil_pesan"; //nama method default
    public $parameter = array();

    public function route(){
        $path = '';
        if(isset($_SERVER['PATH_INFO']))
            $path = $_SERVER['PATH_INFO'];

        $path = trim($path, '/');
        if($path == '') return;

        $segmen = explode('/', $path);
        $this->controller = $segmen[0];
        if(sizeof($segmen) > 1)
            $this->method = $segmen[1];
        $this->parameter = array_slice($segmen, 2);
    }
}
?>