<?php

require('navbar/navbar.php');
require_once '../db/connexion.php';

if (!empty($_GET['id'])) {
    $id = checkInput($_GET['id']);
}
// requete qui suprime les donner
if (!empty($_POST)) {
    $id = checkInput($_POST['id']);
    $co = connexionBdd();
    $statement = $co->prepare("DELETE FROM commande WHERE id_com = ?");
    $statement->execute(array($id));
    header("Location: index.php");
}

function checkInput($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>
<!--formulaire lier a la suppresion-->
<!DOCTYPE html>
<html>
<head>
    <title>page admin</title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="navbar/navbar/navbar.css">
</head>

<body>
<div class="container admin">
    <div class="row">
        <h1><strong>annuler la commande</strong></h1>
        <br>
        <form class="form" action="delete.php" role="form" method="post">
            <input type="hidden" name="id" value="<?php echo $id; ?>"/>
            <p class="alert alert-warning">Etes vous sur de vouloir supprimer ?</p>
            <div class="form-actions">
                <button type="submit" class="btn btn-warning">Oui</button>
                <a class="btn btn-default" href="admin.php">Non</a>
            </div>
        </form>
    </div>
</div>
</body>
</html>

