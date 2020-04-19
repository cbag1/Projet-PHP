<?php

  function premier($value)
  {
    $tab=[];
    for ($i=2; $i <= $value; $i++) {
        $nbdiv=0;
        for ($j=1; $j <=$i ; $j++) {
           if ($i%$j==0) {
             $nbdiv++;
           }
        }
        if ($nbdiv==2) {
          $tab[]=$i;
        }
    }
    return $tab;
  }

  // Fonction qui permet de calculer la moyenne

  function moyenne($tab){
    $somme=0;
    $moyenne=0;
    for ($i=0; $i < count($tab); $i++) {
      $somme+=$tab[$i];
    }
    $moyenne=$somme/count($tab);
    return $moyenne;
  }

  // function affichage N

  function affichertab($nb1,$tab){//KOUY WEUR NANDITE BA GUISS LA BOU  YABO MOU DIAPP LA;
    echo "<table border=1>";
    $test=0;
    
    if((count($tab)-$nb1)<=100){
      $delim=count($tab);
    }else{
      $delim=$nb1+100;
    }
    for ($i=$nb1; $i < $delim; $i++) { 
      if($test==0){
        echo "<tr>";
        echo "<td>".$tab[$i]."</td>";
        $test++;
      }else{
        if ($test==9) {
          echo "<td>".$tab[$i]."</td>";
          echo "</tr>";
          $test=0;
        }else {
          echo "<td>".$tab[$i]."</td>";
          $test++;
        }
      }
    }
    echo "</table>";
  }



  // Afficher Calendrier
  function affichecalendar($tab){
    echo "<table style='border:1px solid black;'>";
    $d=0;
    for ($i=1; $i <= 4; $i++) { 
        echo '<tr>';
        for ($j=1; $j <= 3; $j++) { 
                $d++;
                echo '<td>'.$d.'</td>';
                echo '<td>'.($tab[($d-1)]).'</td>';
        }
        echo '</tr>';
    }
    echo '</table>';
}




function verifcompteur($valeur,$longueur){
  $i=0;
  $is_valid=true;
  do {
      $i++;
  } while (!empty($valeur[$i]));


  if ($i>$longueur) {
      $is_valid=false;
  }
  return $is_valid;
}


function is_minuscule($lettre){
  $minuscules = "azertyuiopqsdfghjklwxcvbnm";
  for($i=0;$i<26;$i++){
      if($minuscules[$i]==$lettre){
          return true;
      }
  }
  return false;
}

function comptemots($mot,$caractere){
  $i=0;
  $verifM=false;
  do {
      if ($mot[$i]==$caractere or $mot[$i]==strtoupper($caractere)) {
          $verifM=true;
          break;
      }
      $i++;
      
  } while (!empty($mot[$i]));

  return $verifM;
}


function est_caractere($car){
	return (($car >='a' && $car <='z') || ($car >='A' && $car <='Z'));
}

function verifmot($mot){
  $i=0;
  while (isset($mot[$i])) {
    if(est_caractere($mot[$i])==FALSE){
      return FALSE;
    }
    $i++;
  }
  if($i==0){
    return FALSE;
  }
  return TRUE;
}


function est_chiffre($car){
	return ($car >='0' && $car <='9');
}

function verifnombre($mot){
  $i=0;
  while (isset($mot[$i])) {
    if(est_chiffre($mot[$i])==FALSE){
      return FALSE;
    }
    $i++;
  }
  if($i==0){
    return FALSE;
  }
  return TRUE;
}

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


 ?>
