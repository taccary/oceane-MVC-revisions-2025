<div class="modal-body">
    <p class="text-center">Etes-vous sur de vouloir supprimer le bateau <?php echo $bateau['nom']; ?> (action irreversible)</p>
    <div class="text-center">
        <img src="/images/bateaux/<?php echo $bateau['photo']; ?>" alt="<?php echo $bateau['nom']; ?>" height="100">
    </div>
</div>
<div class="modal-footer">
    <form method="POST" action="?p=actionCRUDBateau&action=delete">
        <input type="hidden" class="form-control" name="id" value="<?php echo $bateau['id']; ?>">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
            <i class="bi bi-x-circle"></i> Annuler
        </button>
        <button type="submit" name="supr" class="btn btn-danger">
            <i class="bi bi-trash3"></i> Supprimer
        </button>
    </form>
</div>