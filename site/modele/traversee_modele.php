<?php
/**
 * Modèle pour la gestion des traversées.
 * Ce modèle contient des fonctions pour interagir avec la base de données concernant les traversées.
 * @package modele
 * @version 1.0
 */

// inclusion des autres fichiers modèle nécessaires
include_once "bd.inc.php"; // fichier de connexion à la base de données

/**
 * getTraverseesByLiaisonAndDate : Retourne l'ensemble des traversées pour une liaison et une date données
 *
 * @param integer $idLiaison
 * @param string $date
 * @return array
 */
function getTraverseesByLiaisonAndDate(int $idLiaison, string $date) : array {
    $resultat = array();
    try {
        $connexion = getPDO(); // Utilisation de la connexion à la base de données
        $req = $connexion->prepare("SELECT * FROM traversee T JOIN bateau B ON B.id=T.idBateau
        where codeLiaison=:idLiaison
        AND date=:date
        ORDER BY heure");
        $req->bindValue(':idLiaison', $idLiaison, PDO::PARAM_INT);
        $req->bindValue(':date', $date, PDO::PARAM_STR);
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
 * getPlacesTraverseesByLiaisonAndDate : Retourne l'ensemble des traversées pour une liaison et une date données avec le nb de places totales pour chaque categorie dans ce bateau
 * retourne un tableau associatif de la forme [numTraversee][lettreCategorie] = nbPlacesMax
 * 
 * @param [type] $idLiaison
 * @param [type] $date
 * @return array
 */
function getPlacesTraverseesByLiaisonAndDate(int $idLiaison, string $date) : array {
    
    $resultat = array();
    try {
        $connexion = getPDO(); // Utilisation de la connexion à la base de données
        $req = $connexion->prepare("SELECT num, idBateau FROM traversee T where codeLiaison=:idLiaison AND date=:date");
        $req->bindValue(':idLiaison', $idLiaison, PDO::PARAM_INT);
        $req->bindValue(':date', $date, PDO::PARAM_STR);
        $req->execute();

        $ligne = $req->fetch(PDO::FETCH_ASSOC);
        while ($ligne) {
            $req2 = $connexion->prepare("SELECT * FROM contenance_bateau where idBateau=:id");
            $req2->bindValue(':id', $ligne['idBateau'], PDO::PARAM_INT);
            $req2->execute();
            $ligne2 = $req2->fetch(PDO::FETCH_ASSOC);
            while ($ligne2) {

                $resultat[$ligne['num']][$ligne2['lettreCategorie']] = intval($ligne2['capaciteMax']);
                $ligne2 = $req2->fetch(PDO::FETCH_ASSOC);
            }
            $ligne = $req->fetch(PDO::FETCH_ASSOC);
        }
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}

/**
 * getPlacesReservesTraversees : Compte le nb de place reservées dans detail_reservation pour chaque traversée et categorie
 * retourne un tableau associatif de la forme [numTraversee][lettreCategorie] = nbPlacesReservees
 *
 * @return array
 */
function getPlacesReservesTraversees() : array {
    $resultat = array();
    try {
        
        // code à écrire

    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}