<?php
    class pesan_model {
        private $repository;

        function set_repository($value) {
            include "repository/".$value.".php";
            $this->repository = new $value;
        }

        function get_notifikasi() {
            return $this->repository->getNotifikasi();
        }

        function get_pesan() {
            return $this->repository->getPesan();
        }

        function set_pesan($parameter_data) {
            return $this->repository->setPesan($parameter_data);
        }
    } //end class
?>
