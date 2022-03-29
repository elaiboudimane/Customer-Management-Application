<?php
    require 'database.php';
    $id = null;
    if(!empty($_GET['id'])){
        $id = $_REQUEST['id'];
    }

    if(null == $id){
        header("Location: home.php");
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION).
        $sql = "SELECT * FROM customers where id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Afficher un client</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <script src="js/bootstrap.min.js"></script>
</head>
<body class="createClientBody">
    <div class="container createClient">
    <div class="span10 offset1">
        <div class="row">
            <h3>Afficher un client</h3>
        </div>
        <div class="form-horizontal">
            <div class="control-group">
                <span class="control-label lbl">Nom</span>
                <div class="controls">
                    <label class="checkbox">
                        <?php echo $data['name']; ?>
                    </label>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label lbl">Adresse E-mail</label>
                <div class="controls">
                    <label class="checkbox">
                        <?php echo $data['email']; ?>
                    </label>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label lbl">Telephone</label>
                <div class="controls">
                    <label class="checkbox">
                        <?php echo $data['mobile']; ?>
                    </label>
                </div>
            </div>
            <div class="form-actions">
                <a href="home.php" class="btn">Retour</a>
            </div>
        </div>
    </div>
    </div>
</body>
</html>