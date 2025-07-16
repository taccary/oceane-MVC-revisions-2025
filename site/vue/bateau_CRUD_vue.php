<?php
// Définir les variables spécifiques à cette vue
$title = "Nos navires";
$keywords = "bateaux, ferries, accessibilité";
$description = "Découvrez notre flotte et les caractéristiques de nos différents ferries.";

// Capturer le contenu spécifique dans une variable
ob_start();
?>

<!-- Modale vide pour AJAX -->
<div class="modal fade" id="ajaxModal" tabindex="-1" aria-labelledby="ajaxModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ajaxModalLabel">Chargement...</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Contenu chargé dynamiquement via AJAX -->
                <p>Chargement en cours...</p>
            </div>
        </div>
    </div>
</div>

<h1 class="page-header text-center">CRUD Bateaux</h1>
<div class="row">
    <div class="row">
    <?php
        if(isset($_SESSION['error'])){
            ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= $_SESSION['error'] ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

            <?php
            unset($_SESSION['error']);
        }
        if(isset($_SESSION['success'])){
            ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= $_SESSION['success'] ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php
            unset($_SESSION['success']);
        }
    ?>
    </div>

    <button type="button" class="btn btn-primary btn-sm open-ajax-modal" data-action="add" style="margin-bottom: 10px;">
        <i class="bi bi-plus-circle-fill"></i> Ajouter
    </button>
    <br>
    <div class="height10">
    </div>
</div>
<div class="row">
    <table id="myTable" class="table table-bordered table-striped">
        <thead>
            <th>identifiant</th>
            <th>nom</th>
            <th>photo</th>
            <th></th>
        </thead>
        <tbody>
            <?php
                foreach ($lesBateaux as $row){
                    ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= $row['nom'] ?></td>
                        <td><img height='100px' src='images/bateaux/<?= $row['photo'] ?>'></td>
                        <td>
                            <button type="button" class="btn btn-success btn-sm open-ajax-modal" data-id="<?= $row['id'] ?>" data-action="edit">
                                <i class="bi bi-pencil-square"></i> Modifier
                            </button>
                            <button type="button" class="btn btn-danger btn-sm open-ajax-modal" data-id="<?= $row['id'] ?>" data-action="delete">
                                <i class="bi bi-trash3"></i> Supprimer
                            </button>
                        </td>
                    </tr>
                    <?php
                }
            ?>
        </tbody>
    </table>
</div>



<!-- generate datatable on our table -->
<script>
$(document).ready(function(){
	//inialize datatable
    $('#myTable').DataTable();
});
</script>
<script>
$(document).ready(function() {
    // Gérer l'ouverture de la modale AJAX
    $('.open-ajax-modal').on('click', function() {
        const id = $(this).data('id') || null; // Récupérer l'ID du bateau (null si action = add)
        const action = $(this).data('action'); // Récupérer l'action (add, edit ou delete)
        const modal = $('#ajaxModal'); // Sélectionner la modale

        // Modifier le titre de la modale en fonction de l'action
        if (action === 'add') {
            modal.find('.modal-title').text('Ajouter un bateau');
        } else if (action === 'edit') {
            modal.find('.modal-title').text('Modifier le bateau');
        } else if (action === 'delete') {
            modal.find('.modal-title').text('Supprimer le bateau');
        }

        // Charger le contenu via AJAX
        $.ajax({
            url: '?p=chargerModaleBateau', 
            method: 'POST',
            data: { id: id, action: action },
            success: function(response) {
                modal.find('.modal-body').html(response); // Insérer le contenu dans la modale
                modal.modal('show'); // Afficher la modale
            },
            error: function() {
                modal.find('.modal-body').html('<p class="text-danger">Erreur lors du chargement.</p>');
                modal.modal('show');
            }
        });
    });
});
</script>

<?php
$content = ob_get_clean(); // Stocker le contenu dans une variable
include 'layout.php'; // Inclure le layout