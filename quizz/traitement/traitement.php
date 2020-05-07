<?php
session_start();
if (isset($_POST['suivant'])) {
    // var_dump($_POST);
    if ($_POST['choice'] == "rmult") {
        if (!isset($_POST['checked'])) {
            $_POST['checked'][] = '';
        }
        $_SESSION['tabindex'][$_POST['val_i']] = array($_POST['indice_i'], $_POST['checked']);
    } elseif ($_POST['choice'] == "rsimple") {
        if (!isset($_POST['radio'])) {
            $val = "-1";
        } else {
            $val = $_POST['radio'];
        }
        $_SESSION['tabindex'][$_POST['val_i']] = array($_POST['indice_i'], $val);
    } else {
        $_SESSION['tabindex'][$_POST['val_i']] = array($_POST['indice_i'], $_POST['texte']);
    }
    $type = 'type_' . $_POST['val_i'];
    $_SESSION['tabindex'][$type] = $_POST['choice'];
    $i = (int) $_POST['val_i'] + 1;
    // var_dump($_SESSION['tabindex']);
    // unset($_SESSION['tabindex']);

    // Verifier si l'index est deja choisi

    if (!in_array($_POST['indice_i'], $_SESSION['tabindex']['index'])) {
        $_SESSION['tabindex']['index'][] = $_POST['indice_i'];
    }


    header("location:../index.php?lien=jeux&numero=$i");
}
if (isset($_POST['prec'])) {
    if ($_POST['choice'] == "rmult") {
        if (!isset($_POST['checked'])) {
            $_POST['checked'][] = '-1';
        }
        $_SESSION['tabindex'][$_POST['val_i']] = array($_POST['indice_i'], $_POST['checked']);
    } elseif ($_POST['choice'] == "rsimple") {
        if (!isset($_POST['radio'])) {
            $val = "-1";
        } else {
            $val = $_POST['radio'];
        }
        $_SESSION['tabindex'][$_POST['val_i']] = array($_POST['indice_i'], $val);
    } else {
        $_SESSION['tabindex'][$_POST['val_i']] = array($_POST['indice_i'], $_POST['texte']);
    }
    $type = 'type_' . $_POST['val_i'];
    $_SESSION['tabindex'][$type] = $_POST['choice'];
    // var_dump($_POST);
    $i = (int) $_POST['val_i'] - 1;
    header("location:../index.php?lien=jeux&numero=$i");
}
