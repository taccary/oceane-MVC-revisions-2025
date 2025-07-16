<?php
// Définir les variables spécifiques à cette vue
$title = ""; // titre de la page à spécifier
$keywords = ""; // mots-clés à spécifier
$description = ""; // description à spécifier

// Capturer le contenu spécifique dans une variable
ob_start();
?>

<!-- insérer le contenu de la page ici -->

<?php
$content = ob_get_clean(); // Stocker le contenu dans une variable
include 'layout.php'; // Inclure le layout