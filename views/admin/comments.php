<div class="page-header">
	<h3 id="to-the-top" class="center">Commentaire(s)</h3>
</div>
<?php
if($signaledComments) echo '<p class="center"><i id="flash" class="material-icons">warning</i><br/><strong>Un ou plusieurs commentaire(s) signalé(s) : <a href="#signaled-comment">Action requise !</a></strong></p>';
if (empty($listOfComments)) {
	echo '<p>Aucun commentaire n\'a été posté pour le moment.</p>';
} else { ?>
<div class="row">
	<div class="container">
		<table class="table">
			<thead>
				<th class="center">Fiche</th>
				<th>Commentaire</th>
				<th>Auteur</th>
				<th>Action</th>
			</thead>
			<tbody>
				<?php
			foreach ($listOfComments as $comment) { ?>
					<tr id="commentaire_<?= $comment->getId() ?>"> 
						<td class="center"><a href="?p=single&amp;id=<?= $comment->getPostId(); ?>"><?= $comment->getPostId(); ?></a></td>
						<td><em><?= $comment->getComment(); ?></em></td>
						<td><strong><?= $comment->getAuthor(); ?></strong></td>
						<td><a href="?p=admin&amp;tab=comments&amp;action=seenComment&amp;commentId=<?= $comment->getId(); ?>" title="Indiqué comme vu"><i class="material-icons">remove_red_eye</i></a>
							<a href="?p=admin&amp;tab=comments&amp;action=deleteComment&amp;commentId=<?= $comment->getId(); ?>" title="Supprimer le commentaire"><i class="material-icons">delete</i></a>
						</td>
					</tr>
					<?php
			}
			?>
			</tbody>
		</table>
		<div class="col-xs-12 signaled-comments">
			<h4 id="signaled-comment" class="center">Commentaire(s) signalé(s)</h4>
			<?php 
		if (empty($signaledComments)) {
			echo 'Aucun commentaire n\'a été signalé pour le moment.';
		} else {
			?>
			<table class="table table-striped table-bordered table-hover table-condensed">
				<thead>
					<th>Auteur</th>
					<th>Contenu</th>
					<th>Ecrit le</th>
					<th>Action</th>
				</thead>
													
				<tbody>
					<?php
				foreach ($signaledComments as $signaledComment) {
					?>
						<tr>
							<td><strong><?= $signaledComment->getAuthor(); ?></strong></td>
							<td><em><?= $signaledComment->getComment(); ?></em></td>
							<td><?= $signaledComment->getCommentDate()->format('d/m/y'); ?></td>
							<td>
								<a title="Valider le commentaire" href="?p=admin&amp;tab=comments&amp;action=validateComment&amp;commentId=<?= $signaledComment->getId(); ?>"><i class="material-icons">done</i></a>
								<a title="Supprimer le commentaire" href="?p=admin&amp;tab=comments&amp;action=deleteComment&amp;commentId=<?= $signaledComment->getId(); ?>"><i class="material-icons">delete</i></a>
							</td>
						</tr>
					<?php
				}
				?>
				</tbody>
			</table>
			<?php
		}
		?>
		</div>
		<?php
	}
	?>
	</div>
	<a href="#to-the-top" title="Retour en haut" class="right"><i class="material-icons">arrow_upward</i></a>
</div>

<script type="text/javascript" src="public/js/script.js"></script>