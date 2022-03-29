<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Connexion</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/Login-Form-blue-Gradient-1.css">
    <link rel="stylesheet" href="css/Login-Form-blue-Gradient.css">
    <link rel="stylesheet" href="fonts/font-awesome.min.css">
</head>

<body>
    <section>
        <div class="lgp-hd">
            <h2><strong>Application de gestion des clients</strong><br></h2>
            <h5><strong>Connectez-vous pour voir vos clients</strong><br></h5>
        </div>
        <div class="container login-cont">
            <div class="row">
                <div class="col-10 col-sm-6 col-md-4 col-lg-4 offset-1 offset-sm-3 offset-md-4 offset-lg-4 login-col"><h5 style="color: white; font-weight: bold;">LOGIN</h5>
                    <form class="login-form" method="post" action="verification.php">
                        <div class="form-group mb-3"><input class="form-control form-control-lg lg-frc" type="text" name="username" required="" placeholder="Nom d'utilisateur" max="20" min="1"></div>
                        <div class="form-group mb-3"><input class="form-control form-control-lg lg-frc" type="password" name="password" required="" placeholder="Mot de passe" max="20" min="1"></div>
                        <div class="form-group mb-3"><button class="btn btn-light btn-lg login-btn" type="submit"><strong>Connexion</strong></button></div>
                        <?php
                            if(isset($_GET['erreur'])){
                            $err = $_GET['erreur'];
                            if($err==1 || $err==2)
                            echo "<p style='color:red'>Nom de l'utilisateur ou mot de passe incorrecte</p>";
                            }
                        ?>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <footer id="footer">
        <div style= "text-align: center; margin: 0px; padding:10px">
            <p style= "color:white; font-weight: bold;">Copyright (c) 2022 Imane El Aiboud</p>
        </div>
    </footer>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>