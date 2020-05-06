<?php
is_connect();
// echo $_SESSION['user']['nom'];
// echo $_SESSION['user']['prenom'];
// echo $_SESSION['user']['login'];
// echo $_SESSION['user']['photo'];

?>



<div class="joueur-container">
    <div class="header-joueur">
        <div class="img-joueur">
            <img src="./public/images/upload/<?php echo $_SESSION['user']['photo'] ?>" alt="">
            <div class="textimg"><?php echo $_SESSION['user']['prenom'], " ", $_SESSION['user']['nom'] ?></div>
        </div>
        <div class="header-joueur-text">BIENVENUE SUR LA PLATEFORME DE JEU DE QUIZZ <br>
            JOUER ET TESTER VOTRE NIVEAU DE CULTURE GÉNÉRALE
        </div>
        <div class="header-deconnect">
            <a href="index.php?statut=logout">Deconnexion</a>
        </div>
    </div>

    <div class="body-joueur">
        <div class="joueur-quest">
            <?php
            $questions = getData("questions");
            $nbrquest = getData("settings");
            $nbrquest = (int) $nbrquest['NbrQuestionJeu'];

            if (isset($_GET['numero'])) {
                $i = (int) $_GET['numero'];
            } else {
                $i = 1;
            }


            if ($i <= $nbrquest) {
                echo "<form action='./traitement/traitement.php' method='POST'>";
                echo "<input type='hidden' name='val_i' value=$i />";
                if (isset($tabquest[$i])) {
                    echo "coll";
                } else {
                    $t = array_rand($questions);
                    echo "<input type='hidden' name='indice_i' value=$t />";
                    echo $questions[$t]['question'];
                    echo "<br>";
                    if ($questions[$t]['typeReponse'] == "rmult") {
                        foreach ($questions[$t]['Reponses'] as $key => $value) {
                            echo "<input type='checkbox' name='checked[]'/>";
                            echo $value['valeur'];
                            echo '<br>';
                        }
                    } elseif ($questions[$t]['typeReponse'] == "rsimple") {
                        echo "Simple";
                    } else {
                        echo "tEXT";
                    }
                }





                if ($i > 1) {
                    $j = $i - 1;
                    echo "<input type='submit' name='prec' value='Precedent' /> </br>";
                }
                $i++;
                echo "</br><input type='submit' name='suivant' value='Suivant' /> </br>";
                echo "</form>";
            } else {
                echo " le jeu est Terminé";
            }






















            // echo "<form>";
            // $questions = getData("questions");
            // $nbrquest = getData("settings");
            // $nbrquest = (int) $nbrquest['NbrQuestionJeu'];
            // // echo $nbrquest;
            // $t = array_rand($questions);

            // echo $questions[$t]['question'];
            // echo "<br>";
            // if ($questions[$t]['typeReponse'] == "rmult") {
            //     foreach ($questions[$t]['Reponses'] as $key => $value) {
            //         echo $value['valeur'];
            //         echo '<br>';
            //     }
            // } elseif ($questions[$t]['typeReponse'] == "rsimple") {
            //     echo "Simple";
            // } else {
            //     echo "tEXT";
            // }
            // // echo "<pre>";
            // // print_r($questions[$t]);
            // // echo "</pre>";
            // echo "</form>";
            ?>


        </div>
        <div class="top-joueurs">
            <div class="top-menu">
                <ul>
                    <li><a href="#">Top Score</a></li>
                    <li><a href="#">Mon Meilleur Score</a></li>
                </ul>
            </div>
            <div class="top-menu-content">
                <table class="topj">
                    <?php
                    $users = file_get_contents('./data/utilisateur.json');
                    $users = json_decode($users, true);
                    // print_r($users);
                    foreach ($users as $value) {
                        if ($value['profil'] == "joueur") {
                            $joueurs[] = $value;
                        }
                    }
                    $columns = array_column($joueurs, 'score');
                    array_multisort($columns, SORT_DESC, $joueurs);
                    $i = 0;
                    foreach ($joueurs as $value) {
                        echo '<tr>';
                        echo '<td>' . $value['nom'] . '</td>';
                        echo '<td>' . $value['prenom'] . '</td>';
                        echo '<td id="coll">' . $value['score'] . ' pts</td>';
                        echo '</tr>';
                        $i++;
                        if ($i == 5) {
                            break;
                        }
                    }



                    //                    $joueurs=[];
                    //                    foreach($data as $key=>$value){
                    //                       if ($value['profil']==="joueur"){
                    //                            $joueurs[]=$value;
                    //                       }
                    //                   }
                    //
                    //                    $colonne=array_column($joueurs, 'score');
                    //                    array_multisort($colonne, SORT_DESC, $joueurs);
                    //
                    //                    foreach ($joueurs as $value) {
                    //                       // Ici tu fais l'affichage
                    //                    }

                    //

                    ?>
                </table>
            </div>
        </div>
    </div>
</div>