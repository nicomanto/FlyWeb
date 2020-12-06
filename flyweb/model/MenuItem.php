<?php
    namespace model;
  
    class MenuItem{
        private $path_file;
        private $name;
        private $accessibility;
        private $lang;

        function __construct($path_file,$name,$array,$lang="it") {
            $this->path_file = $path_file;
            $this->name=$name;
            $this->accessibility=$array;
            $this->lang=$lang;
        }

        function get_path(){
            return $this->path_file;
        }

        function get_name(){
            return $this->name;
        }

        function get_accessibility(){
            return $this->accessibility;
        }

        function get_lang(): string{
            return $this->lang;
        }


    }
?>