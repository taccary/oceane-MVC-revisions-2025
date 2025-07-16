<form method="POST" action="?p=actionCRUDBateau&action=edit" enctype="multipart/form-data">
    <div class="modal-body">
        <div class="row form-group">
            <input type="hidden" class="form-control" name="id" value="<?php echo $bateau['id']; ?>">
            <div class="row form-group">
                <div class="col-sm-2">
                    <label class="control-label modal-label">Nom:</label>
                </div>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="nom" value="<?php echo $bateau['nom']; ?>">
                </div>
            </div>
            <div class="row form-group">
                <div class="col-sm-2">
                    <label class="control-label modal-label">Niveau PMR:</label>
                </div>
                <div class="col-sm-10">
                    <select name="niveauPMR" class="form-control">
                        <?php foreach ($lesNiveauxPMR as $niveau) : ?>
                            <option value="<?php echo $niveau['idNiveau']; ?>" <?php if ($bateau['idNiveau'] == $niveau['idNiveau']) echo 'selected'; ?>>
                                <?php echo $niveau['libelle']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-sm-2">
                    <label class="control-label modal-label">Image:</label>
                </div>
                <div class="col-sm-10">
                    <input type="file" class="form-control" name="image" accept=".jpg, .jpeg, .png">
                    <img src="/images/bateaux/<?php echo $bateau['photo']; ?>" alt="<?php echo $bateau['nom']; ?>" height="100">
                </div>
                <input type="hidden" name="imageOld" value="<?php echo $bateau['photo']; ?>">
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
            <i class="bi bi-x-circle"></i> Annuler
        </button>
        <button type="submit" name="edit" class="btn btn-success">
            <i class="bi bi-pencil-square"></i> Modifier
        </button>
    </div>
</form>
        