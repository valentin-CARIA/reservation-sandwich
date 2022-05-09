<?php 
	//include("index.php");
 ?>
<table>
    <thead>
        <tr>
            <th>
                id-cat
            </th>
            <th>
                livreJdr_cat
            </th>
            <th>
                auteur_cat
            </th>
            <th>
                isbn_cat
            </th>
            <th>
                nomDeCampagne_cat
            </th>
        </tr>
    </thead>
    <tbody>
        <?php 
        require '../db/connexion.php';
        $co = connexionBdd();
        $cat = $co->query('SELECT id_com, nom_user, prenom_user, nom_sandwich, nom_boisson, nom_dessert, chips_com, date_heure_com, date_heure_livraison_com, annule_com
            FROM commande, utilisateur, sandwich, dessert, boisson
            where fk_user_id = id_user and fk_sandwich_id = id_sandwich and fk_boisson_id = id_boisson and fk_dessert_id = id_dessert IN'  ('SELECT id_user, id_sandwich, id_boisson, id_dessert, id_com FROM commande, utilisateur, sandwich, dessert, boisson ORDER BY id_user, id_sandwich, id_boisson, id_dessert, id_com DESC'));
        while ($result = $cat->fetch()) {
            echo '<tr>';
            echo '<td>' .$result['nom_user'] . '</td>';
            echo '<td>' .$result['prenom_user'] . '</td>';
            echo '<td>' .$result['nom_sandwich'] . '</td>';
            echo '<td>' .$result['nom_boisson'] . '</td>';
            echo '<td>' .$result['nom_dessert'] . '</td>';
            echo '<td>' .$result['chips_com'] . '</td>';
            echo '<td>' .$result['chips_com'] . '</td>';
            echo '<td>' .$result['date_heure_com'] . '</td>';
            echo '<td>' .$result['annule_com'] . '</td>';
            echo '<td width=340>';
                echo '<a class=" btn btn-primary" href="into.php?id_cat=' . $result['id_cat'] .'"><span class="bi-at"></span> Modifier</a>';
                echo '  ';
                echo '<a class=" btn btn-danger" href="delete.php?id_cat=' . $result['id_cat'] .'"><span class="bi-x"></span>supprimer</a>';
            echo "</td>";
        }
        ?>
    </tbody>

</table>

 
 </body>
</html>