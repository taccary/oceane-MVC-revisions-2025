<?php
// Définir les variables spécifiques à cette vue
$title = "Liaisons par secteurs";
$keywords = "bateaux, ferries, accessibilité";
$description = "Découvrez notre flotte et les caractéristiques de nos différents ferries.";

// Capturer le contenu spécifique dans une variable
ob_start();
?>

<h1 class="page-header text-center"><?= $title ?></h1>

  <table class="table">
        <thead>
          <tr>
            <th scope="col">Secteur</th>
            <th scope="col">Code Liaison</th>
            <th scope="col">Distance en milles marin</th>
            <th scope="col">Port de départ</th>
            <th scope="col">Port d’arrivée</th>
          </tr>
        </thead>
        <tbody>
      
    <?php
    foreach ($lesSecteurs as $secteur){
      $i = 1; // itérateur pour différentier la première ligne
      $nbLiaisons = count($secteur['liaisons']);
    ?> 
          <?php
          foreach ($secteur['liaisons'] as $liaison){
            if ($i==1){
            ?>
              <tr>
                <th scope="row" rowspan="4">
                  <?= $secteur['nom'] ?>
                </th>
            <?php } else { ?>
              <tr>
            <?php } ?>

                <td><?= $liaison['code']?></td>
                <td><?= $liaison['distance']?></td>
                <td><?= $liaison['portDepart']?></td>
                <td><?= $liaison['portArrivee']?></td>
              </tr>

          <?php
          $i++;
          }
          ?>

    <?php
    }
    ?>

    </tbody>
  </table>
  
<?php
$content = ob_get_clean(); // Stocker le contenu dans une variable
include 'layout.php'; // Inclure le layout