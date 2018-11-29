<div class="settings">
	<div class="page-header">
		<h2>Réglages</h2>
	</div>

	<!-- <h4>Page &laquo; À propos &raquo;</h4>

	<p class="text-justify">Entrez une description de votre blog, fournissez des informations de contact et ce qui vous paraîtra important. Cela apparaitra dans la page &laquo; À propos &raquo; de votre site.</p>

	<form action="" method="post">
		<textarea name="aboutDescription" class="form-control">
			<>?php
			if(!empty($this->aboutDescription)) {
				echo $this->aboutDescription;
			}
			?>
		</textarea><br>
		<input type="submit" class="btn btn-default btn-sm" value="Mettre à jour">
		<a class="btn btn-default btn-sm" href="index.php?p=admin&amp;menu=settings&amp;action=deleteDescription">Supprimer la description</a>
	</form>
	
	<br> -->

	<h4>Vos articles</h4>

	<p><a onclick="return(confirm('Êtes-vous sûr de vouloir supprimer tous les articles ?'));" href="index.php?p=admin&amp;menu=settings&amp;action=truncate">Supprimer tous les articles</a></p>
	<p><a onclick="return(confirm('Êtes-vous sûr de vouloir supprimer tous les commentaires ?'));" href="index.php?p=admin&amp;action=deleteAllComments">Supprimer tous les commentaires</a></p>
	<br>

	<h4>Votre compte</h4>

	<div class="center">
		<a class="btn light-blue waves-effect" title="Se déconnecter" href="index.php?p=logout"><i class="material-icons left">exit_to_app</i>Se déconnecter</a></li>
    </div>
</div>