<?php
require 'navbar/navbar.php';
require_once '../db/connexion.php';
$co = connexionBdd();
$cat = $co->query('SELECT prenom_user, nom_user
    FROM utilisateur ORDER BY id_user DESC');
echo '<div><p style="text-align: center; font-size: 90px;">vos information personnels:</p></div>';
while ($result = $cat->fetch()) {
    echo '<p style="text-align: center; font-size: 80px;">' . $result['prenom_user'] . ' ' . $result['nom_user'] . '</p>';
}
