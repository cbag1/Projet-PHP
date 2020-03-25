<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title> Exercice 1</title>
    <link rel="stylesheet" href="exo1.css">
  </head>
  <body>
    <?php
  
      session_start();
      set_time_limit(0); //Ca permet de faire quoi? oKay si je le mets a zero donc y'aura pas de d
      // de delai d'attente donc ça execute la requete jusqu"a la fin NANDIT2 NGA
      include('fonctions.php');
     ?>
     <div id="centrer">
          <div id="formulaire">
          <form action="" method="post">
          <!-- <img src="/serie" alt=""> -->
            <h1 >Entrer un nombre superieur à 10000</h1>
            
              
              <?php
                if (isset($_SESSION['valeur'])) {
                  $val=$_SESSION['valeur'];
                  echo "<input type='text' name='nombre' value=$val >";
                }
                else{
                  echo "<input type='text' name='nombre'/>";
                }
              ?>
              <input type="submit" name="calculer" value="calculer">
          </form>
          </div> 
    
     <div id='tabs'>

     <?php

      
      
        if (isset($_POST['calculer'])) {

          if(isset($_POST['nombre'])){
              
            if(is_numeric($_POST['nombre'])){

              if ($_POST['nombre']>=10000) {
                $_SESSION['valeur']=$_POST['nombre'];
                $_SESSION['tab']=[];
                $valeur=(int)$_POST['nombre'];
                $tab=premier($valeur);
                // var_dump($tab);

                $T=[
                  'inferieur'=>[],
                  'superieur'=>[]
                ];
                // Moyenne + ajout des nombres premiers inferieurs ou superieurs à la moyenne
                $moyenne=moyenne($tab);
                for ($i=0; $i < count($tab); $i++) {
                  if($tab[$i]<$moyenne){
                    $T['inferieur'][]=$tab[$i];
                  }else {
                    $T['superieur'][]=$tab[$i];
                  }
                }
                
                // Affichage par 100
                $nbpagesinf=(int)(count($T['inferieur'])/100);
                $nbpagessup=(int)(count($T['superieur'])/100);
                $_SESSION['nbpinf']=$nbpagesinf;
                $_SESSION['nbsup']=$nbpagessup;

                // echo $nbpagesinf," ";
                // echo $nbpagessup;


                if (empty($_SESSION['tab'])) {
                  $_SESSION['tab']=$T;
                  // Inferieur
                  echo "<div class='tableau' id='tinf'>";
                  echo " <h2>Inferieur</h2>";
                  affichertab(0,$T['inferieur']);
                  echo '</br>';
                  echo "<div class='indice'>";
                  for ($i=0; $i <= $nbpagesinf; $i++) { 
                    echo "<a href='exo1.php?ind_inf=$i&ind_sup=0'>".$i." </a>";
                  }
                  echo "<a href='exo1.php?ind_inf=1&ind_sup=0'> >> </a>";
                  echo '</div>';
                  echo "</div>";

                  // Superieur
                  echo "<div class='tableau'>";
                  echo " <h2>Superieur</h2>";
                  
                  affichertab(0,$T['superieur']);
                  echo '</br>';
                  echo "<div class='indice'>";
                  for ($i=0; $i <= $nbpagessup; $i++) { 
                    echo "<a href='exo1.php?ind_sup=$i&ind_inf=0'>".$i." </a>";
                  }
                  echo "<a href='exo1.php?ind_sup=1&ind_inf=0'> >> </a>";
                  echo '</div>';
                  echo "</div>";
                }
              }else{
                echo " Le nombre entré est inferieur à 10000";
              }
                   
      
            }else{
              echo "Entrer une valeur numerique please";
            }
          }else {
            echo "Le champs est vide";
          }
        }


        // Pour faire la pagination avec la methode GET et la recuperation de la session

        if(isset($_GET['ind_inf']) && isset($_GET['ind_sup'])){
          $ind_inf=(int)$_GET['ind_inf'];
          $ind_sup=(int)$_GET['ind_sup'];
          
          
          $tab=$_SESSION['tab'];

          echo "<div class='tableau' id='tinf'>";
          echo " <h2>Inferieur</h2>";
          // if($ind_inf==$_SESSION['nbpinf']){
          //   affichertab(($ind_inf*100),$tab['inferieur']);
            
          // }else{
            affichertab(($ind_inf*100),$tab['inferieur']);
          // }
          echo "<div class='indice'>";

          // Verifier si $ind_inf est égale à 1
          if($ind_inf!=0){
            echo "<a href='exo1.php?ind_inf=".($ind_inf-1)."&ind_sup=$ind_sup'> << </a>";
          }

            for ($i=0; $i <= $_SESSION['nbpinf']; $i++) { 
              echo "<a href='exo1.php?ind_inf=$i&ind_sup=$ind_sup'>".$i." </a>";
            }
            

            // Verifier si $ind_inf est égale à count(inf)
            if($ind_inf!=$_SESSION['nbpinf']){
              echo "<a href='exo1.php?ind_inf=".($ind_inf+1)."&ind_sup=$ind_sup'> >> </a>";
            }
            
            echo '</div>';
            echo "</div>";
          

          echo "<div class='tableau'>";
          echo " <h2>Superieur</h2>";
          // if($ind_sup==$_SESSION['nbsup']){
          //   affichertab(($ind_sup*100),$tab['superieur']); ////Montre moi ou tu as mis cette fonction
          // }else{
            affichertab(($ind_sup*100),$tab['superieur']);
          // }
          echo "<div class='indice'>";

           // Verifier si $ind_sup est égale à 1
           if($ind_sup!=0){
            echo "<a href='exo1.php?ind_sup=".($ind_sup-1)."&ind_inf=$ind_inf'> << </a>";
          }

          for ($i=0; $i <= $_SESSION['nbsup']; $i++) { 
            echo "<a href='exo1.php?ind_sup=$i&ind_inf=$ind_inf'>".$i." </a>";
          }
           // Verifier si $ind_sup est égale à count(inf)
           if($ind_sup!=$_SESSION['nbsup']){
            echo "<a href='exo1.php?ind_sup=".($ind_sup+1)."&ind_inf=$ind_inf'> >> </a>";
          }

          echo "</div>";
          echo "</div>";
          
        }
      ?>
</div>
</div>
  </body>
</html>
