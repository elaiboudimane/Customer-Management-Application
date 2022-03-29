<?php
    require 'database.php';
    if(!empty($_POST)){
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
            $mobileError = 'Veuillez entrer le numéro de telephone'; 
            $valid = false; 
            } 
            
            if ($valid) { 
            $pdo = Database::connect(); 
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
            $sql = "INSERT INTO customers (name,email,mobile) values(?, ?, 
           ?)"; 
            $q = $pdo->prepare($sql); 
            $q->execute(array($name,$email,$mobile)); 
            Database::disconnect(); 
            header("Location: home.php"); 
            } 
            } 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Creer un client</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body class="createClientBody">
    <div class="container createClient">
        <div class="span10 offset1">
            <div class="row">
                <h3>Creer un client</h3>
            </div>
            <form action="create.php" method="POST" class="form-horizontal">
                <div class="control-group <?php echo !empty($nameError)?'error':'';?>">
                <label class="controm-label">Nom</label>
                <div class="controls">
                    <input type="text" name="name" placeholder="Nom" value="<?php echo !empty($name)?$name:'';?>">
                    <?php if(!empty($nameError)): ?>
                        <span class="help-inline">
                            <?php echo $nameError;?>
                        </span>
                        <?php endif; ?>
                </div>
                </div>
                <div class="control-group <?php echo !empty($emailError)?'error':''; ?>">
                        <label class="control-label">Adresse E-mail</label>
                        <div class="controls">
                            <input type="text" name="email" placeholder="Adresse E-mail" value="<?php echo !empty($email)?$email:'';?>">
                            <?php if (!empty($emailError)):?>
                                <span class="help-inline"><?php echo $emailError;?></span>
                                <?php endif; ?>
                        </div>
                </div>
                <div class="control-group <?php echo !empty($mobileError)?'error':'';?>">
                                <label class="control-label">Numero de telephone</label>
                                <div class="controls">
                                    <input type="text" name="mobile" placeholder="Numero de telephone" value="<?php echo !empty($mobile)?$mobile:'';?>">
                                    <?php if(!empty($mobileError)): ?>
                                        <span class="help-inline"><?php echo $mobileError;?></span>
                                        <?php endif; ?>
                                </div>
                </div>
                <div class="form-actions formCreateBtn">
                    <button type="submit" class="btn btn-success">Creer</button>
                    <a href="home.php" class="btn">Retour</a>
                </div>
            </form>
        </div>
    </div>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>