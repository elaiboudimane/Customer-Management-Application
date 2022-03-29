<?php
                session_start(); //Nouvelle session
                if(isset($_GET['deconnexion']))
                { 
                    // Code de deconnexion
                   if($_GET['deconnexion']==true)
                   {  
                      session_unset();
                      header("location:index.php");
                   }
                }
                else if($_SESSION['username'] !== ""){
                    $user = $_SESSION['username']; //Initialisation de la session
                }
            ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Clients</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <script src="js/bootstrap.min.js"></script>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a href='home.php?deconnexion=true' class="nav-item">Deconnecter</a>
    </nav>
    <div class="container">
        <div class="row">
            <h3>Liste des clients</h3>
        </div>
        <div class="row">
            <p>
                <a href="create.php" class="btn btn-success">Creer</a>
            </p>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Adresse Email</th>
                        <th>Numero de telephone</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        include 'database.php';
                        $pdo = Database::connect();
                        $sql = 'SELECT * FROM customers ORDER BY id DESC';
                        foreach ($pdo->query($sql) as $row){
                            echo '<tr>';
                            echo '<td>'.$row['name'].'</td>';
                            echo '<td>'.$row['email'].'</td>';
                            echo '<td>'.$row['mobile'].'</td>';
                            echo '<td width=300>';
                            echo '<a class="btn" href="read.php?id='.$row['id'].'">Lire</a>';
                            echo '  ';
                            echo '<a class="btn btn-success" href="update.php?id='.$row['id'].'">Modifier</a>';
                            echo '  ';
                            echo '<a class="btn btn-danger" href="delete.php?id='.$row['id'].'">Supprimer</a>';
                            echo '</td>';
                            echo '</tr>';
                        }
                        Database::disconnect();
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>