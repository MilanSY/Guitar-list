<?php
    
    /**
    * Permet de checker si les input ont moins de 255 caractères
    * @param string $input La chaine de caractère à vérifié
    * @return bool true si > 255 false sinon
    */
    
    function is_under_255(string $input) : bool {
        if (strlen($input) > 255){
            return false;
        } else {
            return true;
        }
    }