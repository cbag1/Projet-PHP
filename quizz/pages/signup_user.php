<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="../public/css/quizz.css">
</head>
<body>
    <div class="header">
        <div class="logo"></div>
        <div class="header-text"> Le Plaisir de Jouer</div>
    </div>

    <!-- Ce partie gere l'inscription et l'insertion dans notre base json -->
    <div class="content">
            <?php
                require_once('signup.php');
            ?>
    </div>

</body>
</html>