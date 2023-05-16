<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    if ( ! function_exists('format_to_money')) {
        function format_to_money($nbr) {
            $temp = explode(".", $nbr);
            $nbr = strrev($temp[0]);
            $array_number = str_split($nbr, 3);
            $format = '';
            for ($i=0; $i < count($array_number); $i++) { 
                $format = $format.$array_number[$i].' ';
            }
            if(count($temp)>1) {
                if (strlen($temp[1])>2) {
                    $decimal = substr($temp[1], 0, 2);
                } else {
                    $decimal = $temp[1];
                }
            } else {
                $decimal = '00';
            }
            $format = strrev($format).','.$decimal;
            return $format;
        }
    }

?>