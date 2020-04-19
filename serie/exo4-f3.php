<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exo 4</title>
    <?php
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
</head>
<body>
<h1>Enter une phrase -->  F3</h1>
    <form action="" method="post">
        <input type="text" name="phrase" id="">
        <input type="submit" value="Valider" name="val">
    </form>
    <?php
        if (isset($_POST['val'])) {
            $texte=$_POST['phrase'];
            // Appliquer les fonctionnalités de F3
            $texte=supp_espace_inutile(trim($texte));   
            echo $texte;        
        }
    ?>

    
</body>
</html>