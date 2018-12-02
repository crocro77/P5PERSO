<div id="write" class="grey lighten-3">
<?php 
if(isset($_GET['action']) && $_GET['action'] == 'edit' && isset($_GET['id'])) {
	echo '<div class="page-header">';
	echo '<h3>Mettre à jour la fiche</h3>';
	echo '</div>';
} elseif (isset($_GET['action']) && $_GET['action'] == 'write' && isset($_GET['id'])) {
	echo '<div class="page-header">';
	echo '<h3>Nouvelle fiche</h3>';
	echo '</div>';
}
// Si l'on n'est pas en train d'éditer un article. 
if(!isset($_GET['action'])) {
	echo '<p>Vous pouvez rédiger dès à présent une nouvelle fiche.</p>';
}
if(isset($_SESSION['flash'])) {
	include('includes/flash-msg.php');
}
?>
<form action="" method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label for="title">Titre </label>
		<input type="text" name="title" class="form-control" value="<?php if(isset($_GET['action']) && $_GET['action'] == 'edit') echo $sheet->getTitle(); ?>">
	</div>
	<div class="form-group">
		<label for="author">Auteur </label>
		<input type="text" name="author" class="form-control" value="<?php if(isset($_GET['action']) && $_GET['action'] == 'edit') echo $sheet->getAuthor(); else echo "ntonyyy" ?>" />
	</div>
	<div class="form-group">
		<label for="developer">Développeur </label>
		<input type="text" name="developer" class="form-control" value="<?php if(isset($_GET['action']) && $_GET['action'] == 'edit') echo $sheet->getDeveloper(); ?>" />
	</div>
	<div class="form-group">
		<label for="publisher">Editeur </label>
		<input type="text" name="publisher" class="form-control" value="<?php if(isset($_GET['action']) && $_GET['action'] == 'edit') echo $sheet->getPublisher(); ?>" />
	</div>
	<div class="form-group">
		<label for="release_date">Année de sortie </label>
		<input type="number" min="1990" max="1997" name="release_date" class="form-control" value="<?php if(isset($_GET['action']) && $_GET['action'] == 'edit') echo $sheet->getReleaseDate(); ?>" />
	</div>
	<div class="form-group">
		<label for="genre">Genre </label>
		<input type="text" name="genre" class="form-control" value="<?php if(isset($_GET['action']) && $_GET['action'] == 'edit') echo $sheet->getGenre(); ?>" />
	</div>
	<div class="form-group">
		<label for="content">Contenu </label>
		<textarea name="content" class="form-control"><?php if(isset($_GET['action']) && $_GET['action'] == 'edit') echo $sheet->getContent(); ?></textarea>
	</div>
	<br />
	<img id="output_cover_image" width="25%" height="25%"/>
	<div class="col s12">
        <div class="btn btn-black waves-effect waves-light input-field file-field col s3">
			<input type="file" name="file" onchange="preview_cover_image(event)">
    		<input type="submit" value="Cover de la fiche" name="submit">
        </div>
	</div>
	
	<img id="output_screenshot_image" width="25%" height="25%"/>
	<div class="col s12">
        <div class="btn btn-black waves-effect waves-light input-field file-field col s3">
			<input type="file" name="file3" onchange="preview_screenshot_image(event)">
    		<input type="submit" value="Screenshot de la fiche" name="submit">
        </div>
    </div>

	<div class="col s12">
        <div class="btn btn-black waves-effect waves-light input-field file-field col s3">
			<input type="file" name="file2">
    		<input type="submit" value="Track bonus de l'OST" name="submit">
        </div>
    </div>
	<div class="form-group">
		<label for="trackname">Nom de la track</label>
		<input type="text" name="trackname" class="form-control" value="<?php if(isset($_GET['action']) && $_GET['action'] == 'edit') echo $sheet->getTrackName(); ?>" />
	</div>
	<br />
	<?php
	// Si on édite un article, le bouton d'envoi devient 'Mettre à jour'.
	if(isset($_GET['action']) && $_GET['action'] == 'edit') {
		?>
		<input type="hidden" name="id" value="<?= $sheet->getId(); ?>" />
		<button type="submit" class="btn btn-warning">Mettre à jour</button>
		<?php
	}
	// Sinon, le bouton d'envoi permet de publier un article.
	else {
		?>
		<button type="submit" class="btn btn-publish">Publier</button>
		<?php
	}
	?>
</form>
</div>
<!-- On appelle la librairie TinyMCE pour la page Ecriture/Edition -->
<script src="//cloud.tinymce.com/stable/tinymce.min.js?apiKey=c851wd1npuo4c59ed6f7fp6doripcdhfdi1ltt9hpr29wt3x"></script>
<script type="text/javascript" src="public/js/preview_image.js"></script>
<script>tinymce.init({
	selector: 'textarea',
	height: 500,
	menubar: false,
    plugins: [
        'advlist autolink lists link image charmap print preview anchor',
        'searchreplace visualblocks code fullscreen',
        'insertdatetime media save table contextmenu paste code'
    ],
    toolbar: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
    content_css: '//www.tinymce.com/css/codepen.min.css'
    });
</script>