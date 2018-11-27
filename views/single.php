<br />
<div class="container">
    <div>
        <h1  id="site-title">Liste des jeux Game Gear</h1>
        <br />
        <p id="titleDetail"><a class="btn black waves-effect" href="index.php">Retour à la page d'accueil</a></p>
    </div>
</div>
<div class="container">
    <h2 id="post-title" class="center"><?= htmlspecialchars($sheetUnique->getTitle()); ?></h2>
        <div class="row center">
            <img class="chapterUniqueImage" src="<?= $sheetUnique->getScreenshot() ?>" alt="<?= htmlspecialchars($sheetUnique->getTitle()); ?>" >
        </div>
        <h6 class="center">Par <?= htmlspecialchars($sheetUnique->getAuthor()); ?> le <?= $sheetUnique->getDate()->format('d/m/Y') ?></h6>
        <table>
            <thead>
                <th>Développeur</th>
                <th>Editeur</th>
                <th>Année de sortie</th>
                <th>Genre</th>
            </thead>
            <tbody>
                <td><?= $sheetUnique->getDeveloper() ?></td>
                <td><?= $sheetUnique->getPublisher() ?></td>
                <td><?= $sheetUnique->getReleaseDate() ?></td>
                <td><?= $sheetUnique->getGenre() ?></td>
            </tbody>
        </table>
        <br />
        <div class="center"><img src="public/img/<?= $sheetUnique->getCover() ?>" width="10%"></div>
   
        <p class="sheetParagraph"><?= $sheetUnique->getContent(); ?></p>
        <br />
        <div class="center">
            <h5>Bonus : Extrait de l'OST "<?= $sheetUnique->getTrackName(); ?>"</h5>
            <audio controls>
                <source src="<?= $sheetUnique->getTrack(); ?>" type="audio/mpeg">
                Your browser does not support the audio element.
            </audio>
        </div>
        <hr>
    <h4>Commentaire(s)</h4>
    <?php
    if ($listOfComments != false) {
        foreach ($listOfComments as $comment) {
            ?>
        <strong><?= htmlspecialchars($comment->getAuthor()); ?> (Le <?= date("d/m/Y", strtotime($comment->getCommentDate())) ?>) a dit :</strong><?php
                                                                                                                                                ?>
        <blockquote>
            <p>
                <?= htmlspecialchars($comment->getComment()); ?>
                <?php
                if (empty($comment->getSignaled())) { // Si l'attribut 'signaler' est vide, on affiche le lien pour signaler.
                    ?>
                <a href="index.php?p=single&amp;id=<?= $sheetUnique->getId(); ?>&amp;action=signal&amp;commentId=<?= $comment->getId(); ?>"><small class="signal pull-right">Signaler</small></a>
                <?php
                // Sinon, on affiche un message d'alerte pour prévenir que le commentaire a été signalé.
            } else {
                echo '<em class="orange">Le commentaire a été signalé et est en attente de modération.</em>';
            }
            ?>
            </p>
        </blockquote>
        <?php

    }
} else {
    echo "<p class='white'>Aucun commentaire n'a été publié, soyez le premier à réagir !</p>";
}
?>
	<hr>
	<h4 id="poster-commentaire">Commenter</h4>
		<div class="write-comment">
            <?php
            if (isset($_SESSION['username'])) {
                echo '<p class="white">Vous postez un commentaire en tant que <strong>' . $_SESSION['username'] . '</strong></p>';
            }
            ?>
            <form class="form-horizontal" action="index.php?p=single&amp;id=<?= $sheetUnique->getId(); ?>#comments" method="post">
                <?php
                if (!isset($_SESSION['username'])) {
                    ?>
                <div class="form-group">
                    <label for="author" class="col-sm-1 control-label">Pseudo </label>
                    <div class="col-sm-offset-1 col-sm-2">
                        <input type="text" name="author" class="form-control" />
                    </div>
                </div>
                <?php

            }
            ?>
                <div class="form-group">
                    <label for="comment" class="col-sm-1 control-label">Commentaire</label>
                        <div class="col-sm-offset-1 col-sm-10">
                            <textarea name="comment" class="materialize-textarea"></textarea>
                        </div>
                </div>
                    <input type="hidden" name="id" value="<?= $sheetUnique->getId(); ?>">
                <div class="col s12">
                    <button type="submit" name ="submit" class="btn black waves-effect">Envoyer votre commentaire</button>
                </div>
            </form>
        </div>
</div>
<script type="text/javascript" src="public/js/script.js"></script>