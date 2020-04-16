Joueur

<?php
    is_connect();
    echo $_SESSION['user']['nom'];
    echo $_SESSION['user']['prenom'];
    echo $_SESSION['user']['login'];
    
?>

<a href="index.php?statut=logout">Deconnexion</a>