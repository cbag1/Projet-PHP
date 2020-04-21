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
            <div class="textimg"><?php echo $_SESSION['user']['prenom']," ", $_SESSION['user']['nom'] ?></div>
        </div>
        <div class="header-joueur-text">BIENVENUE SUR LA PLATEFORME DE JEU DE QUIZZ <br>
           JOUER ET TESTER VOTRE NIVEAU DE CULTURE GÉNÉRALE
        </div>
        <div class="header-deconnect">
          <a href="index.php?statut=logout">Deconnexion</a>
        </div>
    </div>

    <div class="body-joueur">
        <div class="joueur-quest"></div>
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
                    $users=file_get_contents('./data/utilisateur.json');
                    $users=json_decode($users,true);
                    // print_r($users);
                    foreach ($users as $value) {
                        if ($value['profil']=="joueur") {
                            $joueurs[]=$value;
                        }
                    }
                    $columns=array_column($joueurs, 'score');
                    array_multisort($columns, SORT_DESC, $joueurs);
                    $i=0;
                    foreach ($joueurs as $value) {
                        echo '<tr>';
                            echo '<td>'.$value['nom'].'</td>';
                            echo '<td>'.$value['prenom'].'</td>';
                            echo '<td id="coll">'.$value['score'].' pts</td>';
                        echo '</tr>';
                        $i++;
                        if ($i==5) {
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
