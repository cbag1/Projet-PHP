<?php
 is_connect();
?>
    <div class="admin-content">
        <div class="admin-header">
            <div class="admin-header-text">CRÉER ET PARAMETRER VOS QUIZZ</div>
            <div>
               <a href="index.php?statut=logout" class="player-form link-logout">Se deconnecter</a> 
            </div>
        </div>
        <div class="admin-body">
                    <div class="info-user">
                        <div class="info-header">
                            <div class="info-header-img">
                                <img src="./public/images/upload/<?php echo $_SESSION['user']['photo'] ?>" >
                            </div>
                            <div class="info-header-text">Cheikh Babacar <br> GOUDIABY</div>
                        </div>
                        <div class="info-liste">
                            <div class="info-liste-title info-liste-title-active">
                                <a href="#">
                                    <div class="icon-info-liste icon-info-liste-question"></div>
                                    <div class="info-liste-text"> Liste des Questions</div>
                                </a>
                            </div>

                            <div class="info-liste-title">
                                <a href="index.php?lien=accueil&menu=creer-admin">
                                    <div class="icon-info-liste icon-info-create-user"></div>
                                    <div class="info-liste-text"> Creer Admin </div>
                                </a>
                            </div>
                            <div class="info-liste-title">
                                <a href="index.php?lien=accueil&menu=liste-joueur">
                                    <div class="icon-info-liste icon-info-liste-joueur"></div>
                                    <div class="info-liste-text"> Liste Joueurs</div>
                                </a>
                            </div>
                            <div class="info-liste-title">
                                <a href="index.php?lien=accueil&menu=creer-question">
                                    <div class="icon-info-liste icon-info-create-user"></div>
                                    <div class="info-liste-text">  Creer Questions</div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="liste-content">
                        <?php
                            if (isset($_GET['menu']) ) {
                                switch ($_GET['menu']) {
                                    case 'liste-joueur':
                                        require_once("./pages/liste_joueurs.php");
                                        break;
                                    
                                    case 'creer-admin':
                                        require_once("./pages/signup.php");
                                        break; 
                                    
                                    case 'creer-question':
                                        require_once('./pages/creerquestions.php');
                                        break;
                                }
                            }else{
                                require_once("./pages/liste_joueurs.php");
                            }
                        ?>
                    </div> 
        </div>
        
    </div>
<!-- </div>    -->
<!-- </body>
</html> -->