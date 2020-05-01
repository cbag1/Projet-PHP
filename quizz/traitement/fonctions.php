<?php

function connexion($login, $pwd)
{
    $users = getData();
    foreach ($users as $key => $user) {
        if ($user['login'] === $login && $user['password'] === $pwd) {
            $_SESSION['user'] = $user;
            $_SESSION['statut'] = "login";
            if ($user['profil'] === "admin") {
                return "accueil";
            } else {
                return "jeux";
            }
        }
    }
    return "error";
}

function ajout_user($user)
{
}

function upload_f($file)
{
    $dossier = '/opt/lampp/htdocs/Projet-PHP/quizz/public/images/upload/';
    $fichier = basename($file['name']);
    if (move_uploaded_file($file['tmp_name'], $dossier . $fichier)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
    {
        // chmod("/opt/lampp/htdocs/Projet-PHP/quizz/public/images/upload/", 0755);
        // header('location:../index.php');
        return True;
    } else //Sinon (la fonction renvoie FALSE).
    {
        return FALSE;
    }
}

function is_connect()
{
    if (!isset($_SESSION['statut'])) {
        header("location:index.php");
    }
}


function deconnexion()
{
    unset($_SESSION['user']);
    unset($_SESSION['statut']);
    session_destroy();
}


function getData($file = "utilisateur")
{
    $data = file_get_contents("./data/" . $file . ".json");
    $data = json_decode($data, true);
    return $data;
}

function AjoutData($namefile, $data)
{
    $datafile = getData($namefile);
    $datafile[] = $data;
    $datafile = json_encode($datafile);
    if (file_put_contents("./data/". $namefile . ".json", $datafile)) {
        return true;
    } else {
        return false;
    }
}


function dump_profile($profil){
    $utilisateur=getData();
    foreach ($utilisateur as $key => $value) {
        if($value['profil']==$profil){
            $joueurs[]=$value;
        }
    }
    return $joueurs;
}
