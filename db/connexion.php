<?php
// Fonction à appeler pour se connecter à la base de données
function connexionBdd(): PDO
{
    // Permet d'utiliser les variables d'identification pour la connexion
    /**
     * @var $server
     * @var $dbName
     * @var $user
     * @var $pass
     */
    require_once 'config.php';
    // Tentative de connexion à la base de données MySQL
    try {
        // chaine de connexion avec API PDO
        $co = new PDO('mysql:host=' . $server . '; charset=utf8; dbname=' . $dbName, $user, $pass);
        // On définit le mode d'erreur de PDO sur Exception
        $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die('Erreur : ' . $e->getMessage());
    }

    return $co;
}
