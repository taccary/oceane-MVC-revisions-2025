<?php
// Définir les variables spécifiques à cette vue
$title = "Traversées par secteur";
$keywords = "traversées, réservations";
$description = "Découvrez les traversées disponibles par secteur.";

// Capturer le contenu spécifique dans une variable
ob_start();
?>

<h1 class="page-header text-center"><?= $title ?></h1>

<div class="row">
  <div class="list-group col-2" >
  <?php foreach ($lesSecteurs as $secteur){
      $active = "";
      if (isset($secteurSelectionne)){
          if ($secteurSelectionne['id'] == $secteur['id']){
              $active = "active";
          }
      }
      
  ?>
      <a href="?p=afficheTraversees&secteur=<?=$secteur['id']?>" class="list-group-item list-group-item-action <?=$active?>">
      <?=$secteur['nom']?>
    </a>
  <?php
  }
  ?>

  </div>

  <div class="col">
    <?php
      if (!isset($_GET['secteur'])){
      ?>
        <p>Selectionnez un secteur dans le menu gauche </p>
      <?php
      } else {
      ?>
        <p>Sélectionner la liaison, et la date souhaitée </p>
  
          <form method="POST" action="?p=afficheTraversees&secteur=<?= $secteurSelectionne['id'] ?>">
            <div class="row">
              <div class="col">
                <select class="form-control" id="liaison" name="liaison">
                  <?php 
                    $liaisonDefaut = null;
                    if (isset($LiaisonSelectionnee)) {
                      $liaisonDefaut = $LiaisonSelectionnee['code'];
                    } elseif (!empty($lesLiaisons) && isset($lesLiaisons[0]['code'])) {
                      $liaisonDefaut = $lesLiaisons[0]['code'];
                    }
                    foreach ($lesLiaisons as $liaison) {
                      $selected = ($liaisonDefaut == $liaison['code']) ? "selected" : "";
                  ?>
                      <option value="<?= $liaison['code']?>" <?= $selected ?>><?= $liaison['portDepart']." - ".$liaison['portArrivee'] ?></option>
                  <?php
                    }
                  ?>
                </select>
              </div>
              <div class="col">
                <?php $dateDefaut = isset($dateTraversee) && $dateTraversee != "" ? $dateTraversee : date('Y-m-d'); ?>
                <input type="date" name="date" id="date" value="<?= $dateDefaut ?>" />
              </div>
              <button type="submit" class="btn btn-primary">Afficher les traversées</button>
            </div>
          </form>

      <?php
      }
    ?>
  


      <?php
        if ($liaisonSelectionnee && $dateTraversee){
          ?>
          <h2 class="text-center">Liaison :</h2>
          <?= $liaisonSelectionnee['portDepart']." - ".$liaisonSelectionnee['portArrivee'] ?>.<br/>

          <p>Traversées pour le <?= $dateTraversee ?>. </p>
          <br>
          
          <?php
          if (isset($lesTraversees) && count($lesTraversees) > 0) {
            ?>
            <p>Sélectionner la traversée souhaitée :</p>
            <form method="POST" action="?p=reservation">
              <table class="table display">
                <thead>
                  <tr>
                    <th scope="col" colspan="3">Traversées</th>
                    <th colspan="<?= count($lesCategories) ?>" scope="col">Places disponibles</th>
                    <th scope="col"></th>
                  </tr>
                  <tr>
                    <th scope="col">N°</th>
                    <th scope="col">Heure</th>
                    <th scope="col">Bateau</th>
                    <?php 
                    foreach ($lesCategories as $categorie){
                    ?>
                      <th scope="col">nombre<br/> <?= $categorie['libelleCategorie'] ?></th>
                    <?php
                    }
                    ?>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  foreach ($lesTraversees as $traversee){
                  ?> 
                    <tr>
                      <td><?= $traversee['num'] ?></td>
                      <td><?= $traversee['heure'] ?></td>
                      <td><?= $traversee['nom'] ?></td>
                      <?php
                      foreach ($lesCategories as $categorie){
                        $nbPlaces = $placesCapacite[$traversee['num']][$categorie['idCategorie']];
                        if (isset($placesReservees[$traversee['num']][$categorie['idCategorie']])) {
                          $nbPlacesReservees = $placesReservees[$traversee['num']][$categorie['idCategorie']];
                        } else {
                          $nbPlacesReservees = 0;
                        }
                        $placesDispo = $nbPlaces - $nbPlacesReservees;

                      ?>
                        <td><?= $placesDispo ?></td>
                      <?php
                      }
                      ?>
                      <td><input type="radio" id="traversee" name="traversee" value="<?= $traversee['num'] ?>"></td>
                    </tr>
                  <?php
                  }
                  ?>
                </tbody>
              </table>
              <button type="submit" class="btn btn-primary">Réserver cette traversée</button>
            </form>
      <?php
          } else {
            ?>
            <p>Aucune traversée disponible pour cette date.</p>
            <?php
          }
        } 
      ?>

<?php
$content = ob_get_clean(); // Stocker le contenu dans une variable
include_once 'layout.php'; // Inclure le layout