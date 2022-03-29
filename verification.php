<?php
    session_start();
    if(isset($_POST['username']) && isset($_POST['password']))
    {
        //Autre de methode connexion à la base de données
        $db_username = 'root';
        $db_password = '';
        $db_name     = 'crud_tutorial';
        $db_host     = 'localhost';
        $pdo = mysqli_connect($db_host, $db_username, $db_password,$db_name)
           or die('could not connect to database');
        // on applique les deux fonctions mysqli_real_escape_string 
        //et htmlspecialchars pour éliminer toute attaque de type 
        //injection SQL et XSS
        $username = mysqli_real_escape_string($pdo,htmlspecialchars($_POST['username'])); 
        $password = mysqli_real_escape_string($pdo,htmlspecialchars($_POST['password']));
        if($username !== "" && $password !== "")
        {
            $requete = "SELECT count(*) FROM admin WHERE username = '".$username."' AND password = '".$password."' ";
            $exec_requete = mysqli_query($pdo,$requete);
            $reponse = mysqli_fetch_array($exec_requete);
            $count = $reponse['count(*)'];
            if($count!=0)
            {
               $_SESSION['username'] = $username;
               header('Location: home.php');
            }
            else
            {
               header('Location: index.php?erreur=1'); 
            }
        }
        else
        {
           header('Location: index.php?erreur=2');
        }
    }
    else
    {
       header('Location: index.php');
    }
    //Deconnexion
    mysqli_close($pdo);
?>