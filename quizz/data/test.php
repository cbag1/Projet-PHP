<?php
function connexion($login,$pwd){
    $users=getData();
    foreach($users as $key => $user){
        if($user["login"]===$login && $user["pwd"]===$pwd){
           
            $_SESSION['statut']="login";
            $_SESSION['user']=$user;
            if($user["role"]==="admin"){
                return "accueil";

            }else{
                return "jeux";
            }
        }
    }
    return "error";
}


if (empty($_POST['question']) || empty($_POST['reponse'])) {
    echo "<h3> Tous les champ est obligatoir<h3>";
 }else {
      $data=array();
      $data['question']=$_POST['question'];
      $data['nbr_point']=$_POST['nbr_point'];
      $data[]=array("reponse");
      $json=file_get_contents('../data/question.json');
      $json=json_decode($json,true);
      $json[]=$data;
      $json=json_encode($json);
      file_put_contents('../data/question.json',$json);
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
    session_destroy();
}
//recupere fichier json
function getData($files="utilisateurs"){
    $data=file_get_contents("./data/".$files.".json");
    $data=json_decode($data, true);
    return $data;
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

    //teste si login existe deja
function login_existe($login){
    $data_json=file_get_contents('./data/utilisateurs.json');
    $tab_data=json_decode($data_json, true);
    
    foreach ($tab_data as $value) {
        if($login==$value['login']){
            return TRUE;
        }
    }
    return FALSE;
}
//enregistrer user
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
//liste meilleur score
function list_meilleur_score(){
    $data_json=file_get_contents('./data/utilisateurs.json');
    $tab_data=json_decode($data_json, true);
    $column=array_column($tab_data, 'score');
    array_multisort($column, SORT_DESC, $tab_data);
        $i=0;
    foreach ($tab_data as $value){
        echo '<tr>';
            echo '<td>'.$value['prenom'].'</td>'.'<br>';
            echo '<td>'. $value['nom'].'</td>'.'<br>';
            echo '<td>'. $value['score'].'</td>'.'<br>';
        echo '</tr>';
        $i++;
            if($i==5){
            break;
            }
        }
    }

//pagination liste joueurs
function pagination ($tab_player){
    $NumPage=0;
    $NbValeurTotal = count( $tab_player);
    $NbValeurParPage = 15;
    $NbPages = ceil($NbValeurTotal / $NbValeurParPage);
    if (isset($_GET['page'])) {
        $NumPage = $_GET['page'];
    }else{
        $NumPage=1;
    }
    $IndiceDebut = ($NumPage - 1) * $NbValeurParPage;
    $IndiceFin = $IndiceDebut + $NbValeurParPage - 1;
    for ($i=$IndiceDebut; $i<=$IndiceFin; $i++){
        if (array_key_exists($i, $tab_player)) {
            echo '<tr>';
                echo '<td>' . $tab_player[$i]['prenom'] . '</td>';
                echo '<td>' . $tab_player[$i]['nom'] . '</td>';
                echo '<td>' . $tab_player[$i]['score'] . ' pts</td>';
            echo '</tr>';
        }

    }
    echo '</table>';
    echo '<div class="div">';
    if ($NumPage > 1){
        $precedent= $NumPage - 1;
        echo '<a class="pre"  href="index.php?lien=accueil&menu=liste_joueur&page='.$precedent.'">PRECEDANT</a>';
    }

    if ($NumPage != $NbPages){
        $suivant= $NumPage + 1;
        echo '<a class="sui" href="index.php?lien=accueil&menu=liste_joueur&page='.$suivant.'">SUIVANT</a>';
    }

    echo '</div>';
}


// Pagination Liste Question
function pagination_quest ($tab_player){
    $NumPage=0;
    $NbValeurTotal = count( $tab_player);
    $NbValeurParPage = 5;
    $NbPages = ceil($NbValeurTotal / $NbValeurParPage);
    if (isset($_GET['page'])) {
        $NumPage = $_GET['page'];
    }else{
        $NumPage=1;
    }
    $IndiceDebut = ($NumPage - 1) * $NbValeurParPage;
    $IndiceFin = $IndiceDebut + $NbValeurParPage - 1;
    for ($i=$IndiceDebut; $i<=$IndiceFin; $i++){
        if (array_key_exists($i, $tab_player)) {
            echo '<tr>';
                echo '<td>' . $tab_player[$i]['question'] . '</td>';
                // echo '<td>' . $tab_player[$i]['choix'] . '</td>';
                if($tab_player[$i]['choix']=="multiple"){
                    foreach ($tab_player[$i]['Reponse'] as $k => $val) {
                        echo "<input type='checkbox' name='checked_$k' ";
                        if($val=="true"){echo "checked";} echo "/> $k <br>";
                    }
                }elseif($tab_player[$i]['choix']=="simple"){
                    foreach ($tab_player[$i]['Reponse'] as $k => $val) {
                        echo "<input type='radio' name='choix_radio_$k' ";
                        if($val=="true"){echo "checked";} echo "/> $k <br>";
                     }
                }else{
                    echo "<input type='text' name='reptexte' value=".$$tab_player[$i]['ReponseTexte']." readonly> <br>";
                }
            echo '</tr>';
        }

    }
    echo '</table>';
    echo '<div class="div">';
    if ($NumPage > 1){
        $precedent= $NumPage - 1;
        echo '<a class="pre"  href="index.php?lien=accueil&menu=liste_joueur&page='.$precedent.'">PRECEDANT</a>';
    }

    if ($NumPage != $NbPages){
        $suivant= $NumPage + 1;
        echo '<a class="sui" href="index.php?lien=accueil&menu=liste_joueur&page='.$suivant.'">SUIVANT</a>';
    }

    echo '</div>';
}

//recupere fichier json de creer_question
function get_Data($files="questions"){
    $data_quiz=file_get_contents("./data/".$files.".json");
    $data_quiz=json_decode($data_quiz, true);
    return $data_quiz;
}

//enregistrer question
function enregistrer_quiz($data_quiz){
    $data_json_quiz=file_get_contents('./data/questions.json');
    $tab_data_quiz=json_decode($data_json_quiz, true);
    $tab_data_quiz[]=$data_quiz;
    $tab_data_quiz=json_encode($tab_data_quiz);
    if(file_put_contents('./data/questions.json',$tab_data_quiz)){
        return TRUE;
    }else{
        return FALSE;
    }    
}

//pagination_question
function pagination_question ($tab_data_quiz){
    $NumPage=0;
    $NbValeurTotal = count($tab_data_quiz);
    $NbValeurParPage = 1;
    $NbPages = ceil($NbValeurTotal / $NbValeurParPage);
    if (isset($_GET['page'])) {
        $NumPage = $_GET['page'];
    }else{
        $NumPage=1;
    }
    $IndiceDebut = ($NumPage - 1) * $NbValeurParPage;
    $IndiceFin = $IndiceDebut + $NbValeurParPage - 1;
    for ($i=$IndiceDebut; $i<=$IndiceFin; $i++){
        if (array_key_exists($i, $tab_data_quiz)) {
               echo $value['question'];
        }

    }
    echo '</table>';
    echo '<div class="div">';
    if ($NumPage > 1){
        $precedent= $NumPage - 1;
        echo '<a class="pre"  href="index.php?lien=jeux=page='.$precedent.'">PRECEDANT</a>';
    }

    if ($NumPage != $NbPages){
        $suivant= $NumPage + 1;
        echo '<a class="sui" href="index.php?lien=jeux=page='.$suivant.'">SUIVANT</a>';
    }

    echo '</div>';
}

//pagination_list_quiz
function pagination_list_quiz ($tab_data_quiz){
    $NumPage=0;
    $NbValeurTotal = count( $tab_data_quiz);
    $NbValeurParPage = 5;
    $NbPages = ceil($NbValeurTotal / $NbValeurParPage);
    if (isset($_GET['page'])) {
        $NumPage = $_GET['page'];
    }else{
        $NumPage=1;
    }
    $IndiceDebut = ($NumPage - 1) * $NbValeurParPage;
    $IndiceFin = $IndiceDebut + $NbValeurParPage - 1;
        foreach($tab_data_quiz as $key => $value){
            if($key>=$IndiceDebut && $key<=$IndiceFin){
                echo '<tr>';
                    echo $value['question']; 
                echo '</tr>';
            }
        }
    echo '</table>';
    echo '<div class="div">';
    if ($NumPage > 1){
        $precedent= $NumPage - 1;
        echo '<a class="pre"  href="index.php?lien=accueil&menu=liste_question&page='.$precedent.'">PRECEDANT</a>';
    }

    if ($NumPage != $NbPages){
        $suivant= $NumPage + 1;
        echo '<a class="sui" href="index.php?lien=accueil&menu=liste_question&page='.$suivant.'">SUIVANT</a>';
    }

    echo '</div>';
}

?>
