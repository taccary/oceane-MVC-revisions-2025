<form method="POST" action="?p=actionCRUDBateau&action=add" enctype="multipart/form-data">
    <div class="modal-body">
        <div class="row form-group">
            <div class="col-sm-2">
                <label class="control-label modal-label">Nom:</label>
            </div>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="nom" required>
            </div>
        </div>
        <div class="row form-group">
            <div class="col-sm-2">
                <label class="control-label modal-label">Niveau PMR:</label>
            </div>
            <div class="col-sm-10">
                <select name="niveauPMR" class="form-control" required>
                    <?php foreach ($lesNiveauxPMR as $niveau) : ?>
                        <option value="<?php echo $niveau['idNiveau']; ?>"><?php echo $niveau['libelle']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="row form-group">
            <div class="col-sm-2">
                <label class="control-label modal-label">Image:</label>
            </div>
            <div class="col-sm-10">
                <input type="file" class="form-control" name="image" accept=".jpg, .jpeg, .png" required>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
        <i class="bi bi-x-circle"></i> Annuler
        </button>
        <button type="submit" name="add" class="btn btn-primary">
            <i class="bi bi-download"></i> Enregistrer
        </button>
    </div>
</form>
