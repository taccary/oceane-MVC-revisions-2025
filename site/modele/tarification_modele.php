<?php
/**
 * Modèle pour la gestion des tarifs.
 * Ce modèle contient des fonctions pour interagir avec la base de données concernant les tarifs.
 * @package modele
 * @version 1.0
 */

// inclusion des autres fichiers modèle nécessaires
include_once "bd.inc.php"; // fichier de connexion à la base de données

/**
 * Fonction pour récupérer l'ensemble des tarifs pour toutes les periodes.
 *
 * @return array
 */
function getTarifs() : array {
    $resultat = array();
    try {
        $connexion = getPDO(); // Utilisation de la connexion à la base de données
        $req = $connexion->prepare("SELECT libelleCategorie as categorie, libelleTypeBillet as type, tarif, libellePeriode as periode FROM tarification t JOIN periode p ON t.idPeriode=p.idPeriode JOIN type_billet tb ON (t.idCategorie, t.idTypebillet) = (tb.idCategorie, tb.idTypebillet) JOIN categorie c ON t.idCategorie = c.idCategorie ORDER BY t.idCategorie, t.idTypebillet");

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
 * Fonction pour récupérer les tarifs d'une période spécifique.
 *
 * @param string $idPeriode
 * @return array
 */
function getTarifsPeriode(string $idPeriode) : array {
    $resultat = array();
    try {
        $connexion = getPDO(); // Utilisation de la connexion à la base de données
        $req = $connexion->prepare("SELECT libelleCategorie as categorie, t.idCategorie as idCategorie, libelleTypeBillet as type, t.idTypeBillet as idType, tarif, libellePeriode as periode FROM tarification t JOIN periode p ON t.idPeriode=p.idPeriode JOIN type_billet tb ON (t.idCategorie, t.idTypebillet) = (tb.idCategorie, tb.idTypebillet) JOIN categorie c ON t.idCategorie = c.idCategorie WHERE t.idPeriode=:idPeriode ORDER BY t.idCategorie, t.idTypebillet");
        $req->bindValue(':idPeriode', $idPeriode, PDO::PARAM_STR);
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
 * Fonction pour récupérer l'ensemble des types de billets avec leur categorie
 *
 * @return array
 */
function getTypesBillets() : array{

    try {
        $connexion = getPDO(); // Utilisation de la connexion à la base de données
        $req = $connexion->prepare("SELECT * FROM type_billet JOIN categorie ON type_billet.idCategorie = categorie.idCategorie");
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