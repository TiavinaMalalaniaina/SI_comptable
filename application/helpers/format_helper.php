<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    if ( ! function_exists('format_to_money')) {
        function format_to_money($nbr) {
            $array_number = str_split($nbr, 3);
            $format = '';
            for ($i=0; $i < count($array_number); $i++) { 
                $format = $format.$array_number[$i].' ';
            }         
            $format = $format.'Ar';
            return $format;
        }
    }

?>