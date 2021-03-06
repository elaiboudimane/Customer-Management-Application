<?php 
 require 'database.php'; 
 $id = 0; 
 
 if ( !empty($_GET['id'])) { 
 $id = $_REQUEST['id']; 
 } 
 
 if ( !empty($_POST)) { 

 $id = $_POST['id']; 
 
 $pdo = Database::connect(); 
 $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
 $sql = "DELETE FROM customers WHERE id = ?"; 
 $q = $pdo->prepare($sql); 
 $q->execute(array($id)); 
 Database::disconnect(); 
 header("Location: home.php"); 
 
 } 
?> 
 
<!DOCTYPE html> 
<html lang="en"> 
<head> 
    <meta charset="utf-8"> 
    <link href="css/bootstrap.min.css" rel="stylesheet"> 
    <link rel="stylesheet" href="css/styles.css">
    <script src="js/bootstrap.min.js"></script> 
</head> 
 
<body> 
    <div class="container"> 
 
    <div class="span10 offset1"> 
    <div class="row"> 
        <h3>Supprimer un client</h3> 
    </div> 
 
    <form class="form-horizontal" action="delete.php" method="post"> 
        <input type="hidden" name="id" value="<?php echo $id;?>"/> 
        <p class="alert alert-error">Êtes-vous sûr de vouloir supprimer ?</p> 
        <div class="form-actions"> 
            <button type="submit" class="btn btn-danger">Oui</button> 
            <a class="btn" href="home.php">Non</a> 
        </div> 
    </form> 
    </div>
    </div>
</body> 
</html>