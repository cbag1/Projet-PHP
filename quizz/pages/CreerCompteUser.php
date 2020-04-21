<?php
require_once("../traitement/fonction.php");
if(isset($_POST['btn_submit'])){

    $fichier_image=$_FILES['file'];

    $data=array(
        "prenom"=> $_POST["prenom"],
        "nom"=> $_POST["nom"],
        "login"=> $_POST["login"],
        "pwd"=> $_POST["pwd"],
        "role"=>"joueur",
        "score"=>"0"   
    );
    // Je verifie si le joueur existe ou pas
    if (!login_existe($data)) {
        // Si c'est le cas je verifie l'etat de l'upload 
        if(upload_fichier($fichier_image)){
            // J'ajoute le nom de l'image dans l'attibut photo de $data
            $data[]=$fichier_image['name'];
            // Je fais l'enregistrement du joueeur + la verification
            if (enregistrer_user($data)) {
                echo "Cool c'est bon ";
            }else{
                echo "Oups dioum amna";
            }
        }else{
            echo " Le fichier n'est pas uploadé";
        }
        
    }else{
        echo " Le login existe deja";
    }
    // $resultat=login_exist_and_data_valid($data);

    // echo 'Inscription Reussie';

    // $receive['avatar']=upload_fichier($FILES);
    // // echo 'insertion reussie';
}

?>
    <div class="b-container">
        <div class="b-header">
            <div class="b-title">CREER ET PARAMETREZ VOS QUIZZ</div>
                <a href="index.php?statut=logout"><button type="submit" class="btn-form-2" name="deconnexion">Deconnection</button></a>
        </div>
            <div class="b-body">
                    <div class="avatar-joueur">
                        <a href="#"><img src="./public/images/img5.jpg" alt=""></a>
                        <h3>Avatar Joueur</h3>
                    </div>
                        <div class="forml">
                            <form action="" method="POST" id="form-connexion">
                                <strong><h4>S'INSCRIRE</h4></strong><br>
                                <h5>Pour tester votre niveau</h5><br>
                                <div class="form-input">
                                    <label for="Prenom">Prenom</label>
                                    <input type="text" class="form-control" error="error-1" name="prenom" id="" placeholder="Prenom ">
                                    <div class="error-form" id="error1"></div>
                                </div>
                                <div class="form-input">
                                    <label for="Prenom">Nom</label>
                                    <input type="text" class="form-control" error="error-1" name="nom" id="" placeholder="Nom ">
                                    <div class="error-form" id="error1"></div>
                                </div>
                                <div class="form-input">
                                    <label for="Prenom">Login</label>
                                    <input type="text" class="form-control" error="error-1" name="login" id="" placeholder="Login ">
                                    <div class="error-form" id="error1"></div>
                                </div>
                                <div class="form-input">
                                    <label for="Prenom">Passwword</label>
                                    <input type="password" class="form-control" error="error-1" name="pwd" id="" placeholder="Passwword ">
                                    <div class="error-form" id="error1"></div>
                                </div>
                                <div class="form-input">
                                    <label for="Prenom">Confirmation Password</label>
                                    <input type="password" class="form-control" error="error-1" name="Cpwd" id="" placeholder="Confirmation Password ">
                                    <div class="error-form" id="error1"></div>
                                </div>
                                <div id="file_img">
                                    <!-- <input type="file" name="avatar"/> -->
                                    <input name="file" id='file' type="file" accept="image/png, image/jpeg">
                                </div><br><br>
                                <div class="form-input">
                                    <button type="submit" class="btn-form" error="error-1" name="btn_submit" id="btn2" >Creer Compte</button>
                                    <div class="error-form" id="error1"></div>
                                </div>
                    
                            </form>
                        </div>
            </div>
    </div>
    <!-- <script type="text/javascript" src="file.js"></script> -->