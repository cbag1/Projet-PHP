<?php

$users = file_get_contents('./data/utilisateur.json');
$users = json_decode($users, true);
require_once("./traitement/fonctions.php");
if (isset($_POST['btn_submit'])) {
    $fichier = $_FILES['file'];
    if ($_GET['lien'] == "inscription_joueur") {
        $role = "joueur";
    } else {
        $role = "admin";
    }
    $user = array(
        'prenom' => $_POST['prenom'],
        'nom' => $_POST['nom'],
        'login' => $_POST['login'],
        'password' => $_POST['pwd'],
        'profil' => $role,
        'photo' => $fichier['name'],
        'score' => 0
    );
    $user_existe = FALSE;
    foreach ($users as $value) {
        if ($value['login'] == $user['login']) {
            $user_existe = TRUE;
            break;
        }
    }
    if (!$user_existe) {
        if (upload_f($fichier)) {
            $users[] = $user;
            $final_users = json_encode($users);
            if (file_put_contents('./data/utilisateur.json', $final_users)) {
               if($_GET['lien']=="inscription_joueur"){
                   header('location: ./index.php');
               }
            } else {
                echo ("Pas Cool");
            }
        }
    } else {
        echo "Ce User existe";
    }
}
?>

<div class="signup-content">
    <div class="signup-header">
        <div class="title-inscription"> S'inscrire</div>
        <div class="subtitle">Pour tester votre niveau de culture générale</div>
    </div>

    <div class="signup-left">
        <hr>
        <div class="signup-body">
            <form action="" method="post" id="form-signup" enctype="multipart/form-data">
                <div class="input-form">
                    <label for="login"> Prenom</label>
                    <input class="form-control" error="error-0" type="text" name="prenom" id="prenom" placeholder="Aaaaaa">
                    <div class="error-form" id="error-0"></div>
                </div>
                <div class="input-form">
                    <label for="login"> Nom</label>
                    <input class="form-control" error="error-1" type="text" name="nom" id="nom" placeholder="Bbbbbb">
                    <div class="error-form" id="error-1"></div>
                </div>
                <div class="input-form">
                    <label for="login"> Login</label>
                    <input class="form-control" error="error-2" type="text" name="login" id="login" placeholder="Aaaaaa">
                    <div class="error-form" id="error-2"></div>
                </div>
                <div class="input-form">
                    <label for="password">Password</label>
                    <input class="form-control" error="error-3" type="password" name="pwd" id="pwd" placeholder="Password">
                    <div class="error-form" id="error-3"></div>
                </div>
                <div class="input-form">
                    <label for="c-password">Confirm Password</label>
                    <input class="form-control" error="error-4" type="password" name="pwd1" id="pwd1" placeholder="Password">
                    <div class="error-form" id="error-4"></div>
                </div>
                <div class="input-form">
                    <label for="file">Avatar</label>
                    <input name="file" error="error-5" id='file' type="file" class="file-form" accept="image/png, image/jpeg" onchange="load_file(this)">
                    <div class="error-form" id="error-5"></div>
                </div>
                <div class="input-form">
                    <button type="submit" class="btn-form1" name="btn_submit">Créer Compte</button>
                </div>
            </form>
        </div>
    </div>
    <div class="signup-right">
        <div class="imground">
            <img src="" alt="avatar user" id='imguser'>
        </div>
    </div>
</div>

<script>
    const inputs = document.getElementsByTagName("input");
for(input of inputs ){
     input,addEventListener("keyup",function(e){
         if(e.target.hasAttribute("error")){
            var idDivError= e.target.getAttribute("error");
            document.getElementById(idDivError).innerText=""
         }
     })
}

function load_file(avatar){
    let image=document.getElementById("imguser");
    image.src=window.URL.createObjectURL(avatar.files[0]);
}

document.getElementById("form-signup").addEventListener("submit",function(e){


  var error=false;
  for(input of inputs){
      
    if (input.hasAttribute("error")) {
            var idDivError= input.getAttribute("error");
                if (!input.value) { 
                        document.getElementById(idDivError).innerText="Ce champ est obligatoire";
                        error=true;
                    }
                    
    }
  }
  var idpwd=document.getElementById('pwd').value;
  var idpwd1=document.getElementById('pwd1').value;

  if (idpwd!=idpwd1) {
      document.getElementById('error-4').innerText="Les Mots de passe sont differents";
    alert("Errror Mot de Passe");
      error=true;
  }

  
  if (error) {
    e.preventDefault();
    return false;
  }
   
});
</script>