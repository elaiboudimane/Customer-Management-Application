<?php 
 require 'database.php'; 
 
 $id = null; 
 if ( !empty($_GET['id'])) { 
 $id = $_REQUEST['id']; 
 } 
 
 if ( null==$id ) { 
 header("Location: home.php"); 
 } 
 
 if ( !empty($_POST)) {  
 $nameError = null; 
 $emailError = null; 
 $mobileError = null; 
 
 $name = $_POST['name']; 
 $email = $_POST['email']; 
 $mobile = $_POST['mobile']; 
 
 $valid = true; 
 if (empty($name)) { 
 $nameError = 'Veuillez entrer le nom'; 
 $valid = false; 
 } 
 
 if (empty($email)) { 
 $emailError = "Veuillez saisir l'adresse e-mail"; 
 $valid = false; 
 } else if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) { 
 $emailError = "Veuillez mettez une adresse email valide";
 $valid = false; 
 } 
 if (empty($mobile)) { 
 $mobileError = 'Veuillez entrer le numéro de portable'; 
 $valid = false; 
 }  
 if ($valid) { 
 $pdo = Database::connect(); 
 $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
 $sql = "UPDATE customers set name = ?, email = ?, mobile =? 
WHERE id = ?"; 
 $q = $pdo->prepare($sql); 
 $q->execute(array($name,$email,$mobile,$id)); 
 Database::disconnect(); 
 header("Location: home.php"); 
 } 
 } else { 
 $pdo = Database::connect(); 
 $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
 $sql = "SELECT * FROM customers where id = ?"; 
 $q = $pdo->prepare($sql); 
 $q->execute(array($id)); 
 $data = $q->fetch(PDO::FETCH_ASSOC); 
 $name = $data['name']; 
 $email = $data['email']; 
 $mobile = $data['mobile']; 
 Database::disconnect(); 
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
 
    <body class="createClientBody"> 
        <div class="container createClient"> 
 
            <div class="span10 offset1"> 
                 <div class="row"> 
                    <h3>Modifier un client</h3> 
                </div> 
 
                <form class="form-horizontal" action="update.php?id=<?php echo $id?>" method="post"> 
                    <div class="control-group <?php echo !empty($nameError)?'error':'';?>"> 
                        <label class="control-label">Nom</label> 
                        <div class="controls"> 
                        <input name="name" type="text" placeholder="Nom" value="<?php echo !empty($name)?$name:'';?>"> <?php if (!empty($nameError)): ?> 
                            <span class="help-inline"><?php echo $nameError;?></span> 
                            <?php endif; ?> 
                        </div> 
                    </div> 
                    <div class="control-group <?php echo !empty($emailError)?'error':'';?>"> 
                        <label class="control-label">Adresse E-mail</label> 
                        <div class="controls"> 
                                <input name="email" type="text" placeholder="Adresse E-mail" value="<?php echo !empty($email)?$email:'';?>"> 
                                <?php if (!empty($emailError)): ?> 
                                    <span class="help-inline"><?php echo $emailError;?></span> 
                                    <?php endif;?> 
                        </div> 
                    </div> 
                    <div class="control-group <?php echo !empty($mobileError)?'error':'';?>"> 
                        <label class="control-label">Telephone</label>
                        <div class="controls"> 
                            <input name="mobile" type="text" placeholder="Telephone" value="<?php echo !empty($mobile)?$mobile:'';?>"> 
                            <?php if (!empty($mobileError)): ?> 
                                <span class="help-inline"><?php echo $mobileError;?></span> 
                                <?php endif;?> 
                        </div> 
                    </div> 
                    <div class="form-actions formCreateBtn"> 
                        <button type="submit" class="btn btn-success">Modifier</button> 
                        <a class="btn" href="home.php">Retour</a> 
                    </div> 
            </form> 
        </div> 
 
    </div>
 </body> 
</html>