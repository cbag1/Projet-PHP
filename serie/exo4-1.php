<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exo 4</title>
</head>
<body>
<h1>Enter une phrase -->  F1</h1>
    <form action="" method="post">
        <input type="text" name="phrase" id="">
        <input type="submit" value="Valider" name="val">
    </form>
    <?php
        include('fonctions1.php');
        if (isset($_POST['val'])) {
            $texte=$_POST['phrase'];
            // Appliquer les fonctionnalités de F1
            if (f1($texte)) {
                echo "La phrase est correcte";
            }else{
                echo " La phrase n'est pas correcte";
            }
        }
    ?>

    <h1>Entrer les phrases svp séparées par des points(.)  -->  F2</h1>
    <form action="" method="post">
        <textarea name="texte" id="" cols="30" rows="10"></textarea>
        <input type="submit" value="Valider" name="valider">
    </form>

    <?php
        if (isset($_POST['valider'])) {
            $texte=$_POST['texte'];
            // echo strlen($texte);
            echo '<br>';
            // Fonctionalités F2
            $phrases=preg_split("/([.!?])/", $texte,  -1,
            PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);
            
            $j=0;
            $phrasesCorrectes="";
            if(!empty($phrases)){
                for ($i=0; $i < count($phrases); $i+=2) {   
                    $phrase=f1($phrases[$i]);
                    if (isset($phrases[$i+1])) {
                        $phrase.=$phrases[$i+1];
                    }else{
                        $phrase.=".";
                    }
                    
                    $phrase=supp_espace_inutile($phrase);            
                    $phrasesCorrectes.=$phrase; 
                    
                                   
                }
    
                echo "<textarea cols='30' rows='10'>$phrasesCorrectes </textarea>";
            }else{
                echo "Entrer quelque chose please";
            }
            
        }
    ?>
    
</body>
</html>