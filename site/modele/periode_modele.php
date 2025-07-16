<?php
/**
 * Modèle pour la gestion des periodes.
 * Ce modèle contient des fonctions pour interagir avec la base de données concernant les periodes.
 * @package modele
 * @version 1.0
 */

// inclusion des autres fichiers modèle nécessaires
include_once "bd.inc.php"; // fichier de connexion à la base de données

/**
 * Retourne la liste des periodes
 *
 * @return array Un tableau associatif des periodes
 */
function getPeriodes() :array {
    $resultat = array();

    try {
        $connexion = getPDO(); // Utilisation de la connexion à la base de données
        $req = $connexion->prepare("SELECT * FROM periode");
        $req->execute();

        $ligne = $req->fetch(PDO::FETCH_ASSOC);
        while ($ligne) {
            $resultat[] = $ligne;
            $ligne = $req->fetch(PDO::FETCH_ASSOC);
        }
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}
