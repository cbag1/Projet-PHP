<?php

    function is_car_numeric ($c){
        if ($c > '0' &&  $c <= '9'){
            return true;
        }
        return false;
    }

    function is_minuscule ($c){
        if ($c > 'a' &&  $c <= 'z'){
            return true;
        }
        return false;
    }

    function is_car_alpha($car){
        if( long_chaine($car)==1 && ($car >='a' && $car <='z') ||
        ($car>='A' && $car<='Z')){
            return true;
        }
        return false;
    }


    function invers_car_case($car){ 
        $min = 'a';
        $maj = 'A';
          if(strlen($car)==1){
            for($i=0; $i < 26; $i++){
              if($car==$min){                
                return $maj;                                   
              }elseif ($car==$maj){
                return $min; 
                    }                       
                $min++;                            
                $maj++;
                    }                                                                                                    
                } 
                return $car;
    }


    // Effacer les 
    
    function f1($phrase){
        $phrase=trim($phrase);  
        $phrase[0]=strtoupper($phrase[0]);
        return $phrase;
        
    }

    function supp_espace_inutile($chaine){
        $pattern2 = "% ?' ?%";
        $pattern = '%\s{2,}%';
        $pattern3 = "% ?;%";
        $replacement = ' ';
        $replacement2 = '\'';
        $replacement3=';';
        $chaine=preg_replace($pattern, $replacement, $chaine);
        $chaine=preg_replace($pattern2, $replacement2, $chaine);
        $chaine=preg_replace($pattern3, $replacement3, $chaine);

        return $chaine;
    }



    // function supp_espace_inutile($chaine){
    //     $pattern2 = "% ?' ?%";
    //     $pattern = '%\s{2,}%';
    //     $pattern3 = "% ?;%";
    //     $replacement = ' ';
    //     $replacement2 = '\'';
    //     $chaine=preg_replace($pattern, $replacement, $chaine);
    //     $chaine=preg_replace($pattern2, $replacement2, $chaine);
    //     $chaine=preg_replace($pattern3, $replacement3, $chaine);

    //     return $chaine;
    // }

?>