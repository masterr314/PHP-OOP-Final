<?php

    class PasswordGenerator
    { 
        private $upper_set, $lower_set, $number_set, $special_set;
        function __construct()
        {   
            $this->upper_set = array(range('A', 'Z'))[0];
            $this->lower_set = array(range('a', 'z'))[0];
            $this->number_set = array(range(0, 9))[0];
            $this->special_set = ['$', '%', '@', '!', '?', '&', '*'];
        }
        
        function generate($upper, $lower, $number, $special)
        {
            $rand_password = "";
            if ($upper != 0) {
                for ($i=0; $i < $upper; $i++) { 
                    $rand_num = rand(0, count($this->upper_set) - 1);
                    $rand_password .= $this->upper_set[$rand_num];
                }
            }
            if ($lower != 0) {
                for ($i=0; $i < $lower; $i++) { 
                    $rand_num = rand(0, count($this->lower_set) - 1);
                    $rand_password .= $this->lower_set[$rand_num];
                }
            }
            if ($number != 0) {
                for ($i=0; $i < $number; $i++) { 
                    $rand_num = rand(0, count($this->number_set) - 1);
                    $rand_password .= $this->number_set[$rand_num];
                }
            }
            if ($special != 0) {
                for ($i=0; $i < $special; $i++) { 
                    $rand_num = rand(0, count($this->special_set) - 1);
                    $rand_password .= $this->special_set[$rand_num];
                }
            }
            $rand_password = str_shuffle($rand_password);
            return $rand_password;
        }
    }




