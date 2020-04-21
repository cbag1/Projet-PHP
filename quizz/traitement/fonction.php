<?php


function connexion($login,$pwd){
    $users=getData();
    foreach($users as $key => $user){
        if($user["login"]===$login && $user["pwd"]===$pwd){
            $_SESSION['user']=$user;
            $_SESSION['statut']="login";
            if($user["role"]==="admin"){
                return "accueil";

            }else{
                return "jeux";
            }
        }
    }
    return "error";
}

function is_connect(){
   if(!isset($_SESSION['statut'])){
       header("location:index.php");
   }  
}
//unset supprime l'existance d'une variable
function deconnection(){
    unset($_SESSION['user']);
    unset($_SESSION['statut']);
    SESSION_destroy();
}

function getData($files="utilisateurs"){
    $data=file_get_contents("./data/".$files.".json");
    $data=json_decode($data, true);
    return $data;
}
//teste si login existe deja

function login_existe($login){
    $data_json=file_get_contents('../data/utilisateurs.json');
    $tab_data=json_decode($data_json, true);
    
    foreach ($tab_data as $value) {
        if($login==$value['login']){
            return TRUE;
        }
    }
    return FALSE;

}

function enregistrer_user($data){
    $data_json=file_get_contents('./data/utilisateurs.json');
    $tab_data=json_decode($data_json, true);
    $tab_data[]=$data;
    $tab_data=json_encode($tab_data);
    if(file_put_contents('./data/utilisateurs.json',$tab_data)){
        return TRUE;
    }else{
        return FALSE;
    }
    
    
}
//uploader fichier 
    function upload_fichier($file){
        $dossier = './public/images/upload/';
        $fichier = basename($file['name']);
            if(move_uploaded_file($file['tmp_name'], $dossier .$fichier)) 
            {
                return True;
            }
            else 
            {
                return False;
            }
}

//teste si le formulaire est valide
    function creer_admin_player($prenom,$nom,$login,$pwd,$C_pwd){
        $tab['prenom']=$prenom;
        $tab['nom']=$nom;
        $tab['login']=$login;
        $tab['pwd']=$pwd;
        $tab['c_pwd']=$C_pwd;
        $users[]=$tab;
        $data=file_put_contents($users);
            $data=json_encode($data);
    
        if(login_exist($login)==true){
            echo 'inscription reussi';
        }else{
            echo 'login existe deja';
        }

    }

?>
