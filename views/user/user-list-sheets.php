<div id="list" class="grey lighten-3">
<h2 id="to-the-top">Liste des fiches</h2>
<hr/>
<ul id="list-pagination" class="pagination center">
    <?php  
        $character = range('A', 'Z');
        foreach($character as $alphabet) {
			echo '<li class="waves-effect"><a class="page-link" href="index.php?p=member&tab=list&char='.$alphabet.'">'.$alphabet.'</a></li>'; 
		}
    ?>  
</ul>
<?php
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
                    </div>
                </div>
                <hr/>
            </div>
        </div>
    <?php
    }
?>
<a href="#to-the-top" title="Retour en haut" class="right"><i class="material-icons">arrow_upward</i></a>
</div>