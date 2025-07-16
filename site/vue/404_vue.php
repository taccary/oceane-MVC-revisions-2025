<?php
// Définir les variables spécifiques à cette vue
$title = "Accueil - Compagnie Océane";

// Capturer le contenu spécifique dans une variable
ob_start();
?>

<h1 align="center">Erreur 404</h1>
<p>La page que vous recherchez n'existe pas ou a été déplacée.</p>
<p>Veuillez vérifier l'URL ou retourner à la page d'accueil.</p>

<?php
$content = ob_get_clean(); // Stocker le contenu dans une variable
include 'layout.php'; // Inclure le layout