<div id="settings" class="center settings grey lighten-3">
	<div class="page-header">
		<h2>Réglages</h2>
	</div>

	<h4>Page &laquo; À propos &raquo;</h4>

	<p class="text-justify">Entrez une description de votre site, fournissez des informations de contact et ce qui vous paraîtra important. Cela apparaitra dans la page &laquo; À propos &raquo; de votre site.</p>

	<form action="" method="post">
		<textarea name="aboutDescription" class="form-control">
			<?php
			if(!empty($aboutDescription)) {
				echo $aboutDescription;
			}
			?>
		</textarea><br>
		<input type="submit" class="btn btn-default btn-sm" value="Mettre à jour">
		<a class="btn btn-default btn-sm" href="index.php?p=admin&amp;menu=settings&amp;action=deleteDescription">Supprimer la description</a>
	</form>
	
	<br>

	<h4>Vos fiches</h4>

	<p><a class="btn btn-default btn-sm" onclick="return(confirm('Êtes-vous sûr de vouloir supprimer toutes les fiches ?'));" href="index.php?p=admin&amp;menu=settings&amp;action=truncate">Supprimer toutes les fiches</a></p>
	<p><a class="btn btn-default btn-sm" onclick="return(confirm('Êtes-vous sûr de vouloir supprimer tous les commentaires ?'));" href="index.php?p=admin&amp;action=deleteAllComments">Supprimer tous les commentaires</a></p>
	<br>

	<h4>Le Chat</h4>
	<p><a class="btn btn-default btn-sm" onclick="return(confirm('Êtes-vous sûr de vouloir supprimer tous les messages du chat ?'));" href="index.php?p=admin&amp;action=deleteAllMessages">Supprimer tous les messages du chat</a></p>

	<h4>Votre compte</h4>

	<div class="center">
		<a class="btn btn-default btn-sm" title="Se déconnecter" href="index.php?p=logout"><i class="material-icons left">exit_to_app</i>Se déconnecter</a></li>
    </div>
</div>

<script src="//cloud.tinymce.com/stable/tinymce.min.js?apiKey=c851wd1npuo4c59ed6f7fp6doripcdhfdi1ltt9hpr29wt3x"></script>
<script type="text/javascript" src="public/js/script.js"></script>
<script>tinymce.init({
	selector: 'textarea',
	height: 500,
	menubar: false,
    plugins: [
        'advlist autolink lists charmap print preview anchor',
        'searchreplace visualblocks code fullscreen',
        'insertdatetime media save table contextmenu paste code'
    ],
    toolbar: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent',
    content_css: '//www.tinymce.com/css/codepen.min.css'
    });
</script>