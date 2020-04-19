
<?php
        
        // function est_caractere($car){
        //   // $car=$car[0];
        //   return (($car >='a' && $car <='z') || ($car >='A' && $car <='Z'));
        // }


        // if(est_caractere('7a')){
        //   echo "Bon";
        // }else{
        //   echo "Pas bon";
        // }

        

        // function supp_space($chaine){
        //     $chaine_sans_espace="";
        //     $n=strlen($chaine);
        //     echo " n: ",$n;
        //     $bool=false;
        //     $bool2=false;
        //     for ($i=0; $i < $n; $i++) { 
        //      if ($bool==true) {
        //         $chaine_sans_espace.=$chaine[$i];
        //         $j=strlen($chaine)-$i-1;
        //         if($chaine[$j]!=" "){
        //           $bool2=true;
        //         }
        //         if ($bool2==false) {
        //           $n-=1;
        //           echo $n;
        //         }
        //      }else{
        //        if ($chaine[$i]!=" ") {
        //         $chaine_sans_espace.=$chaine[$i];
        //          $bool=true;
        //        }else{
        //           $i++;
        //        }
        //      }
        //     }
        //     return $chaine_sans_espace;
        // }

    //     function delete_spc_before_after($chaine){
    //       $debut=0;
    //       $fin=strlen($chaine)-1;
    //       $newChaine = '';
    //       if($chaine==''){ return $chaine; }
    //       while ($chaine[$debut]==' '){
    //           $debut++; 
    //           if(!isset($chaine[$debut])){
    //               return '';
    //           } 
    //       }
    //       while ($chaine[$fin]==' '){ $fin--; }
    //       while ($debut<=$fin){ $newChaine.=$chaine[$debut++]; }
    //       for ($i=$debut; $i <=$fin ; $i++) { 
    //           $newChaine.=$chaine[$i];
    //       }
    //       return $newChaine;
    //   }
    //     echo delete_spc_before_after(" ");
    // function supp_espace_inutile($phrase){
    //     $texte="b-";
    //     for ($i=0; $i < strlen($phrase); $i++) { 

    //         if ($phrase[$i]==" ") {
    //             if ($phrase[($i-1)]=="'" ) {
    //                 $i++;
    //                 echo "++";
    //             }
    //             else {
    //                 if (isset($phrase[$i+1]) && $phrase=" " || $phrase="'") {
    //                     $i++;
    //                     echo "--";
    //                 }
    //                 else{
    //                     $texte.=$texte[$i];
    //                 }
    //             }
    //         }else{
    //             $texte.=$texte[$i];
    //         }

    //     }

    //     return $texte;
    // }

    // function supp_espace_inutile($phrase){
    //     $texte="b-";
        
    // }
//     $chaine = "Toooto et tata.";
// $pattern = '%[\s]%';
// $replacement = '*';
// $chaine=preg_replace($pattern, $replacement, $chaine);
// echo $chaine;

// $chaine = "Toto     ;                         et l                '                   a  ami     tata.";
// $pattern2 = "% ?' ?%";
// $pattern3 = "% ?;%";
// $pattern = '%\s{2,}%';
// $replacement = ' ';
// $replacement2 = '\'';
// $replacement3=';';
// $chaine=preg_replace($pattern, $replacement, $chaine);
// $chaine=preg_replace($pattern2, $replacement2, $chaine);
// $chaine=preg_replace($pattern3, $replacement3, $chaine);
// $chaine=preg_replace($pattern3, $replacement2, $chaine);
// echo $chaine;

 // $j++;
                // echo "Phrase ".($j).": ",$phrases[$i].$phrases[$i+1];
                // echo "</br>";

    // echo supp_espace_inutile("abaca ;  goudiaby' fljlrjhlrtjl");


    $ages = ['Mathilde' =>[29,29], 'Pierre' => 29, 'Amandine' => 21];
            

    foreach ($ages as $key => $value) {
        var_dump($value);
    }
?>