<?php
    namespace model;
  
    class BreadcrumbItem{
        private $path_file;
        private $name;
        private $lang;

        function __construct($path_file,$name,$lang="it") {
            $this->path_file = $path_file;
            $this->name=$name;
            $this->lang=$lang;
        }

        function get_path(){
            return $this->path_file;
        }

        function get_name(){
            return $this->name;
        }

        function get_lang(): string{
            return $this->lang;
        }


    }
