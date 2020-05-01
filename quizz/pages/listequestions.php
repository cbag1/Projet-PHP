<?php
require_once("./traitement/fonctions.php");
?>
<div style="height:100%;">
    <div class="nbraffichage">
        <span>Nbre de question/Jeu</span>
        <input type="text" name="nbre">
        <button>OK</button>
    </div>
    <div>
        <?php
        $listequestions = getData('questions');

        foreach ($listequestions as $key => $value) {
            echo "<h2>" . $value['question'] . "</h2>";
            $choix = "";
            $is_texte = true;
            if ($value['typeReponse'] == "rmult" || $value['typeReponse'] == "rsimple") {
                $is_texte = false;
            }

            if ($is_texte) {
                echo "<input type='text' value=" . $value['ReponseTexte'] . " disabled>";
            } else {
                if ($value['typeReponse'] == "rmult") {
                    foreach ($value['Reponses'] as $val) {
                        if ($val['statut']) {
                            echo "<input type='checkbox' checked disabled/> " . $val['valeur'] . " <br/>";
                        } else {
                            echo "<input type='checkbox' disabled/> " . $val['valeur'] . " <br/>";
                        }
                    }
                } else {
                    foreach ($value['Reponses'] as $val) {
                        if ($val['statut']) {
                            echo "<input type='radio' checked disabled/> " . $val['valeur'] . " <br/>";
                        } else {
                            echo "<input type='radio' disabled/> " . $val['valeur'] . " <br/>";
                        }
                    }
                }
            }
        }
        ?>
    </div>

</div>