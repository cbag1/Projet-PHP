<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <title>Connexion</title>
    <style>
        .error {
            color: #FF0000;
        }
    </style>
</head>

<body>
  <div class="header">
      <div class="img">
          <img src="img/logo-QuizzSA.png" alt="logo">
      </div>
      <div class="titre">
          <h2>Le plaisir de jouer</h2>
      </div>
  </div>
    <div class="menu">
        <div class="login-form">
            <h2>Login Form</h2> <img src="img/Icônes/close.png" alt="">
        </div>
        <div class="formulaire">
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                <div class="texbox">
                <input type="text" name="login" placeholder="Login"><img src="img/Icônes/ic-login.png" alt="">
                <!-- <span class="error"><?php echo $errorLogin; ?> </Span> -->
                </div>
                <div class="texbox">
                <input type="password" name="password" placeholder="Password"><img src="img/Icônes/ic-password.png" alt="">
                <!-- <span class="error"><?php echo $errorPasssword; ?> </Span> -->
                </div>
                <div class="bouton">
                    <input type="submit" value="Connexion" name="connexion">
                    <a href="inscription.php">S'inscrire pour jouer?</a>
                </div>
            </form>
        </div>
    </div>
</body>

<!-- Traitement ici -->
<?php
    if (isset($_POST['connexion'])) {
        $login=json_decode(file_get_contents('login.json'),true);
        // $login_parsed=json_decode($login);
        // print_r($login->{'joueurs'}[0]->{'login'});
        foreach ($login['admins'] as $value) {
            if ($value['login']==$_POST['login'] && $value['password']==$_POST['password']) {
                echo "BOUM ça marche";
            }
            else{
                echo "Boul niou yapp boy";
            }
        }
    }
?>

</html>
