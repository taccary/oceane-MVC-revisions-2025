<?php
/**
 * Modèle pour la gestion des bateaux.
 * Ce modèle contient des fonctions pour interagir avec la base de données concernant les bateaux.
 * @package modele
 * @version 1.0
 */

// inclusion des autres fichiers modele necessaires
include_once "bd.inc.php"; // fichier de connexion à la base de données

/**
 * Fonction pour récupérer tous les niveaux d'accessibilité PMR.
 * Elle retourne un tableau associatif contenant les niveaux d'accessibilité.
 *
 * @return array Un tableau associatif des niveaux d'accessibilité
 */
function getNiveauxAccessibilite() : array {
    $connexion = getPDO(); // Utilisation de la connexion à la base de données
    $requete = 'SELECT * FROM niveau_accessibilite';
    $stmt = $connexion->prepare($requete);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $result;
}

/**
 * Fonction pour récupérer les bateaux en fonction du niveau d'accessibilité PMR.
 * Elle retourne un tableau associatif contenant les bateaux correspondant au niveau d'accessibilité spécifié.
 *
 * @param int $niveauPMR L'ID du niveau d'accessibilité PMR
 * @return array
 */
function getBateauxParNiveau(int $niveauPMR) : array {
    $connexion = getPDO(); // Utilisation de la connexion à la base de données
    $requete = "SELECT * FROM bateau b JOIN niveau_accessibilite n ON b.niveauPMR=n.idNiveau WHERE b.niveauPMR = :idNiveau ORDER BY b.nom";
    $stmt = $connexion->prepare($requete);
    $stmt->bindParam(':idNiveau', $niveauPMR, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $result;
}

/**
 * Fonction pour récupérer tous les bateaux.
 * Elle retourne un tableau associatif contenant tous les bateaux avec leurs niveaux d'accessibilité.
 *
 * @return array Un tableau associatif des bateaux
 */
function getTousLesBateaux() : array {
    $connexion = getPDO(); // Utilisation de la connexion à la base de données
    $requete = "SELECT * FROM bateau b JOIN niveau_accessibilite n ON b.niveauPMR=n.idNiveau ORDER BY b.nom";
    $stmt = $connexion->prepare($requete);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $result;
}

/**
 * Fonction pour récupérer un bateau par son ID.
 * Elle retourne un tableau associatif contenant les informations du bateau correspondant à l'ID spécifié.
 *
 * @param int $idBateau L'ID du bateau
 * @return array Un tableau associatif contenant les informations du bateau
 */
function getBateauById(int $idBateau) : array {
    $connexion = getPDO(); // Utilisation de la connexion à la base de données
    $requete = "SELECT * FROM bateau b JOIN niveau_accessibilite n ON b.niveauPMR=n.idNiveau WHERE b.id = :idBateau";
    $stmt = $connexion->prepare($requete);
    $stmt->bindParam(':idBateau', $idBateau, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $result;
}

/**
 * Fonction pour insérer un nouveau bateau dans la base de données.
 * Elle prend en paramètre le nom du bateau, le niveau d'accessibilité PMR et l'image du bateau.
 *
 * @param string $nom Le nom du bateau
 * @param int $niveauPMR L'ID du niveau d'accessibilité PMR
 * @param string $image Le chemin de l'image du bateau
 * @return array Un tableau contenant un message de succès ou d'erreur
 */
function insertBateau(string $nom, int $niveauPMR, string $image) : array{
    try {
        // Insertion du bateau dans la base de données
        $connexion = getPDO(); // Utilisation de la connexion à la base de données
        // Récupérer le dernier ID et calculer le nouvel ID
        $requete = "SELECT MAX(id) FROM bateau";
        $stmt = $connexion->prepare($requete);
        $stmt->execute();
        $lastId = $stmt->fetch();
        $newId = (int)$lastId[0] + 1;

        $requete = "INSERT INTO bateau (id, nom, niveauPMR, photo) VALUES (:id, :nom, :niveauPMR, :image)";
        $stmt = $connexion->prepare($requete);
        $stmt->bindParam(':id', $newId, PDO::PARAM_INT);
        $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
        $stmt->bindParam(':niveauPMR', $niveauPMR, PDO::PARAM_INT);
        $stmt->bindParam(':image', $image, PDO::PARAM_STR);
        $stmt->execute();
        $stmt->closeCursor();
        $message['message'] = "Bateau ajouté avec succès !";
        $message['status'] = "success";
        return $message;
    } catch (Exception $e) {
        $message['message'] = "Erreur lors de l'ajout du bateau : " . $e->getMessage();
        $message['status'] = "error";
        return $message;
    }
}

/**
 * Fonction pour mettre à jour un bateau dans la base de données.
 * Elle prend en paramètre l'ID du bateau, le nom, le niveau d'accessibilité PMR et l'image.
 *
 * @param int $id L'ID du bateau
 * @param string $nom Le nom du bateau
 * @param int $niveauPMR L'ID du niveau d'accessibilité PMR
 * @param string $image Le chemin de l'image du bateau
 * @return array Un tableau contenant un message de succès ou d'erreur
 */
function updateBateau(int $id, string $nom, int $niveauPMR, string $image) : array {
    try {
        // Mise à jour du bateau dans la base de données
        $connexion = getPDO(); // Utilisation de la connexion à la base de données
        $requete = "UPDATE bateau SET nom = :nom, niveauPMR = :niveauPMR, photo = :image WHERE id = :id";
        $stmt = $connexion->prepare($requete);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
        $stmt->bindParam(':niveauPMR', $niveauPMR, PDO::PARAM_INT);
        $stmt->bindParam(':image', $image, PDO::PARAM_STR);
        $stmt->execute();
        $stmt->closeCursor();
        $message['message'] = "Bateau mis à jour avec succès !";
        $message['status'] = "success";
        return $message;
    } catch (Exception $e) {   
        $message['message'] = "Erreur lors de la mise à jour du bateau : " . $e->getMessage();
        $message['status'] = "error";
        return $message;
    }
}

/**
 * Fonction pour supprimer un bateau de la base de données.
 * Elle prend en paramètre l'ID du bateau à supprimer.
 *
 * @param int $id L'ID du bateau à supprimer
 * @return array Un tableau contenant un message de succès ou d'erreur
 */
function deleteBateau(int $id) : array {
    try {
        // Suppression du bateau dans la base de données
        $connexion = getPDO(); // Utilisation de la connexion à la base de données
        $requete = "DELETE FROM bateau WHERE id = :id";
        $stmt = $connexion->prepare($requete);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->closeCursor();
        $message['message'] = "Bateau supprimé avec succès !";
        $message['status'] = "success";
        return $message;
    } catch (Exception $e) {
        $message['message'] = "Erreur lors de la suppression du bateau : " . $e->getMessage();
        $message['status'] = "error";
        return $message;
    }
}
