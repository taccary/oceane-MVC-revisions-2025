<?php
session_start();
include "configBdd.php"; // fichier de configuration de la base de données

// Définition des variables de métadonnées
$title = "Compagnie Océane";
$keywords = "croisière, morbihan";
$description = "Bienvenue sur le site de la Compagnie Océane, votre partenaire pour des voyages en mer.";

// Fonction pour charger une vue
function chargerVue(array $response) {
    $vue = $response['view'];
    $data = $response['data'];

    if (!file_exists($vue)) {
        echo "Vue non trouvée.";
        return;
    }

    extract($data); // Rendre les données disponibles dans la vue
    include $vue;
}

// Table de routage
$routes = [
    // chaque route est associée à une fonction "anonyme" qui sera exécutée lorsque la route est appelée
    // Les fonctions anonymes sont des fonctions sans nom qui peuvent être définies à la volée et utilisées comme des variables. Elles sont souvent utilisées pour des callbacks ou des fonctions de traitement d'événements.
    'accueil' => function () {
        include "vue/accueil_vue.php";
    },
    '404' => function () {
        include "vue/404_vue.php";
    },
    'afficheBateau' => function () {
        include_once "controleur/bateau_controleur.php";
        $response = afficherBateaux();
        chargerVue($response);
    },
    'afficherCRUDBateau' => function () {
        include_once "controleur/bateau_controleur.php";
        $response = afficherCRUDBateaux();
        chargerVue($response);
    },
    'chargerModaleBateau' => function () {
        include_once "controleur/bateau_controleur.php";
        if (isset($_POST['action'])) {
            $action = $_POST['action'];
            $id = $_POST['id'] ?? null; // Récupérer l'ID du bateau (null si action = add)
            $response = ChargerModale($action, $id);
            chargerVue($response);
        } 
        exit;
    },
    'actionCRUDBateau' => function () {
        include_once "controleur/bateau_controleur.php";
        $action = $_GET['action'] ?? null;

        switch ($action) {
            case 'add':
                ajouterBateau();
                break;
            case 'edit':
                $nom = $_POST['nom'];
                $id = $_POST['id'];
                modifierBateau($id, $nom);
                break;
            case 'delete':
                supprimerBateau();
                break;
            default:
                echo "Action non reconnue.";
                break;
        }
    }
];

// Gestion des routes
if (isset($_GET['p'])) {
    $page = $_GET['p'];
} else {
    $page = 'accueil'; // Route par défaut : accueil
}

if (array_key_exists($page, $routes)) {
    $routes[$page](); // Exécuter la fonction associée à la route
} else {
    $routes['404'](); // Exécuter la fonction de la page 404
}