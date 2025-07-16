<?php
// Définir les variables spécifiques à cette vue
$title = "Connexion"; // titre de la page à spécifier
$keywords = "connexion"; // mots-clés à spécifier
$description = "page d'authentification"; // description à spécifier

// Capturer le contenu spécifique dans une variable
ob_start();
?>

<h1 class="page-header text-center"><?= $title ?></h2>
<form method="POST" action="?p=connexion">
    <div class="mb-3">
        <label for="username" class="form-label">Nom d'utilisateur</label>
        <input type="text" class="form-control" id="username" name="username" required>
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Mot de passe</label>
        <input type="password" class="form-control" id="password" name="password" required>
    </div>
    <button type="submit" class="btn btn-primary">Se connecter</button>
</form>
<?php if (isset($message)) { echo '<div class="alert alert-info">'.$message.'</div>'; } ?>

<p>Utilisateur pour tester : <strong>test@bts.sio</strong> / <strong>sio</strong></p>

<?php
$content = ob_get_clean(); // Stocker le contenu dans une variable
include 'layout.php'; // Inclure le layout