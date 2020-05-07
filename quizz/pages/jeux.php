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

            // if (isset($_SESSION['tabindex'])) {
            //     $tabquest=$_SESSION['tabindex'];
            // }

            if (isset($_GET['numero'])) {
                $tabquest = $_SESSION['tabindex'];
                // echo "<pre>";
                // print_r($_SESSION['tabindex']);
                // echo "</pre>";
                $i = (int) $_GET['numero'];
            } else {
                $i = 1;
                $_GET['numero'] = $i;
                $_SESSION['tabindex'] = [];
            }

            // Creation de la session qui garde les index
            if (!isset($_SESSION['tabindex']['index'])) {
                $_SESSION['tabindex']['index']=[];
            }

            if ($i <= $nbrquest) {
                echo "<form action='./traitement/traitement.php' method='POST'>";
                echo "<input type='hidden' name='val_i' value=$i />";
                echo "<input type='hidden' name='choice' value= />";


                if (isset($tabquest[$_GET['numero']])) {

                    echo "Deja fait";
                    echo "<div class='show_quest'>";
                    $t = (int) $tabquest[$_GET['numero']][0];
                    echo "<input type='hidden' name='indice_i' value=$t />";
                    echo "<input type='hidden' name='choice' value=" . $questions[$t]['typeReponse'] . " />";
                    echo "<h1>Question " . $_GET['numero'] . "/" . $nbrquest . "</h1>";
                    echo "<h3>" . $questions[$t]['question'] . "</h3>";
                    echo "<br>";
                    echo "</div>";
                    echo "<br>";
                    echo "<div class='nbrpoints'>" . $questions[$t]['nbpoints'] . " pts</div>";
                    echo "<div class='rep_question'>";
                    if ($questions[$t]['typeReponse'] == "rmult") {
                        foreach ($questions[$t]['Reponses'] as $key => $value) {
                            if (in_array(strval($key), $tabquest[$_GET['numero']][1])) {
                                echo "<input type='checkbox' name='checked[]' value='$key' checked/>";
                            } else {
                                echo "<input type='checkbox' name='checked[]' value='$key'/>";
                            }

                            echo "<span>" . $value['valeur'] . "</span>";
                            echo '<br>';
                            echo '<br>';
                        }
                    } elseif ($questions[$t]['typeReponse'] == "rsimple") {
                        foreach ($questions[$t]['Reponses'] as $key => $value) {
                            // echo $tabquest[$_GET['numero']][1];
                            if ($key ==(int)  $tabquest[$_GET['numero']][1]) {
                                echo "<input type='radio' name='radio' value='$key' checked />";
                            } else {
                                echo "<input type='radio' name='radio' value='$key'/>";
                            }

                            echo "<span>" . $value['valeur'] . "</span>";
                            echo '<br>';
                            echo '<br>';
                        }
                    } elseif ($questions[$t]['typeReponse'] == "rtexte") {
                        echo "<input type='text' name='texte' value='" . $tabquest[$_GET['numero']][1] . "' /> </br>";
                    }
                    echo "</div>";
                } else {
                    $t = array_rand($questions);
                    while(in_array($t,$_SESSION['tabindex']['index'])){
                        $t = array_rand($questions);
                    }
                    echo "<input type='hidden' name='indice_i' value=$t />";
                    echo "<div class='show_quest'>";
                    echo "<h1>Question " . $_GET['numero'] . "/" . $nbrquest . "</h1>";
                    echo "<h3>" . $questions[$t]['question'] . "</h3>";
                    echo "</div>";
                    echo "<input type='hidden' name='choice' value=" . $questions[$t]['typeReponse'] . " />";

                    echo "<br>";
                    // $_SESSION['tabindex'][$_GET['numero']][0] = $t;
                    echo "<div class='nbrpoints'>" . $questions[$t]['nbpoints'] . " pts</div>";
                    echo "<div class='rep_question'>";
                    if ($questions[$t]['typeReponse'] == "rmult") {
                        foreach ($questions[$t]['Reponses'] as $key => $value) {
                            echo "<input type='checkbox' name='checked[]' value='$key'/>";
                            echo "<span>" . $value['valeur'] . "</span>";
                            echo '<br>';
                            echo '<br>';
                        }
                    } elseif ($questions[$t]['typeReponse'] == "rsimple") {
                        foreach ($questions[$t]['Reponses'] as $key => $value) {
                            echo "<input type='radio' name='radio' value='$key' />";
                            echo "<span>" . $value['valeur'] . "</span>";
                            echo '<br>';
                            echo '<br>';
                        }
                    } else {
                        echo "<input type='text' name='texte' /> </br>";
                    }

                    echo "</div>";
                }




                echo "<div class='soumettre'>";
                if ($i > 1) {
                    $j = $i - 1;
                    echo "</br><input type='submit' name='prec' value='Precedent' style='background-color:grey;' /> ";
                }
                $i++;
                echo "<input type='submit' name='suivant' value='Suivant' style='float:right; background-color:#39DDD6;' /> </br>";

                echo "</div>";
                echo "</form>";
            } else {
                echo " le jeu est Terminé </br>";
                // echo "<pre>";
                // print_r($_SESSION['tabindex']);
                // echo "</pre>";

                for ($i = 1; $i <= $nbrquest; $i++) {
                    $indice = $_SESSION['tabindex'][$i][0];
                    $rep = $_SESSION['tabindex'][$i][1];
                    echo "<pre>";
                    print_r($rep);
                    echo "</pre>";
                    if ($questions[$indice]['typeReponse'] == "rmult") {
                        $bool = true;
                        foreach ($questions[$indice]['Reponses'] as $key => $value) {
                            if ($value['statut'] == "true") {
                                if (in_array($key, $rep)) {
                                    $bool = true;
                                } else {
                                    $bool = false;
                                    break;
                                }
                            } else {
                                if (!in_array($key, $rep)) {
                                    $bool = true;
                                } else {
                                    $bool = false;
                                    break;
                                }
                            }
                            if (!$bool) {
                                echo "Réponsev False";
                            } else {
                                echo "Réponsev True";
                            }
                        }
                    } elseif ($questions[$indice]['typeReponse'] == "rsimple") {
                        $bool = true;
                        foreach ($questions[$indice]['Reponses'] as $key => $value) {
                            if ($value['statut'] == "true") {
                                if ($key == $rep) {
                                    $bool = true;
                                } else {
                                    $bool = false;
                                    break;
                                }
                            } else {
                                if ($key != $rep) {
                                    $bool = true;
                                } else {
                                    $bool = false;
                                    break;
                                }
                            }
                            if (!$bool) {
                                echo "Réponsev False";
                            } else {
                                echo "Réponsev True";
                            }
                        }
                    } else {
                        $bool = true;
                        if ($questions[$indice]['ReponseTexte'] != $rep) {
                            $bool = false;
                        }

                        if (!$bool) {
                            echo "Réponsev False";
                        } else {
                            echo "Réponsev True";
                        }
                    }
                    // echo $questions[$indice]['question'];
                    echo "</br>";
                }
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