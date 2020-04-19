<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercice 3</title>
    <link rel="stylesheet" href="exo3.css">
    <?php
        session_start();
        include('fonctions.php');

        // Supprimer les session
        if(isset($_SESSION['val'])){
            for ($i=1; $i <=(int) $_SESSION['val']; $i++) { 
                $mot="mot".$i;
                $indice="m".$i;
                unset($_SESSION[$mot],$_SESSION[$indice]);
            }
            
            unset($_SESSION['bon']);
        }

        if (isset($_POST['calcul'])) {
            // unset($_SESSION['gen']);
            if (verifnombre($_POST['nb'])) {
                unset($_SESSION['error']);
                $_SESSION['gen']=TRUE;
                $_SESSION['val']=(int)$_POST['nb'];
            }else{
                
                if(isset($_SESSION['bon'])){
                    unset($_SESSION['bon']);
                }
                $_SESSION['error']="Entrer un valeur exacte ngir Yallah";
            }
        }

        if(isset($_POST['result'])){
            $_SESSION['gen']=TRUE;
            $verif_bon=0;
            $comptem=0;
            for ($i=1; $i <=$_SESSION['val'] ; $i++) { 
                $mot="mot".$i;
                $p="p".$i;
                $_SESSION[$mot]=$_POST[$p];
                
                if (verifmot($_POST[$p])) {
                    if (verifcompteur($_POST[$p],20)) {
                        $indice="m".$i;
                        unset($_SESSION[$indice]);
                        if(comptemots($_POST[$p],'m')){
                            $comptem++;
                        }
                        
                    }else{
                        $indice="m".$i;
                        $_SESSION[$indice]=" Plus 20 caracteres beugouma liiii";
                        $verif_bon++;
                    }
                }else{
                    $indice="m".$i;
                    $_SESSION[$indice]=" Des lettres seulement begouma liii";
                    $verif_bon++;
                }
            }

            $_SESSION['bon']=$verif_bon;
            $_SESSION['mot_m']=$comptem;
        }
    ?>
</head>
<body>
    <div class="page">
                <div class="nbform" align="center">
                    <form action="" method="post">
                            <label for="nb">Combien de mots</label><br>
                            <input type="text" name="nb" id="nb"><br>
                            <?php 
            

                                if (isset($_SESSION['error'])) {
                                    echo "<span class='errortext'>".$_SESSION['error']."</span> </br>";
                                    unset($_SESSION['error']);
                                }
                            ?>
                           <div id="nbsubmit">
                                <input type="submit" value="Valider" name="calcul">
                                <input type="reset" value="Annuler">
                           </div>
                    </form>
                </div>
            

            <?php
                

                if(isset($_SESSION['gen']) && $_SESSION['gen']==TRUE){
                    echo "<div class='generer'>";
                    echo "<form method='POST'>";
                    
                    for ($i=1; $i <=$_SESSION['val'] ; $i++) { 
                        echo "<label> Mot ".$i."</label>";
                        $indice="m".$i;
                        if (isset($_SESSION[$indice])) {
                            echo "<span class='errortext'>".$_SESSION[$indice]."</span>";
                        }
                        echo "<br>";
                        $mot="mot".$i;
                        if (isset($_SESSION[$mot])) {
                            $p="p".$i;
                            echo "<input type='text' name=$p value=".$_SESSION[$mot]."></input>";
                        }else{
                            $p="p".$i;
                            echo "<input type='text' name=$p></input></br>";
                        }
                        
                    }

                    echo "<input type='submit' value='Resultat' name='result' id='result'  />";
                    echo "</form>";
                    echo "</div>";

                    $_SESSION['gen']=FALSE;
                }

                
                
            ?>
  </div>  

  <?php
    
    if(isset($_SESSION['bon']) && $_SESSION['bon']==0){
        echo "<div class='reponse'>";
        echo "<h1>";
        echo " Vous avez entré ",$_SESSION['val']," Mots dont ";
        echo "<span>".$_SESSION['mot_m']," contenant la lettre M </span>";
        echo "</h1>";
        echo "</div>";
    }
    
  ?>
</body>
</html>