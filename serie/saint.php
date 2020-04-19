<?php session_start();
    

    if (!isset($_SESSION['donnees_recup']))
    {
        $donnees_recup =
        [
            'nom' =>[],
            'prenom' =>[],
            'adresse' =>[],
            'numero' =>[],
            'genre' =>[],
            'satisfaction' =>[],
            'langue' =>[],
        ];

        $_SESSION['donnees_recup'] = $donnees_recup;
    }

require_once('function.php');


    if (isset($_POST['valider']))
    {
    // affectation et sécurisation des données saisis
        $_POST['nom'] = strip_tags($_POST['nom']);
        $_POST['prenom'] = strip_tags($_POST['prenom']);
        $_POST['adresse'] = strip_tags($_POST['adresse']);
        $_POST['numero']= strip_tags($_POST['numero']);
        $_POST['config_numero'] = strip_tags($_POST['config_numero']);
        $_POST['comment'] = strip_tags($_POST['comment']);


    // verification du du champs nom
        if (!empty($_POST['nom']))
        {
            $nom_maj_nbrCar = Nom_prenom($_POST['nom']);
            if ($nom_maj_nbrCar)
            {
                $Valide_nom = "Valide";
            }
            else
            {
                $Erreurs_nom = "le nom commence par une lettre majuscule et contient au moins 2 !";
            }
        }
        else
        {
            $Erreurs_nom = "le champs nom doit être rempli !";
        }



    // verification du champs prenom
        if (!empty($_POST['prenom']))
        {
            $prenom_maj_nbrCar = Nom_prenom($_POST['prenom']);
            if ($prenom_maj_nbrCar) {
                $Valide_prenom = "Valide";
            }
            else
            {
                $Erreurs_prenom = "le prenom commence par une lettre majuscule et contient au moins 2 !";
            }
        }
        else
        {
            $Erreurs_prenom = "le champs prenom doit être rempli !";
        }



    // verification du champs adresse
        if (!empty($_POST['adresse']))
        {
            $adresse_nbrCar = adresse($_POST['adresse']);
            if ($adresse_nbrCar)
            {
                $Valide_adresse = "Valide";
            }
            else
            {
                $Erreurs_adresse = "Le champ Adresse contient au moins 5 caractères!";
            }
        }
        else
        {
            $Erreurs_adresse = "le champs adresse doit être rempli !";
        }


    // verification du champs numero
        if (!empty($_POST['numero']))
        {
            $numero_valide = numeroCall($_POST['numero']);
            if ($numero_valide) 
            {
                if (!empty($_POST['numero']) && !empty($_POST['config_numero']))
                {
                    if ($_POST['numero'] == $_POST['config_numero']) {
                        $Valide_numero = "Valide";
                    }
                    else
                    {
                        $Erreurs_numero_confirm = "les numeros doivent être identiques!";
                    }
                }
                else
                {
                    $Erreurs_numero_confirm = "vous devez confirmer votre numero téléphone!";
                }
            }
            else
            {
                $Erreurs_numero = "Le Numéro est composé de 9 chiffres!";
            }
            
        }
        else
        {
            $Erreurs_numero = "le champs numero doit être rempli !";
        }



    // verification du champs genre
        if (!empty($_POST['genre']))
        {
            $Valide_genre = "Valide";
        }
        else
        {
            $Erreurs_genre = "Choisi votre genre!";
        }


    // verification de la satisfaction
        if (!empty($_POST['satisfaction']))
        {
            $Valide_satisfaction = "Valide";
        }
        else
        {
            $Erreurs_satisfaction = "Vous devez repondre d'abord!";
        }


    // verification du champs des langues
        if (!empty($_POST['langues']))
        {
            $nbr_Langues = count($_POST['langues']);
            if ($nbr_Langues>=2)
            {
                $Valide_langues = "Valide";
            }
            else
            {
                $Erreurs_langues = "vous devez choirir au moins 2 choix pour le champ Langue!";
            }
        }
        else
        {
            $Erreurs_langues = "vous devez selectionner deux langues!";
        }



    // Verification du champs Commentaire
        if (!empty($_POST['comment']))
        {
            $comment_val = correcteur_espace($_POST['comment']);
            $comment_val_bis = recuperateur_phrase($comment_val);
            
                $nbr_phrases = count($comment_val_bis);
                if ($nbr_phrases >= 3)
                {
                    $Valide_comment = "cool";
                }
                else
                {
                    $Erreurs_comment = "Le commentaire doit contenir au moins 3 phrases!";
                }   
        }
        else
        {
            $Erreurs_comment = "vous devez saisir un commentaire!";
        }


        if (empty($Erreurs_nom) && empty($Erreurs_prenom) && empty($Erreurs_adresse) && empty($Erreurs_numero) && empty($Erreurs_numero_confirm) && empty($Erreurs_satisfaction) && empty($Erreurs_langues) && empty($Erreurs_genre))
        {
            
            $_SESSION['donnees_recup']['nom'][] = $_POST['nom'];
            $_SESSION['donnees_recup']['prenom'][] = $_POST['prenom'];
            $_SESSION['donnees_recup']['adresse'][] = $_POST['adresse'];
            $_SESSION['donnees_recup']['numero'][] = $_POST['numero'];
            $_SESSION['donnees_recup']['satisfaction'][] = $_POST['satisfaction'];
            $_SESSION['donnees_recup']['genre'][] = $_POST['genre'];
            $_SESSION['donnees_recup']['langue'][] = $_POST['langues'];
            $_SESSION['donnees_recup']['comment'][] = $_POST['comment'];

            
        }

        // var_dump($_SESSION['donnees_recup'])
        
    }

    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
   <div class="formulaire">
   <form action="" method="POST">
        <p>
            <label for="nom">
                Nom
            </label><br>
            <input type="text"  name="nom" value="<?php if (isset($_POST['nom'])) { echo $_POST['nom'];} ?>">
            <span class="Erreurs"><?php if (isset($Erreurs_nom)) { echo $Erreurs_nom;} ?></span>
            <span class="Valide"><?php if (isset($Valide_nom)) { echo $Valide_nom;} ?></span>
        </p>
        <p>
            <label for="prenom">
                Prénom
            </label><br>
            <input type="text"  name="prenom" value="<?php if (isset($_POST['prenom'])) { echo $_POST['prenom'];} ?>">
            <span class="Erreurs"><?php if (isset($Erreurs_prenom)) { echo $Erreurs_prenom;} ?></span>
            <span class="Valide"><?php if (isset($Valide_prenom)) { echo $Valide_prenom;} ?></span>
        </p>
        <p>
            <label for="adresse">
                Adresse
            </label><br>
            <input type="text"  name="adresse" value="<?php if (isset($_POST['adresse'])) { echo $_POST['adresse'];} ?>">
            <span class="Erreurs"><?php if (isset($Erreurs_adresse)) { echo $Erreurs_adresse;} ?></span>
            <span class="Valide"><?php if (isset($Valide_adresse)) { echo $Valide_adresse;} ?></span>
        </p>
        <p>
            <label for="numero">Numéro</label><br>
            <input type="text" name="numero" value="<?php if (isset($numero)) {echo $numero;} ?>">
            <span class="Erreurs"><?php if (isset($Erreurs_numero)) { echo $Erreurs_numero;} ?></span>
            <span class="Valide"><?php if (isset($Valide_numero)) { echo $Valide_numero;} ?></span>
        </p>
        <p>
            <label for="config_numero">
                Confirmation numéro
            </label>
            <input type="text" id="config_numero" name="config_numero" value="<?php if (isset($_POST['config_numero'])) { echo $_POST['config_numero'];} ?>">
            <span class="Erreurs"><?php if (isset($Erreurs_numero_confirm)) { echo $Erreurs_numero_confirm;} ?></span>
        <p>
            Genre <br>
            <label for="homme">
                <input type="radio" id="homme" name="genre" value="Homme">
                Homme
            </label>
            <label for="femme">
                <input type="radio" id="femme" name="genre" value="Femme">
                Femme
            </label>
            <p class="Erreurs"><?php if (isset($Erreurs_genre)) { echo $Erreurs_genre;} ?></p>
            <p class="Valide"><?php if (isset($Valide_genre)) { echo $Valide_genre;} ?></p>
        <p>
            Satisfait <br>
            <label for="oui">
                <input type="radio"  name="satisfaction" value="oui">
                Oui
            </label>
            <label for="non">
                <input type="radio"  name="satisfaction" value="non">
                Non
            </label>
            <p class="Erreurs"><?php if (isset($Erreurs_satisfaction)) { echo $Erreurs_satisfaction;} ?></p>
            <p class="Valide"><?php if (isset($Valide_satisfaction)) { echo $Valide_satisfaction;} ?></p>
        </p>

        <p>
            Langues <br>
            <input type="checkbox" name="langues[]"value="Francais" >
            <label for="langue_fr">Français</label> 
            <input type="checkbox" name="langues[]" value="Anglais">
            <label for="langue_an">Anglais</label> 
            <input type="checkbox" name="langues[]" value="Espagnole">
            <label for="langue_es">Espagnole</label> 
            <input type="checkbox" name="langues[]" value="Postugais">
            <label for="langue_pg">Portugais</label>
            <p class="Erreurs"><?php if (isset($Erreurs_langues)) { echo $Erreurs_langues;} ?></p>
            <p class="Valide"><?php if (isset($Valide_langues)) { echo $Valide_langues;} ?></p>
        </p>
        <p>
            <label for="comment">Commentaire</label><br>
            <textarea name="comment" id="comment" cols="30" rows="10"><?php if (isset($_POST['comment'])) { echo $_POST['comment'];} ?></textarea>
            <span class="Erreurs"><?php if (isset($Erreurs_comment)) { echo $Erreurs_comment;} ?></span>
            <span class="Valide"><?php if (isset($Valide_comment)) { echo $Valide_comment;} ?></span>
        </p>
    <input type="submit" name="valider" value="Valider"> <input type="submit" name="reinitialiser" value="Réinitialiser">
    </form>
   </div>



<div class="tableau_html">

    <table class="table">
            <tr>
                <th>
                    Nom
                </th>
                <th>
                    Prenom
                </th>
                <th>
                    Adresse
                </th>
                <th>
                    Numéro
                </th>
                <th>
                    Genre
                </th>
                <th>
                    Satisfait
                </th>
                <th>
                    Langue
                </th>
            </tr>
        
                <?php
                   for ($i=0; $i < count($_SESSION['donnees_recup']['nom']); $i++) { 
                       echo '<tr>';
                         echo '<td>'.$_SESSION['donnees_recup']['nom'][$i].'</td>';
                         echo '<td>'.$_SESSION['donnees_recup']['prenom'][$i].'</td>';

                         echo '<td>'.$_SESSION['donnees_recup']['adresse'][$i].'</td>';
                       echo '</tr>';
                   }
                   
                ?>
        
    </table>
</div>








<?php




?>