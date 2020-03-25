
<?php
        
            function indice($mot){
              $i=0;
              $verif=true;
              while (isset($mot[$i]) && $verif!=FALSE){
                  if ($mot[$i]>=0 && $mot[$i]<=9) {
                    $verif=false;
                  }
                  $i++;
              };
            
              if($verif){
                echo "Good";
              }else{
                echo "Pas good";
              }
            }



            indice('cbag');
            echo "Test";
            echo indice('cbag1');
?>