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

    /**
     * Permet de verifier si une valeur est dans un array contenant des arrays
     * @param mixed $value la valeur cherchée
     * @param array $array l'array contenant des arrays
     * @return bool true s
     */
    function name_in_array(mixed $value, array $arrays) : bool {
        foreach ($arrays as $key => $names){
            if(in_array($value,$names,true)){
                return true;
            }
        }
        return false;
    }

    function empty_array(array $array) : bool {
        foreach($array as $key => $value){
            if(!empty($value)){
                return false;
            }
        }
        return true;
    }   

    function create_paging(array $list, array $paging) : array{
        $count = 0;
        $tab = [];
        foreach($list as $guitar){
            $tab[] = $guitar;
            $count++;
            if ($count === 3) {
                if(empty($paging)){
                    $paging[1] = $tab;
                    $tab =[];
                    $count = 0;
                }
                else{
                    $paging[] = $tab;
                    $tab =[];
                    $count = 0;
                }
            }
        }
        if ($count != 0){
            if(empty($paging)){
                $paging[1] = $tab;
            }
            else{
                $paging[] = $tab;
            }
        }
        return $paging;
    }
