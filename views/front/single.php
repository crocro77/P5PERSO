<br />
<div class="container">
    <div>
        <h1 id="site-title">Liste des jeux Game Gear</h1>
        <br />
        <p id="titleDetail"><a class="btn btn-default btn-sm" href="index.php">Retour à la page d'accueil</a></p>
    </div>
</div>
<div id="single" class="container grey lighten-3">
    <h2 id="post-title" class="center"><?= htmlspecialchars($sheetUnique->getTitle()); ?></h2>
        <div class="row center">
            <img class="chapterUniqueImage" src="public/img/<?= $sheetUnique->getScreenshot() ?>" alt="<?= htmlspecialchars($sheetUnique->getTitle()); ?>" >
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
        <div class="center">
            <img src="public/img/<?= $sheetUnique->getCover() ?>" alt="<?= htmlspecialchars($sheetUnique->getTitle()); ?>" width="183px" heigth="256px">
        </div>
        <p class="sheetParagraph"><?= $sheetUnique->getContent(); ?></p>
        <br />
        <div class="center">
            <h5>Bonus : Extrait de l'OST "<?= $sheetUnique->getTrackName(); ?>"</h5>
            <audio controls>
                <source src="public/mp3/<?= $sheetUnique->getTrack(); ?>" type="audio/mpeg">
                Your browser does not support the audio element.
            </audio>
        </div>
        <!-- test api ebay -->
        <!-- <h4>Ce jeu sur eBay</h4>
            <div id="results"></div>
            <script> function _cb_findItemsByKeywords(root) { var items = root && root.findItemsByKeywordsResponse && root.findItemsByKeywordsResponse[0] && root.findItemsByKeywordsResponse[0].searchResult && root.findItemsByKeywordsResponse[0].searchResult[0] && root.findItemsByKeywordsResponse[0].searchResult[0].item || []; var html = []; html.push('
            <table width="100%" border="0" cellspacing="0" cellpadding="3">
                <tbody>'); for (var i = 0; i < items.length; ++i) { var item = items[i]; var shippingInfo = item.shippingInfo && item.shippingInfo[0] || {}; var sellingStatus = item.sellingStatus && item.sellingStatus[0] || {}; var listingInfo = item.listingInfo && item.listingInfo[0] || {}; var title = item.title; var subtitle = item.subtitle || ''; var pic = item.galleryURL; var viewitem = item.viewItemURL; var currentPrice = sellingStatus.currentPrice && sellingStatus.currentPrice[0] || {}; var displayPrice = currentPrice['@currencyId'] + ' ' + currentPrice['__value__']; var buyItNowAvailable = listingInfo.buyItNowAvailable && listingInfo.buyItNowAvailable[0] === 'true'; var freeShipping = shippingInfo.shippingType && shippingInfo.shippingType[0] === 'Free'; if (null !== title && null !== viewitem) { html.push('
                <tr>
                    <td class="image-container">
                    <img src="' + pic + '"border = "0">
                    </td>'); html.push('
                    <td class="data-container">
                        <a class="item-link" href="' + viewitem + '"target="_blank">'); html.push('
                        <p class="title">' + title + '</p>'); html.push('
                        <p class="subtitle">' + subtitle + '</p>'); html.push('
                        <p class="price">' + displayPrice + '</p>'); if (buyItNowAvailable) { html.push('
                        <p class="bin">Buy It Now</p>'); } if (freeShipping) { html.push('
                        <p class="fs">Free shipping</p>'); } html.push('
                        </a>
                    </td>
                    </tr>'); } } html.push(" 
                </tbody>
                </table>"); document.getElementById("results").innerHTML = html.join(""); } 
            </script> -->
        <hr>
        <h4 id="comments">Commentaire(s)</h4>
    <?php    
    if ($listOfComments != false) {
        foreach($listOfComments as $comment) {
    ?>
        <strong><?= htmlspecialchars($comment->getAuthor()); ?> (Le <?= date("d/m/Y", strtotime($comment->getCommentDate())) ?>) a dit :</strong>
        <blockquote>
            <?= htmlspecialchars($comment->getComment()); ?>
            <?php
            if(empty($comment->getSignaled())) { // Si l'attribut 'signaler' est vide, on affiche le lien pour signaler.
            ?>
            <a href="index.php?p=single&amp;id=<?= $sheetUnique->getId(); ?>&amp;action=signalcomment&amp;commentId=<?= $comment->getId(); ?>"><small class="signal pull-right">Signaler</small></a>
            <?php
            // Sinon, on affiche un message d'alerte pour prévenir que le commentaire a été signalé.
            } else {
                echo '<em class="orange">Le commentaire a été signalé et est en attente de modération.</em>';
            }
            ?>
        </blockquote>
        <?php
        }
    } else {
        echo "Aucun commentaire n'a été publié, soyez le premier à réagir !";
    }   
        ?>
	<hr>
	<h4 id="poster-commentaire">Commenter</h4>
		<div class="write-comment">
            <?php
            if(isset($_SESSION['username'])) {
                echo '<p>Vous postez un commentaire en tant que <strong>' . $_SESSION['username'] . '</strong></p>';
            }
            ?>
            <p>Le pseudo et le commentaire sont obligatoires pour valider votre commentaire.</p>
            <form class="form-horizontal" action="index.php?p=single&amp;id=<?= $sheetUnique->getId(); ?>&amp;action=postcomment#comments" method="post">
                <?php
                if(!isset($_SESSION['username'])) {
                ?>
                <div class="form-group">
                    <label for="author" class="col-sm-1 control-label">Pseudo </label>
                    <div class="col-sm-offset-1 col-sm-2">
                        <input type="text" name="author" id="author" class="form-control" required/>
                    </div>
                </div>
                <?php
                }
                ?>
                <div class="form-group">
                    <label for="comment" class="col-sm-1 control-label">Commentaire</label>
                        <div class="col-sm-offset-1 col-sm-10">
                            <textarea name="comment" id="comment" class="materialize-textarea" required></textarea>
                        </div>
                </div>
                    <input type="hidden" name="id" value="<?= $sheetUnique->getId(); ?>">
                <div class="col s12">
                    <button type="submit" name ="submit" class="btn light-blue waves-effect">Envoyer votre commentaire</button>
                </div>
            </form>
        </div>
</div>