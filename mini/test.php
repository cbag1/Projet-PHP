<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="index.css"> -->
    <title>Login Page  Pour Administrateur et Joueur</title>
</head>
<body>
    <?php
    // include('header.php');
    ?>

    <div id="partielogin">
        <div id="formlogin">
            <div id="flogintext"> </div>
            <div id="flogincontain">
                <form action="" method="POST">
                <div class="form-all">

                    <div class="text-form">
                        <input type="text" name="login">
                    </div>
                    <div class="img-form">
                        <img src="Images/Icones/ic-login.png" alt="">
                    </div>

                </div>
                <div class="form-all">

                    <div class="text-form">
                        <input type="text" name="login">
                    </div>
                    <div class="img-form">
                        <img src="Images/Icones/ic-password.png" alt="">
                    </div>

                </div>

                <input type="submit" name="connect" value="Se connecter">
                </form>
            </div>
        </div>

    </div>

    <?php
        if (isset($_POST['connect'])) {
            $fichier_json=file_get_contents('admin.json');
            var_dump(json_decode($fichier_json));
        }
    ?>
</body>
</html>













/* body{
    background-image: url('Images/img-bg.jpg');
    background-size:cover;
    margin:0;
    padding:0;
}
html{
    margin:0;
    padding:0;
}

#header{
    background-color: black;
    height:70px;
}

#logo {
    height:100%;
    width: 10%;
    float: left;
}

#logo img{
    height: 100%;
}

#textheader{
    height: 100%;
    width: 90%;
    color: white;
}

#textheader h1{
    text-align: center;
    padding-top: 20px;
}


#partielogin{
    height:550px;
    padding-top:70px;
}

#formlogin{
    width: 50%;
    height: 430px;
    margin:0 auto;
    background-color: green;
}

#flogintext{
    height: 20%;
    background-color: grey;
}



#flogincontain{
    width: 100%;
    margin-top: 50px;
    overflow: auto;
}
.form-all{
    width: 80%;
    height: 100px;
    margin: 0 auto;
    
}

div.text-form{
    float: left;
    width: 90%;
    
}

div.text-form input[type=text]{
    width: 100%;
    height: 100%;
}

div.img-form{
    float: right;
    width: 6%;
}


div.img-form img{
    width: 100%;
}
 */
