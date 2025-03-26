<?php
class Factory {
    public static function create($path, $nama_class) {
        include_once $path."/".$nama_class.".php";
        return new $nama_class();
    }
}
?>
