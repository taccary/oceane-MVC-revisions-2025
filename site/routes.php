<?php
// Routes associées à l'authentification
include_once __DIR__ . '/controleur/authentification_controleur.php';

if (isset($_GET['p'])) {
    switch ($_GET['p']) {
        case 'connexion':
            $result = afficherConnexion();
            $view = $result['view'];
            $data = $result['data'];
            break;
        case 'deconnexion':
            $result = afficherDeconnexion();
            $view = $result['view'];
            $data = $result['data'];
            break;
        // ... autres routes ...
    }
}
