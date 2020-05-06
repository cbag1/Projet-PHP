<?php
if (isset($_POST['suivant'])) {
    // var_dump($_POST);
    $i = (int) $_POST['val_i'] + 1;
    header("location:../index.php?lien=jeux&numero=$i");
}
if (isset($_POST['prec'])) {
    // var_dump($_POST);
    $i = (int) $_POST['val_i'] - 1;
    header("location:../index.php?lien=jeux&numero=$i");
}
?>

