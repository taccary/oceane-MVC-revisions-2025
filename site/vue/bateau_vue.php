<?php
// Définir les variables spécifiques à cette vue
$title = "Nos navires";
$keywords = "bateaux, ferries, accessibilité";
$description = "Découvrez notre flotte et les caractéristiques de nos différents ferries.";

// Capturer le contenu spécifique dans une variable
ob_start();
?>

<h1 class="page-header text-center">Nos Navires</h1>
<p>Bienvenue à bord ! Découvrez notre flotte et les caractéristiques de nos différents ferries.</p><br>

<form method="post" action="index.php?p=afficheBateau">
    <div>
        <label for="niveauPMR">Niveau d'accessibilité :</label>
        <select name="niveauPMR">
		    <option value="">--sélectionner un niveau d'accessibilité--</option>
			<?php
			foreach ($lesNiveauxPMR as $unNiveauPMR) {
				$selected = "";
				if ((isset($_POST['niveauPMR'])) && ($_POST['niveauPMR']==$unNiveauPMR['idNiveau'])) {
					$selected = "selected";
				}
				echo '<option value="'.$unNiveauPMR['idNiveau'].'" '.$selected.'>'.$unNiveauPMR['libelle'].'</option>';
			}
			?>
	    </select>
    </div>
	<input type="submit" value="Afficher les navires" title="Afficher les navires" />
</form>

<br>


<div class="row">
	<table id="myTable" class="table table-bordered table-striped">
		<thead>
			<th>Nom du navire</th>
			<th>Photo</th>
			<th>Informations d'accessibilité</th>
		</thead>
		<tbody>
			<?php
				foreach ($lesBateaux as $unBateau){
				?>
					<tr>
						<td><?= $unBateau['nom'] ?></td>
						<td><img height='100px' src='images/bateaux/<?= $unBateau['photo'] ?>'></td>
						<td><?= $unBateau['descriptionAccessibilite'] ?></td>
					</tr>
				<?php
				}
			?>
		</tbody>
	</table>
</div>

<?php
$content = ob_get_clean(); // Stocker le contenu dans une variable
include 'layout.php'; // Inclure le layout