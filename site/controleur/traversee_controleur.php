<?php
/** Contrôleur pour gérer les traversées dans l'application.
* Il inclut les fonctions pour afficher la liste des traversées, gérer le CRUD, et charger les vues modales.
* 
* @package controleur
*/
include_once __DIR__ . '/../modele/traversee_modele.php';
include_once __DIR__ . '/../modele/categorie_modele.php';
include_once __DIR__ . '/../modele/secteur_modele.php';
include_once __DIR__ . '/../modele/liaison_modele.php';


/**
 * Fonction pour afficher la liste des traversées en fonction d'une liaison et d'une date, puis retourne le chemin de la vue et les données nécessaires.
 *
 * @return array Un tableau contenant le chemin de la vue et les données
 */
function afficherTraversees() : array {
    $idSecteur = null;
    $secteurSelectionne = null;
    $lesLiaisons = null;
    $liaisonSelectionnee = null;
    $date = null;
    $lesTraversees = null;
    $placesCapacite = null;
    $placesReservees = null;
    if (isset($_GET['secteur']) && $_GET['secteur'] != "") {
        $idSecteur = intval($_GET['secteur']);
        $secteurSelectionne = getSecteurById($idSecteur);
        $lesLiaisons = getLiaisonsBySecteurLignes($idSecteur);
        if (isset($_POST['liaison']) && isset($_POST['date']) && $_POST['liaison'] != "" && $_POST['date'] != "") {
            $idLiaison = intval($_POST['liaison']);
            $date = $_POST['date'];
            $liaisonSelectionnee = getLiaisonById($idLiaison);
            $lesTraversees = getTraverseesByLiaisonAndDate($idLiaison, $date);
            $placesCapacite = getPlacesTraverseesByLiaisonAndDate($idLiaison, $date);
            $placesReservees = getPlacesReservesTraversees();
        }
    }
    
    // Retourner le chemin de la vue et les données
    return [
        'view' => __DIR__ . '/../vue/afficheTraversees_vue.php',
        'data' => [
            'lesTraversees' => $lesTraversees,
            'secteurSelectionne' => $secteurSelectionne,
            'lesLiaisons' => $lesLiaisons,
            'liaisonSelectionnee' => $liaisonSelectionnee,
            'dateTraversee' => $date,
            'placesCapacite' => $placesCapacite,
            'placesReservees' => $placesReservees,
            'lesCategories' => getCategories(),
            'lesSecteurs' => getSecteurs()
        ]
    ];
}
