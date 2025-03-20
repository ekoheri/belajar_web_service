<?php
    $nama_class = "pesan";
    
    include $nama_class.".php";

    $object = new $nama_class;
    
    call_user_func(array($object, "notifikasi")); 
?>
