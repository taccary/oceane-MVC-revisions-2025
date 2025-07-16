<?php
/**
 * Modèle pour la gestion des secteurs.
 * Ce modèle contient des fonctions pour interagir avec la base de données concernant les secteurs.
 * @package modele
 * @version 1.0
 */

// inclusion des autres fichiers modèle nécessaires
include_once "bd.inc.php"; // fichier de connexion à la base de données

/**
 * Retourne la liste des secteurs
 *
 * @return array Un tableau associatif des secteurs
 */
function getSecteurs() : array{
    $resultat = array();

    try {
        $connexion = getPDO(); // Utilisation de la connexion à la base de données
        $req = $connexion->prepare("SELECT * FROM secteur");
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

/**
 * Retourne le secteur dont l'id est passé en paramètre
 *
 * @param integer $id
 * @return array Un tableau associatif du secteur dont l'id est passé en paramètre
 */
function getSecteurById(int $id) : array {

    try {
        $connexion = getPDO(); // Utilisation de la connexion à la base de données
        $req = $connexion->prepare("SELECT * FROM secteur WHERE id=:id");
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->execute();
        $resultat = $req->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}