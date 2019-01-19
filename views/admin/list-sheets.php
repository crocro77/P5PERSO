<div id="list" class="grey lighten-3">
<h2 id="to-the-top" class="center">Liste des fiches</h2>
<hr/>
<ul class="pagination center">
	<?php
    for ($i = 1; $i <= $numberOfPages; $i++) {
        if ($i == $currentPage) {
            echo "<li class='page-item'><a class='page-link'>$i</a></li>";
        } else {
            echo '<li class="waves-effect"><a class="page-link" href="?p=admin&tab=list&tabpage=' . $i . '">' . $i . '</a></li>';
        }
    }
    ?>	
</ul>
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
                        <a class="btn btn-default btn-sm" href="index.php?p=single&id=<?= $sheet->getId(); ?>">Voir la fiche complète</a>
                        <br/><br/>
                        <a class="btn btn-default btn-sm" href="index.php?p=edit&id=<?= $sheet->getId(); ?>">Éditer la fiche</a>
                        <br/><br/>
                        <form method="post" role="form" onclick="return confirm('Etes vous sûr de vouloir supprimer cette fiche ?')" action="index.php?p=admin&menu=list&action=deletesheet&id=<?= $sheet->getId(); ?>">
                            <input type="hidden" name="id" value="<?= $sheet->getId(); ?>">
                            <input type="submit" value="Supprimer la fiche" class="btn btn-danger">
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