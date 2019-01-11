<div id="settings" class="center settings grey lighten-3">
	<div class="page-header">
		<h2>Réglages</h2>
		<?php
	if(isset($_SESSION['flash'])) {
		include('includes/flash-msg.php');
	}
	?>
	</div>

	<h4>Page &laquo; À propos &raquo;</h4>

	<p class="text-justify">Entrez une description de votre site, fournissez des informations de contact et ce qui vous paraîtra important. Cela apparaitra dans la page &laquo; À propos &raquo; de votre site.</p>

	

	<form action="" method="post">
		<textarea name="description" class="form-control"><?php if(!empty(About::getAboutDescription())) echo About::getAboutDescription(); ?></textarea><br>
		<?php if(empty(About::getAboutDescription())) echo '<input type="submit" class="btn btn-publish" href="index.php?p=admin&amp;tab=settings&amp;action=addaaboutdescription" value="Valider la description">'; else echo '<input type="submit" class="btn btn-warning" href="index.php?p=admin&amp;tab=settings&amp;action=updateaboutdescription" value="Mettre à jour la description">'; ?>
		<a class="btn btn-danger" onclick="return confirm('Etes vous sûr de vouloir supprimer la description ?')" href="index.php?p=admin&amp;tab=settings&amp;action=deleteaboutdescription">Supprimer la description</a>
	</form>
	
	<br>

	<h4>Vos fiches</h4>

	<p><a class="btn btn-danger" onclick="return(confirm('Êtes-vous sûr de vouloir supprimer toutes les fiches ?'));" href="index.php?p=admin&amp;tab=settings&amp;action=truncate">Supprimer toutes les fiches</a></p>
	<p><a class="btn btn-danger" onclick="return(confirm('Êtes-vous sûr de vouloir supprimer tous les commentaires ?'));" href="index.php?p=admin&amp;action=deleteAllComments">Supprimer tous les commentaires</a></p>
	<br>

	<h4>Le Chat</h4>
	<p><a class="btn btn-danger" onclick="return(confirm('Êtes-vous sûr de vouloir supprimer tous les messages du chat ?'));" href="index.php?p=admin&amp;action=deleteAllMessages">Supprimer tous les messages du chat</a></p>

	<h4>Votre compte</h4>

	<div class="center">
		<a class="btn btn-default btn-sm" title="Se déconnecter" href="index.php?p=logout"><i class="material-icons left">exit_to_app</i>Se déconnecter</a></li>
    </div>
</div>

<script src="//cloud.tinymce.com/stable/tinymce.min.js?apiKey=c851wd1npuo4c59ed6f7fp6doripcdhfdi1ltt9hpr29wt3x"></script>
<script type="text/javascript" src="public/js/tinymce.js"></script>
<script type="text/javascript" src="public/js/clignotement.js"></script>
