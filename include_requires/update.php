<?php

require('navbar/navbar.php');

require_once '../db/connexion.php';


if (!empty($_GET['id'])) {
    $id = checkInput($_GET['id']);
}

$date_heure_livraison_comError = $date_heure_livraison_com = "";

if (!empty($_POST)) {
    $date_heure_livraison_com = checkInput($_POST['Nom']);
    $isSuccess = true;

    if (empty($Nom)) {
        $date_heure_livraison_comError = 'Ce champ ne peut pas être vide';
        $isSuccess = false;
    }
    if (($isSuccess)) {
        $co = connexionBdd();
        if ($isSuccess) {
            $statement = $co->prepare("UPDATE commande  set date_heure_livraison_com = ? WHERE id_com = ?");
            $statement->execute(array($date_heure_livraison_com, $id));
        } else {
            $statement = $co->prepare("UPDATE commande  set date_heure_livraison_com = ?  WHERE id_com = ?");
            $statement->execute(array($date_heure_livraison_com, $id));
        }
        if ($isSuccess) {
            $co = connexionBdd();
            $statement = $co->prepare("SELECT * FROM commande where id_com = ?");
            $statement->execute(array($id));
            $item = $statement->fetch();
            $date_heure_livraison_com = $item['date_heure_livraison_com'];
            $id = $item['id_com'];
        }
    }
    function checkInput($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>page admin</title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
            integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js"
            integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/"
            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
<h1 id="al1" class="text-logo">update</h1>
<div id="al2" class="container admin">
    <div class="row">
        <div class="col-sm">
            <h1><strong>Modifier la date</strong></h1>
            <br>
            <form id="al" class="form" action="<?php echo 'update.php?id=' . $id; ?>" role="form" method="post"
                  enctype="multipart/form-data">
                <div class="form-group">
                    <label for="Nom">date:
                        <input type="date" class="form-control" id="name" name="Nom"
                               value="<?php echo $date_heure_livraison_com; ?>">
                        <span class="help-inline"><?php echo $date_heure_livraison_comError; ?></span>
                </div>
                <br>
                <div class="form-actions">
                    <button type="submit" name="submit" class="btn btn-success"><span
                                class="glyphicon glyphicon-pencil"></span> Modifier
                    </button>
                    <a class="btn btn-primary" href="index.php"><span class="glyphicon glyphicon-arrow-left"></span>
                        Retour</a>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>