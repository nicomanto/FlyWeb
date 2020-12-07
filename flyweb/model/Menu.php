<?php
    namespace model;

    abstract class Menu{

        protected $MenuItem;
       
        function build_menu(string $user){
            $final_menu=[];
            
            foreach ($this->MenuItem as $i) {
                foreach($i->get_accessibility() as $j){
                    if($user==$j){
                        array_push($final_menu,$i);
                        break;
                    }
                }
            }

            return $final_menu;
        }

    }