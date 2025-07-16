<?php
// Définir les variables spécifiques à cette vue
$title = "Tarifs par période";
$keywords = "tarifs, périodes, billetterie";
$description = "Consultez les tarifs appliqués pour chaque période.";

// Capturer le contenu spécifique dans une variable
ob_start();
?>

<h1 class="page-header text-center"><?= $title ?></h1>

<form method="post" action="index.php?p=afficheTarifs">
	<div>
		<label for="idPeriode">Choix d'une periode :</label>
		<select name="idPeriode">
			<option value="">--sélectionner une periode--</option>
		<?php
		foreach ($lesPeriodes as $unePeriode) {
			$selected = "";
			if ((isset($_POST['idPeriode'])) && ($_POST['idPeriode']==$unePeriode['idPeriode'])) {
			$selected = "selected";
			}
			echo '<option value="'.$unePeriode['idPeriode'].'" '.$selected.'>'.$unePeriode['libellePeriode'].'</option>';
		}
		?>
		</select>
	</div>
	<input type="submit" value="Afficher les tarifs" title="Afficher les tarifs" />
</form>

<br>

<table id="myTable" class="table table-bordered table-striped">
	<thead>
		<th>Catégorie</th>
		<th>Type de billet</th>
		<th>tarif</th>
		<th>Période</th>
	</thead>
	<tbody>
		<?php
			foreach ($lesTarifs as $unTarif){
			?>
				<tr>
					<td><?= $unTarif['categorie'] ?></td>
					<td><?= $unTarif['type'] ?></td>
					<td><?= $unTarif['tarif'] ?></td>
					<td><?= $unTarif['periode'] ?></td>
				</tr>
			<?php
			}
		?>
	</tbody>
</table>

<?php
$content = ob_get_clean(); // Stocker le contenu dans une variable
include 'layout.php'; // Inclure le layout