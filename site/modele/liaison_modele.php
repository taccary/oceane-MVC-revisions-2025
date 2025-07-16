<?php
/**
 * Modèle pour la gestion des liaisons.
 * Ce modèle contient des fonctions pour interagir avec la base de données concernant les liaisons.
 * @package modele
 * @version 1.0
 */

// inclusion des autres fichiers modèle nécessaires
include_once "bd.inc.php"; // fichier de connexion à la base de données
include_once "secteur_modele.php"; // fichier pour la gestion des secteurs

/**
 * Fonction pour retourner l'ensemble des liaisons avec les noms des ports de départ et d'arrivée
 *
 * @return array Un tableau associatif des liaisons
 */
function getLiaisons() : array {
    try {
        $secteurs = getSecteurs();
        foreach ($secteurs as $secteur) {
            $resultat[$secteur['id']]['nom'] = $secteur['nom'];
            $resultat[$secteur['id']]['liaisons'] = array();
            $resultat[$secteur['id']]['liaisons'] = getLiaisonsBySecteurLignes($secteur['id']);
        }
        
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}

/**
 * getLiaisonsBySecteur : Retourne l'ensemble des liaisons pour un secteur donné
 *
 * @param integer $idSecteur
 * @return array
 */
function getLiaisonsBySecteur(int $idSecteur) : array {
    try {
        $resultat[$idSecteur]['nom'] = getSecteurById($idSecteur)['nom'];
        $resultat[$idSecteur]['liaisons'] = getLiaisonsBySecteurLignes($idSecteur);

    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}

/**
 * getLiaisonsBySecteurLignes : Retourne l'ensemble des liaisons pour un secteur donné avec les noms des ports de départ et d'arrivée
 *
 * @param integer $idSecteur
 * @return array
 */
function getLiaisonsBySecteurLignes(int $idSecteur) : array {
    $resultat = array();
    try {
        $connexion = getPDO(); // Utilisation de la connexion à la base de données
        $req = $connexion->prepare("SELECT L.code, L.distance, PD.nom as portDepart, PA.nom as portArrivee FROM liaison L 
        JOIN port PD on PD.nom_court=L.portDepart 
        JOIN port PA on PA.nom_court=L.portArrivee
        where L.codeSecteur=:idSecteur");
        $req->bindValue(':idSecteur', $idSecteur, PDO::PARAM_INT);
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
 * getLiaisonsLignes : Retourne l'ensemble des liaisons avec les noms des ports de départ et d'arrivée
 *
 * @return array
 */
function getLiaisonsLignes() : array {
    $resultat = array();
    try {
        $connexion = getPDO(); // Utilisation de la connexion à la base de données
        $req = $connexion->prepare("SELECT L.code, L.codeSecteur, L.distance, PD.nom as portDepart, PA.nom as portArrivee FROM liaison L 
        JOIN port PD on PD.nom_court=L.portDepart 
        JOIN port PA on PA.nom_court=L.portArrivee");
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
 * getLiaisonById : Retourne une liaison en fonction de son id
 *
 * @param integer $id
 * @return array
 */
function getLiaisonById(int $id) : array {
    try {
        $connexion = getPDO(); // Utilisation de la connexion à la base de données
        $req = $connexion->prepare("SELECT L.code, S.nom, L.distance, PD.nom as portDepart, PA.nom as portArrivee FROM liaison L INNER JOIN secteur S on L.codeSecteur=S.id
        JOIN port PD on PD.nom_court=L.portDepart 
        JOIN port PA on PA.nom_court=L.portArrivee where L.code=:id");
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->execute();
        $resultat = $req->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}
