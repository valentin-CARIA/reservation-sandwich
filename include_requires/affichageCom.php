<?php
session_start();

require('navbar/navbar.php');

require_once '../db/connexion.php';
$co = connexionBdd();


if (isset($_REQUEST['datedeb'], $_REQUEST['datefin']) || isset($_SESSION['datedeb'], $_SESSION['datefin'])) {
    $_SESSION['datedeb'] = $_REQUEST['datedeb'] ?? $_SESSION['datedeb'];
    $_SESSION['datefin'] = $_REQUEST['datefin'] ?? $_SESSION['datefin'];
    $cat = $co->prepare(
        'SELECT * FROM commande c
       inner join utilisateur u on c.fk_user_id = u.id_user
       inner join historique h on u.id_user = h.fk_user_id
       inner join boisson b on c.fk_boisson_id = b.id_boisson
       inner join dessert d on c.fk_dessert_id = d.id_dessert
       inner join sandwich s on c.fk_sandwich_id = s.id_sandwich
       where h.dateDebut_hist >= :datedeb and h.dateFin_hist <= :datefin'
    );
    $cat->bindValue(':datedeb', $_REQUEST['datedeb'] ?? $_SESSION['datedeb']);
    $cat->bindValue(':datefin', $_REQUEST['datefin'] ?? $_SESSION['datefin']);
} else {
    $cat = $co->prepare(
        'SELECT * FROM commande c
       inner join utilisateur u on c.fk_user_id = u.id_user
       inner join historique h on u.id_user = h.fk_user_id
       inner join boisson b on c.fk_boisson_id = b.id_boisson
       inner join dessert d on c.fk_dessert_id = d.id_dessert
       inner join sandwich s on c.fk_sandwich_id = s.id_sandwich'
    );
}
$cat->execute();
$rows = $cat->fetchAll(PDO::FETCH_ASSOC);
?>
<link rel="stylesheet" href="css/style.css">
<form method="POST">
    <label>
        par date
        <input name="datedeb" type="date" value="<?= $_SESSION['datedeb'] ?? null ?>"/>
    </label>
    <label>
        date cloturé
        <input name="datefin" type="date" value="<?= $_SESSION['datefin'] ?? null ?>"/>
    </label>
    <button type="submit">Afficher</button>
</form>
<table>
    <thead>
    <tr>
        <th>
            id-com
        </th>
        <th>
            nom_sandwich
        </th>
        <th>
            nom_boisson
        </th>
        <th>
            nom_dessert
        </th>
        <th>
            chips_com
        </th>
        <th>
            date_heure_com
        </th>
        <th>
            date_heure_livraison_com
        </th>
        <th>
            dateDebut_hist
        </th>
        <th>
            dateFin_hist
        </th>
        <th>
            dateinsertion_hist
        </th>
        <th>
            annule_com
        </th>
    </tr>
    <?php
    foreach ($rows as $result) {
        echo '<tr>';
        echo '<td>' . $result['id_com'] . '</td>';
        echo '<td>' . $result['nom_sandwich'] . '</td>';
        echo '<td>' . $result['nom_boisson'] . '</td>';
        echo '<td>' . $result['nom_dessert'] . '</td>';
        echo '<td>' . $result['chips_com'] . '</td>';
        echo '<td>' . $result['date_heure_com'] . '</td>';
        echo '<td>' . $result['date_heure_livraison_com'] . '</td>';
        echo '<td>' . $result['dateDebut_hist'] . '</td>';
        echo '<td>' . $result['dateFin_hist'] . '</td>';
        echo '<td>' . $result['dateInsertion_hist'] . '</td>';
        echo '<td>' . $result['annule_com'] . '</td>';
        echo '<td>';
        echo '<a class=" btn btn-primary" href="update.php?id_cat=' . $result['id_com'] . '"><span class="bi-at"></span> Modifier date de livraison</a>';
        echo '<a class=" btn btn-danger" href="delete.php?id_cat=' . $result['id_com'] . '"><span class="bi-x"></span>annuler command</a>';
        echo '</td>';
        echo '</tr>';
    }
    ?>
    </thead>
    <tbody>
</table>
