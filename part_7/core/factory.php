<?php
class Factory {
    public static function createModel($nama_model) {
        include_once "model/".$nama_model.".php";
        return new $nama_model();
    }

    public static function createLibrary($nama_library) {
        include_once "library/".$nama_library.".php";
        return new $nama_library();
    }
}
?>
