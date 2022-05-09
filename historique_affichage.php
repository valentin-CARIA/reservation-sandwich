<?php
 	require 'db/connexion.php';
    $co = connexionBdd();
    $cat = $co->query('SELECT prenom_user, nom_user
    FROM utilisateur ORDER BY id_user DESC');
	echo "<div><p>vos information personnels:</p></div>";
	while ($result = $cat->fetch()) {
		echo ".$result['prenom_user']";
    	echo ".$result['nom_user']";
     }


?>