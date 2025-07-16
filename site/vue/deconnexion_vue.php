<?php
// Définir les variables spécifiques à cette vue
$title = "Déconnexion"; // titre de la page à spécifier
$keywords = "déconnexion"; // mots-clés à spécifier
$description = "page de déconnexion"; // description à spécifier

// Capturer le contenu spécifique dans une variable
ob_start();
?>

<h1 class="page-header text-center"><?= $title ?></h2>

<p>Vous avez été déconnecté.</p>
<a href="index.php">Retour à l'accueil</a>

<?php
$content = ob_get_clean(); // Stocker le contenu dans une variable
include 'layout.php'; // Inclure le layout