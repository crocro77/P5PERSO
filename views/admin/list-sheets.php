<div class="grey lighten-3">
<h2 id="to-the-top">Liste des fiches</h2>
<hr/>
<?php
if(empty($listOfsheets)) {
	echo '<p>Vous n\'avez pas encore publié de fiche. <a href="index.php?p=admin&amp;menu=write">Commencez ici</a></p>';
} else {
    foreach($listOfsheets as $sheet){
        ?>
        <div class="row">
            <div class="col s12">
                <h4 id="post-title"><?= htmlspecialchars($sheet->getTitle()); ?></h4>
                <p>
                    <small>Rédigé le <?= $sheet->getDate()->format('d/m/Y à H:i'); ?></small>
                </p>
                <div class="row">
                    <div class="col s12 m6 l8">
                    <?= substr($sheet->getContent(), 0, 1000) . '...'; ?>...
                    </div>
                    <div class="col s12 m6 l4 center">
                        <img src="public/img/<?= $sheet->getCover() ?>" class="responsive-img" alt="<?= htmlspecialchars($sheet->getTitle()); ?>"/>
                        <br/><br/>
                        <a class="btn black waves-effect waves-light" href="index.php?p=single&id=<?= $sheet->getId(); ?>">Voir la fiche complète</a>
                        <br/><br/>
                        <a class="btn black waves-effect waves-light" href="index.php?p=admin&tab=write&action=edit&id=<?= $sheet->getId(); ?>">Éditer la fiche</a>
                        <br/><br/>
                        <form method="post" role="form" action="index.php?p=admin&menu=list&action=delete&id=<?= $sheet->getId(); ?>">
                            <input type="hidden" name="id" value="<?= $sheet->getId(); ?>">
                            <input type="submit" value="Supprimer le chapitre" class="btn btn-danger">
                        </form>
                    </div>
                </div>
                <hr/>
            </div>
        </div>
    <?php
    }
}
?>
<a href="#to-the-top" title="Retour en haut" class="right"><i class="material-icons">arrow_upward</i></a>
</div>