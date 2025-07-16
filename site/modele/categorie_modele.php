<?php
/**
 * Modèle pour la gestion des catégories.
 * Ce modèle contient des fonctions pour interagir avec la base de données concernant les catégories.
 * @package modele
 * @version 1.0
 */

// inclusion des autres fichiers modèle nécessaires
include_once "bd.inc.php"; // fichier de connexion à la base de données

/**
 * Retourne la liste des catégories
 *
 * @return array Un tableau associatif des catégories
 */
function getCategories() : array{
    $resultat = array();

    try {
        $connexion = getPDO(); // Utilisation de la connexion à la base de données
        $req = $connexion->prepare("SELECT * FROM categorie");
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
