<?php
// Vue de connexion
?>
<h2>Connexion</h2>
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
