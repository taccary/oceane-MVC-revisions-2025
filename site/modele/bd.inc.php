<?php
/** Fonction pour obtenir une connexion PDO unique (Singleton)
 * @package modele
 * @version 1.0
 */

/**
 * Fonction pour obtenir une connexion PDO unique (Singleton)
 * @return PDO
 */
function getPDO(): PDO {
    static $pdo = null; // Instance unique de PDO

    if ($pdo === null) {
        // Initialisation de la connexion PDO
        $login = $_ENV["username"];
        $mdp = $_ENV["password"];
        $dsn = $_ENV["dsn"];

        try {
            $pdo = new PDO($dsn, $login, $mdp, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            print "Erreur de connexion PDO : " . $e->getMessage();
            die();
        }
    }

    return $pdo; // Retourne toujours la même instance
}