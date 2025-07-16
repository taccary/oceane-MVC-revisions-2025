<?php
/** Contrôleur pour gérer les bateaux dans l'application.
* Il inclut les fonctions pour afficher la liste des bateaux, gérer le CRUD, et charger les vues modales.
* 
* @package controleur
*/
include_once __DIR__ . '/../modele/liaison_modele.php';

/**
 * Fonction pour afficher la liste des bateaux en fonction du niveau d'accessibilité PMR sélectionné.
 * Elle récupère les niveaux d'accessibilité et les bateaux correspondants, puis retourne le chemin de la vue et les données nécessaires.
 *
 * @return array Un tableau contenant le chemin de la vue et les données
 */
function afficherLiaisons() : array {
    $lesSecteurs = getLiaisons();
    
    // Retourner le chemin de la vue et les données
    return [
        'view' => __DIR__ . '/../vue/afficheLiaisons_vue.php',
        'data' => [
            'lesSecteurs' => $lesSecteurs,
        ]
    ];
}


